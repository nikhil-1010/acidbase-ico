// SPDX-License-Identifier: GPL-3.0
pragma solidity ^0.8.9;

interface IERC20 {
    function transfer(address recipient, uint256 amount) external returns (bool);
    function transferFrom(address sender, address recipient, uint256 amount) external returns (bool);
    function balanceOf(address account) external view returns (uint256);
    function decimals() external view returns (uint256);
}

contract PrivateSale {

    address public owner;
    address public acb_address;
    uint256 public tokenGenerateTime;
    uint256 public vestingDuration;      // In months
    uint256 public vestingTimeStartFrom;  //  Claim cannot start before vestingTimeStart from 
    uint256 public totalInvestment;
    uint256 public totalRelease;
    uint256 public tgePercentage;
    
    struct Investor {
        uint256 lockedAcb;        //  Locked balance
        uint256 releasedAcb;       // relesed balance
        uint256 previousClaimTime;
        uint256 claimCounter;
        bool isTokenGenerated;
        uint256 balance;     // remaining balance
    }

    mapping(address => Investor) public investors;
    mapping(address => uint256) public whiteListTokenAddress;

    event AddInvestor(address token,address indexed investor, uint256 indexed amount,uint256 indexed usd_amount);
    event Claim(address indexed sender, address indexed investor, uint256 indexed amount);

    constructor() {
        tokenGenerateTime = 1693353600;     // 30 aug 2023 UTC 00:00
        vestingTimeStartFrom = 1696032000;  // 30 sept 2023 UTC 00:00
        vestingDuration = 36;
        tgePercentage = 8;
        owner = msg.sender;
        acb_address = 0xc39326163e39900105d17334d25754179B5aaDb7;
        whiteListTokenAddress[0xA0b86991c6218b36c1d19D4a2e9Eb0cE3606eB48] = 10;
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
        require(contractBalance >= _amount," Insufficient token balance.");
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

    function addWhiteTokenAddress(address _token,uint256 _exchangeRate) external onlyOwner{
        whiteListTokenAddress[_token] = _exchangeRate;
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

    function addInvestor(address token, uint256 _acbAmount) external {
        require(!isTokenGenerateEventStarted()," Cannot add investor after Token generation started.");
        uint256 exchangeRate = whiteListTokenAddress[token];
        require(exchangeRate != 0,"Invalid whitelist token address.");

        uint256 AcbAmount = _acbAmount;
        uint256 decimal = IERC20(token).decimals();
        uint256 acb_decimal = IERC20(acb_address).decimals();
        uint256 usd_amount = AcbAmount / (exchangeRate * (10**(acb_decimal-decimal)));

        (bool success, bytes memory data) = token.call(abi.encodeWithSelector(IERC20.transferFrom.selector, msg.sender, owner, usd_amount));
        require(success && (data.length == 0 || abi.decode(data, (bool))), "ERROR : can't transfer");

        totalInvestment += AcbAmount;
        if(investors[msg.sender].lockedAcb != 0){
            investors[msg.sender].lockedAcb += AcbAmount;
            investors[msg.sender].balance += AcbAmount;
        } else {
            investors[msg.sender] = Investor ({
                lockedAcb:AcbAmount,
                releasedAcb:0,
                previousClaimTime:0,
                claimCounter:0,
                isTokenGenerated:false,
                balance:AcbAmount
            });
        }
        emit AddInvestor(token,msg.sender,AcbAmount,usd_amount);
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

    function calcVestingduration(address _address) internal view returns(uint totalMonths, uint leftamount) {
        uint count = investors[_address].claimCounter;
        uint lastprevtime = investors[_address].previousClaimTime;
        if(lastprevtime == 0)   lastprevtime = vestingTimeStartFrom;

        totalMonths = (block.timestamp-lastprevtime) / (30*24*60*60);
        if(totalMonths > vestingDuration)   totalMonths = vestingDuration - investors[_address].claimCounter;
        if(totalMonths < 1)     totalMonths = 1; 

        uint per = 0;
        for(uint i = count + 1; i <= count + totalMonths; i++){
            if(i<3) per += 4;
            else if(i<24) per += 2;
            else if(i<34) per += 3;
            else if(i<37) per += 4;
        }
        leftamount = (investors[_address].lockedAcb*per)/100;
        if(count + totalMonths  >= vestingDuration)
            leftamount = investors[_address].balance;
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