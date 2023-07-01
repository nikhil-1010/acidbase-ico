let {Web3} = require('web3')
Web3WsProvider = require('web3-providers-ws');
const Constants = require("./config/constents");
const axios = require('axios');


var methods = {
    
    'seed_addInvestor': async function () {
        
        eth_web3 = new Web3(Constants.TOKEN.WSS_URL);
        seed_wss_contract = new eth_web3.eth.Contract(Constants.TOKEN.SEED_TOKEN_ABI,Constants.TOKEN.SEED_CONTRACT_ADDRESS);
        let option = {
            fromBlock: 0
        };
        console.log(seed_wss_contract.events);



        seed_wss_contract.events.AddInvestor(option, function(error, event){ 
            console.log('event');
            console.log(event); 
        })
        .on("connected", function(subscriptionId){
            console.log(subscriptionId);
        })


        // seed_wss_contract.getPastEvents('AddInvestor', {
        //     // filter: {myIndexedParam: [20,23], myOtherIndexedParam: '0x123456789...'}, // Using an array means OR: e.g. 20 or 23
        //     fromBlock: 0,
        //     toBlock: 'latest'
        // }, function(error, events){ console.log(events); })
        // .then(function(events){
        //     console.log(events) // same results as the optional callback above
        // });
            // .on("connected", function (subscriptionId) {
            //     console.log('WSS Seed AddInvestor Connected');
            //     console.log(new Date().toLocaleString());
            //     console.log("==============================");
            // })
            // .on('data', function (event, error) {
            //     console.log(event);
            //     request_param = {
            //         "token_address": event.returnValues.token,
            //         "sale_type": 1,
            //         "trx_id": event.transactionHash,
            //         "investor": event.returnValues.investor,
            //         "amount": event.returnValues.amount,
            //         "usd_amount": event.returnValues.usd_amount,
            //     };
            //     console.log('Request params');
            //     console.log(request_param);
            //     axios.post(Constants.SITE_URL + 'add-investor-event',request_param)
            //       .then(function (response) {
            //         console.log('=========Axios Seed Response====================');
            //         console.log(response.data);
            //       })
            //       .catch(function (error) {
            //         console.log('=========Axios Seed Error====================');
            //         console.log(error);
            //     });

            // })
            // .on('error', function (error) {
            //     console.log("On Seed AddInvestor  Error: ", error);
            //     setTimeout(async function () {
            //         module.exports.seed_addInvestor();
            //     }, 3000);

            // })
            // .on('close', function (data) {
            //     console.log("On Seed AddInvestor ETH close: ", data);
            // })

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