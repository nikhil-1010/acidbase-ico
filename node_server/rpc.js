let {Web3} = require('web3')
const Constants = require("./config/constents");
const axios = require('axios');


var methods = {
    
    'seed_addInvestor': async function () {
        
        eth_web3 = new Web3(Constants.TOKEN.WSS_URL);

        seed_wss_contract = new eth_web3.eth.Contract(Constants.TOKEN.SEED_TOKEN_ABI,Constants.TOKEN.SEED_CONTRACT_ADDRESS);
        let option = {
            fromBlock: 0
        };
        // console.log(eth_web3.utils.fromWei(11100000000000000n,'ether'));
        // console.log(eth_web3.utils.isBN(await eth_web3.eth.getBlockNumber()))
        // return;
        console.log(seed_wss_contract.events);
        // seed_wss_contract.events.AddInvestor(option, function(error, event){ 
        //     console.log('event');
        //     console.log(event); 
        // })
        // .on("connected", function(subscriptionId){
        //     console.log(subscriptionId);
        // })


        seed_wss_contract.getPastEvents('AddInvestor', {
            // filter: {myIndexedParam: [20,23], myOtherIndexedParam: '0x123456789...'}, // Using an array means OR: e.g. 20 or 23
            fromBlock: 0,
            toBlock: 'latest'
        }, function(error, events){ console.log(events); })
        .then(async function(events){
            console.log(events) // same results as the optional callback above
            events.forEach(event => {
                request_param = {
                    "investor": event.returnValues.investor,
                    "payin_amount": eth_web3.utils.fromWei(event.returnValues.payin_amount,'ether'),
                    "payout_amount": eth_web3.utils.fromWei(event.returnValues.payout_amount,'ether'),
                    "trx_id":event.transactionHash,
                    "sale_type":1
                };
                console.log('Request params');
                console.log(request_param);
                axios.post(Constants.SITE_URL + 'event/add-investor-event',request_param)
                  .then(function (response) {
                    console.log('=========Axios SEED Response====================');
                    console.log(response.data);
                  })
                  .catch(function (error) {
                    console.log('=========Axios SEED Error====================');
                    console.log(error);
                });
            });
            request_param = {
                "last_block": await eth_web3.eth.getBlockNumber()
            };
            console.log('Request params');
            console.log(request_param);
            axios.post(Constants.SITE_URL + 'event/update-block-number',request_param)
              .then(function (response) {
                console.log('=========Axios PrivateSaleA Response====================');
                console.log(response.data);
              })
              .catch(function (error) {
                console.log('=========Axios PrivateSaleA Error====================');
                console.log(error);
            });
        });

    },
    'privateA_addInvestor': async function () {
        // console.log("ETH connection call..");
        eth_web3 = new Web3(Constants.TOKEN.WSS_URL);
        privateA_wss_contract = new eth_web3.eth.Contract(Constants.TOKEN.PRIVATEA_TOKEN_ABI, Constants.TOKEN.PRIVATEA_CONTRACT_ADDRESS);

        let option = {
            fromBlock: 'latest'

        };
        privateA_wss_contract.events.AddInvestor(option)
        .on("connected", function (subscriptionId) {
            console.log('WSS PrivateSaleA AddInvestor Connected');
            console.log(new Date().toLocaleString());
            console.log("==============================");
        })
        .on('data', function (event, error) {
            console.log(event);
            request_param = {
                "token_address": event.returnValues.token,
                "sale_type": 2,
                "trx_id": event.transactionHash,
                "investor": event.returnValues.investor,
                "amount": event.returnValues.amount,
                "usd_amount": event.returnValues.usd_amount,
            };
            console.log('Request params');
            console.log(request_param);
            axios.post(Constants.SITE_URL + 'add-investor-event',request_param)
              .then(function (response) {
                console.log('=========Axios PrivateSaleA Response====================');
                console.log(response.data);
              })
              .catch(function (error) {
                console.log('=========Axios PrivateSaleA Error====================');
                console.log(error);
            });
        })
        .on('error', function (error) {
            console.log("On PrivateSaleA AddInvestor Error: ", error);
            setTimeout(async function () {
                module.exports.privateA_addInvestor();
            }, 3000);

        })
        .on('close', function (data) {
            console.log("On PrivateSaleA AddInvestor close: ", data);
        })

    },
    'privateB_addInvestor': async function () {
        // console.log("ETH connection call..");
        eth_web3 = new Web3(Constants.TOKEN.WSS_URL);
        privateB_wss_contract = new eth_web3.eth.Contract(Constants.TOKEN.PRIVATEB_TOKEN_ABI, Constants.TOKEN.PRIVATEB_CONTRACT_ADDRESS);

        let option = {
            fromBlock: 'latest'

        };
        privateB_wss_contract.events.AddInvestor(option)
        .on("connected", function (subscriptionId) {
            console.log('WSS PrivateSaleB AddInvestor Connected');
            console.log(new Date().toLocaleString());
            console.log("==============================");
        })
        .on('data', function (event, error) {
            console.log(event);
            request_param = {
                "token_address": event.returnValues.token,
                "sale_type": 3,
                "trx_id": event.transactionHash,
                "investor": event.returnValues.investor,
                "amount": event.returnValues.amount,
                "usd_amount": event.returnValues.usd_amount,
            };
            console.log('Request params');
            console.log(request_param);
            axios.post(Constants.SITE_URL + 'add-investor-event',request_param)
              .then(function (response) {
                console.log('=========Axios PrivateSaleB Response====================');
                console.log(response.data);
              })
              .catch(function (error) {
                console.log('=========Axios PrivateSaleB Error====================');
                console.log(error);
            });
        })
        .on('error', function (error) {
            console.log("On PrivateSaleB AddInvestor Error: ", error);
            setTimeout(async function () {
                module.exports.privateB_addInvestor();
            }, 3000);

        })
        .on('close', function (data) {
            console.log("On PrivateSaleB AddInvestor close: ", data);
        })

    },
    'publicsale_addInvestor': async function () {
        // console.log("ETH connection call..");
        eth_web3 = new Web3(Constants.TOKEN.WSS_URL);
        publicsale_wss_contract = new eth_web3.eth.Contract(Constants.TOKEN.PUBLIC_TOKEN_ABI, Constants.TOKEN.PUBLIC_CONTRACT_ADDRESS);

        let option = {
            fromBlock: 'latest'

        };
        publicsale_wss_contract.events.AddInvestor(option)
        .on("connected", function (subscriptionId) {
            console.log('WSS PublicSale AddInvestor Connected');
            console.log(new Date().toLocaleString());
            console.log("==============================");
        })
        .on('data', function (event, error) {
            console.log(event);
            request_param = {
                "token_address": event.returnValues.token,
                "sale_type": 4,
                "trx_id": event.transactionHash,
                "investor": event.returnValues.investor,
                "amount": event.returnValues.amount,
                "usd_amount": event.returnValues.usd_amount,
            };
            console.log('Request params');
            console.log(request_param);
            axios.post(Constants.SITE_URL + 'add-investor-event',request_param)
              .then(function (response) {
                console.log('=========Axios PublicSale Response====================');
                console.log(response.data);
              })
              .catch(function (error) {
                console.log('=========Axios PublicSale Error====================');
                console.log(error);
            });
        })
        .on('error', function (error) {
            console.log("On PublicSale AddInvestor Error: ", error);
            setTimeout(async function () {
                module.exports.publicsale_addInvestor();
            }, 3000);

        })
        .on('close', function (data) {
            console.log("On PublicSale AddInvestor close: ", data);
        })

    },
}
module.exports = methods;