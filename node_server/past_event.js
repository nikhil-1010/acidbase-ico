const getPastEvents = async(last_block) => {
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
        });
        response = {
            
        }
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
}
module.exports = { ownerOfToken }