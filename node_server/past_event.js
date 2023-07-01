const { Web3 } = require('web3')
const axios = require('axios');
const Constants = require("./config/constents");
const getPastEvents = async (last_block) => {
    try {

        eth_web3 = new Web3(Constants.TOKEN.WSS_URL);

        //seed contract event
        seed_wss_contract = new eth_web3.eth.Contract(Constants.TOKEN.SEED_TOKEN_ABI, Constants.TOKEN.SEED_CONTRACT_ADDRESS);
        let option = {
            fromBlock: last_block,
            toBlock: 'latest'
        };

        seed_wss_contract.getPastEvents('AddInvestor', option).then(async function (events) {
            events.forEach(event => {
                request_param = {
                    "investor": event.returnValues.investor,
                    "payin_amount": eth_web3.utils.fromWei(event.returnValues.payin_amount, 'ether'),
                    "payout_amount": eth_web3.utils.fromWei(event.returnValues.payout_amount, 'ether'),
                    "trx_id": event.transactionHash,
                    "sale_type": 1
                };
                console.log('Request params');
                console.log(request_param);
                axios.post(Constants.SITE_URL + 'event/add-investor-event', request_param)
                    .then(function (response) {
                        console.log('=========Axios SEED Response====================');
                        console.log(response.data);
                    })
                    .catch(function (error) {
                        console.log('=========Axios SEED Error====================');
                        console.log(error);
                    });
            });
        });
        
        //private contract event
        private_wss_contract = new eth_web3.eth.Contract(Constants.TOKEN.PRIVATEA_TOKEN_ABI, Constants.TOKEN.PRIVATEA_CONTRACT_ADDRESS);
       
        private_wss_contract.getPastEvents('AddInvestor', option).then(async function (events) {
            events.forEach(event => {
                request_param = {
                    "investor": event.returnValues.investor,
                    "payin_amount": eth_web3.utils.fromWei(event.returnValues.payin_amount, 'ether'),
                    "payout_amount": eth_web3.utils.fromWei(event.returnValues.payout_amount, 'ether'),
                    "trx_id": event.transactionHash,
                    "sale_type": 2
                };
                console.log('Request params');
                console.log(request_param);
                axios.post(Constants.SITE_URL + 'event/add-investor-event', request_param)
                    .then(function (response) {
                        console.log('=========Axios Private Response====================');
                        console.log(response.data);
                    })
                    .catch(function (error) {
                        console.log('=========Axios Private Error====================');
                        console.log(error);
                    });
            });
        });
        
        //Public contract event
        public_wss_contract = new eth_web3.eth.Contract(Constants.TOKEN.PUBLIC_TOKEN_ABI, Constants.TOKEN.PUBLIC_CONTRACT_ADDRESS);
       
        public_wss_contract.getPastEvents('AddInvestor', option).then(async function (events) {
            events.forEach(event => {
                request_param = {
                    "investor": event.returnValues.investor,
                    "payin_amount": eth_web3.utils.fromWei(event.returnValues.payin_amount, 'ether'),
                    "payout_amount": eth_web3.utils.fromWei(event.returnValues.payout_amount, 'ether'),
                    "trx_id": event.transactionHash,
                    "sale_type": 3
                };
                console.log('Request params');
                console.log(request_param);
                axios.post(Constants.SITE_URL + 'event/add-investor-event', request_param)
                    .then(function (response) {
                        console.log('=========Axios Private Response====================');
                        console.log(response.data);
                    })
                    .catch(function (error) {
                        console.log('=========Axios Private Error====================');
                        console.log(error);
                    });
            });
        });

        
        block = await eth_web3.eth.getBlockNumber();
        hex = eth_web3.utils.numberToHex(block);
        number = eth_web3.utils.hexToNumber(hex);
        return {
            flag: 1,
            msg:'success',
            data:{
                last_block:number
            }
        }
    } catch (error) {
        return {
            flag: 0,
            msg:error,
            data:{}
        }
    }
}
module.exports = { getPastEvents }