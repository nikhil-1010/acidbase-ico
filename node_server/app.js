const express = require("express");
const app = express();


rpc = require('./rpc.js');
const Constants = require("./config/constents");
const {getPastEvents} = require("./past_event.js");



global.eth_web3 = null;

global.eth_wss_contract = null;

async function main(){
    
    rpc['seed_addInvestor']();
    // rpc['privateA_addInvestor']();
    // rpc['publicsale_addInvestor']();

    // setInterval(() => {
    //     eth_web3.currentProvider.connection.close();
    //     eth_web3 = null;
    //     rpc['seed_addInvestor']();
    //     rpc['privateA_addInvestor']();
    //     rpc['privateB_addInvestor']();
    //     rpc['publicsale_addInvestor']();
        
    // }, 600000);
    setTimeout(function(){
        console.log("Stop Script");
        process.exit(0);
    },60*60*1000);

}

app.use(express.json());
app.listen(Constants.APP_PORT, () => {
    console.log(`Example app listening at http://localhost:${Constants.APP_PORT}`);
});

app.post('/get-past-event',async function (req, res) {
	console.log('Req Body');
    console.log(req.body);  
    var response = await getPastEvents(req.body.last_block);
    console.log(response);
    res.json(response);
    // console.log(response);
});




