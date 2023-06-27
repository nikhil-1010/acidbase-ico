// SPDX-License-Identifier: GPL-3.0
pragma solidity ^0.8.9;

interface IERC20 {
    function transfer(address recipient, uint256 amount) external returns (bool);
    function transferFrom(address sender, address recipient, uint256 amount) external returns (bool);
    function balanceOf(address account) external view returns (uint256);
    function decimals() external view returns (uint256);
}

contract Seed {

    address public owner;
    address public acb_address;
    uint256 public tokenGenerateTime;
    uint256 public vestingDuration;      // In months
    uint256 public vestingTimeStartFrom;  //  Claim cannot start before vestingTimeStart from 
    uint256 public totalInvestment;
    uint256 public totalRelease;
    uint256 public tgePercentage;
    uint256 public exchangeRate;

    struct Investor {
        uint256 lockedAcb;        //  Locked balance
        uint256 releasedAcb;       // relesed balance
        uint256 previousClaimTime;
        uint256 claimCounter;
        bool isTokenGenerated;
        uint256 balance;     // remaining balance
    }

    mapping(address => Investor) public investors;

    event AddInvestor(address indexed investor, uint256 indexed payin_amount,uint256 indexed payout_amount);
    event Claim(address indexed sender, address indexed investor, uint256 indexed amount);

    constructor() {
        tokenGenerateTime = 1687794039;     // 30 aug 2023 UTC 00:00
        vestingTimeStartFrom = 1687966839;  // 30 sept 2023 UTC 00:00
        vestingDuration = 23;
        tgePercentage = 8;
        owner = msg.sender;
        acb_address = 0x021483b34Fc6dA236777Ed158E568b448d4b78b7;
    }

    modifier isInvestorExist(){
        require(investors[msg.sender].lockedAcb != 0," Invalid investor. ");
        _;
    }
    
    modifier onlyOwner() {
        require(owner == msg.sender , "Only owner access");
        _;
    }
    
    function isTokenGenerateEventStarted() public view returns(bool){
        if(block.timestamp > tokenGenerateTime)
            return true;       // if date is after TGE time
        else
            return false;      // if date is before TGE time
    }
    
    function isVestingTimeStarted() public view returns(bool){
        if(block.timestamp > vestingTimeStartFrom)
            return true;       // vesting Time started
        else
            return false;      // or not
    }
    
    function modifyVestingDuration(uint256 _month) public onlyOwner {
        require(!isVestingTimeStarted()," Vesting duration cannot be changed when vesting period started.");
        vestingDuration = _month;
    }
    
    function modifyVestingTimeStartFrom(uint256 _date) public onlyOwner {
        require(!isVestingTimeStarted()," Vesting time cannot be changed when vesting period started.");
        require(_date >= tokenGenerateTime, "Vesting time cannot start before token generate event.");
        vestingTimeStartFrom = _date;
    }
    
    function modifyTokenGenerateTime(uint256 _date) public onlyOwner {
        require(!isTokenGenerateEventStarted(),"Token generate time cannot be changed when token generate event started.");
        require(_date <= vestingTimeStartFrom, "Token generate event time must be less than vesting time.");
        tokenGenerateTime = _date;
    }

    function withdrawAcb(address token_address,address _address, uint256 _amount) public onlyOwner {
        uint256 contractBalance = IERC20(token_address).balanceOf(address(this));
        require(contractBalance >= _amount," Insufficient ACB token balance.");
        IERC20(token_address).transfer(_address,_amount);
    }

    function decreaseInvestorAllowance(address _address, uint256 _amount) public onlyOwner {
        require(_amount < investors[_address].balance,"Not enough token");
        investors[_address].lockedAcb -= _amount;
        investors[_address].balance -= _amount;
        totalInvestment -= _amount;
    }
    
    function changeAcbAddress(address _address) external onlyOwner {
        acb_address = _address;
    }
    
    function transferOwnership(address _address) external onlyOwner{
        owner = _address;
    }

    function isEligibleForClaim() public view isInvestorExist returns(bool _res){
        if(!isTokenGenerateEventStarted())
            return false;
        if(!isVestingTimeStarted())
            return false;
        if(investors[msg.sender].releasedAcb > investors[msg.sender].lockedAcb)
            return false;
        if(investors[msg.sender].claimCounter > vestingDuration)
            return false;
        if(investors[msg.sender].previousClaimTime == 0)
            return true;
        if(block.timestamp > investors[msg.sender].previousClaimTime + 30*24*60*60)
            return true;
        else
            return false;
    }

    function addInvestor() payable external{
        require(!isTokenGenerateEventStarted()," Cannot add investor after Token generation started.");
        require(exchangeRate != 0,"Invalid whitelist token address.");
        
        uint256 acb_decimal = IERC20(acb_address).decimals();
        // uint256 usd_amount = _acbAmount / ( (exchangeRate * (10**(acb_decimal-decimal)) / 100));
        uint256 _acbAmount = (msg.value) * (exchangeRate * (10**acb_decimal));

        // (bool success, bytes memory data) = token.call(abi.encodeWithSelector(IERC20.transferFrom.selector, msg.sender, owner, usd_amount));
        // require(success && (data.length == 0 || abi.decode(data, (bool))), "ERROR : can't transfer");

        totalInvestment += _acbAmount;
        if(investors[msg.sender].lockedAcb != 0){
            investors[msg.sender].lockedAcb += _acbAmount;
            investors[msg.sender].balance += _acbAmount;
        } else {
            investors[msg.sender] = Investor ({
                lockedAcb:_acbAmount,
                releasedAcb:0,
                previousClaimTime:0,
                claimCounter:0,
                isTokenGenerated:false,
                balance:_acbAmount
            });
        }
        emit AddInvestor(msg.sender,msg.value,_acbAmount);
    }

    function generateToken() external isInvestorExist {
        require(isTokenGenerateEventStarted(),"Token generate event not started.");
        require(!investors[msg.sender].isTokenGenerated,"Token already generated.");
        uint256 _amount = (investors[msg.sender].lockedAcb * tgePercentage)/100;
        uint256 contractBalance = IERC20(acb_address).balanceOf(address(this));
        require(contractBalance >= _amount," Insufficient ACB token balance.");

        IERC20(acb_address).transfer(msg.sender,_amount);
        totalRelease += _amount;

        investors[msg.sender].releasedAcb += _amount;
        investors[msg.sender].balance -= investors[msg.sender].releasedAcb;
        investors[msg.sender].isTokenGenerated = true;
    }

    function calcVestingduration(address _address) public view returns(uint totalMonths, uint leftamount) {
        uint256 lastprevtime = investors[_address].previousClaimTime;
        if(lastprevtime == 0) {lastprevtime = vestingTimeStartFrom;}  

        totalMonths = (block.timestamp-lastprevtime) / (30*24*60*60);
        if(totalMonths > vestingDuration)  {totalMonths = vestingDuration - investors[_address].claimCounter;} 
        if(totalMonths < 1)   {totalMonths = 1;}

        leftamount = totalMonths*((investors[_address].lockedAcb*400)/10000);

        return (totalMonths, leftamount);
    }
    
    function claimAcb() external isInvestorExist {
        
        require(isVestingTimeStarted(),"Claim cannot be started before the vesting time started.");
        require(isEligibleForClaim(),"Not eligible for claim.");
        require(investors[msg.sender].isTokenGenerated == true,"Token not generated.");
        
        (uint claimCounter, uint _transferAmount)  = calcVestingduration(msg.sender);
        
        IERC20(acb_address).transfer(msg.sender,_transferAmount);

        investors[msg.sender].previousClaimTime = block.timestamp;
        investors[msg.sender].releasedAcb += _transferAmount;
        investors[msg.sender].claimCounter += claimCounter;
        investors[msg.sender].balance -= _transferAmount; 
        totalRelease += _transferAmount;
       
        emit Claim(address(this),msg.sender,_transferAmount);
    }
}