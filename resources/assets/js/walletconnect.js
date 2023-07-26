"use strict";

/**
 * Example JavaScript code that interacts with the page and Web3 wallets
 */

// Unpkg imports
const Web3Modal = window.Web3Modal.default;
const WalletConnectProvider = window.WalletConnectProvider.default;
let BASE_URL = $("#base_url").val();

// var web3 = new Web3(Web3.givenProvider);
var  web3;
// const ContractAddress = contractAddress;
// var CeldonContract = new web3.eth.Contract(contractABI, ContractAddress);

// Web3modal instance
let web3Modal;

// Chosen wallet provider given by the dialog window
let provider;

// Address of the selected account
let selectedAccount;

/**
 * Setup the orchestra
 */
function init() {
   console.log("Initializing example");
   console.log("WalletConnectProvider is", WalletConnectProvider);

   const providerOptions = {
      walletconnect: {
         // package: WalletConnectProvider,
         options: {
            rpc: {
               97: "https://speedy-nodes-nyc.moralis.io/c415cc39a145c4104109b7b0/bsc/testnet",
               56: "https://bsc-dataseed.binance.org/",
            },
            infuraId: "9aa3d95b3bc440fa88ea12eaa4456161",
             qrcodeModalOptions: {
               mobileLinks: [
                 "metamask",            
               ],
             },
         },
      },
   };

   web3Modal = new Web3Modal({
      cacheProvider: true, // optional
      providerOptions, // required
   });
}

$(document).ready(async function () {
    if (localStorage.getItem("WEB3_CONNECT_CACHED_PROVIDER") != null) {
        init();
        onConnect();
        $("#dis-connect").removeClass("d-none");
    } else {
      //   const cId = await web3.eth.getChainId();
      //   var chainID = Number(c_id);
      //   if (cId != chainID) {
      //       $("#change-network").modal("show");
      //   }
        $("#btn-connect").removeClass("d-none");
        return false;
    }
});

async function fetchAccountData() {
   // Get a Web3 instance for the wallet
   web3 = new Web3(provider);
   // Get connected chain id from Ethereum node
   const chainId = await web3.eth.getChainId();
   var chainID = Number(c_id);
   if (chainId != chainID) {
      selectedAccount = null;
      $("#change-chain-modal").modal("show");
      $("#btn-disconnect").addClass("d-none");
      $("#btn-connect").removeClass("d-none");

      return false;
   }
   $("#change-chain-modal").modal("hide");

   // Get list of accounts of the connected wallet
   const accounts = await web3.eth.getAccounts();

   // MetaMask does not give you all accounts, only the selected account
   selectedAccount = accounts[0];
   $("#address").val(selectedAccount);
   if (is_live == "local" || is_live == "test") {
      $("#etherscan_address").attr(
         "href",
         "https://ropsten.etherscan.io/address/" + selectedAccount
      );
   } else {
      $("#etherscan_address").attr(
         "href",
         "https://etherscan.io/address/" + selectedAccount
      );
   }

   let connectedAddress =
      selectedAccount.substr(0, 4) +
      " ... " +
      selectedAccount.substr(selectedAccount.length - 4, 4);

   $("#btn-disconnect").html(connectedAddress);
   $(".meta_address").html(connectedAddress);
   $("#btn-disconnect").removeClass("d-none");
   $("#btn-connect").addClass("d-none");

   const rowResolvers = accounts.map(async (address) => {
      const balance = await web3.eth.getBalance(address);
      const ethBalance = web3.utils.fromWei(balance, "ether");
      const humanFriendlyBalance = parseFloat(ethBalance).toFixed(4);
   });
   await Promise.all(rowResolvers);
}

async function onConnect() {
      try {
   
       provider = await web3Modal.connect();
       $("#ConnectMetamask").hide();
       $("#dis-connect").removeClass("d-none");
       $("#connect").addClass("d-none");
       $("#confirm-order-btn").removeClass("d-none");
       $("#connectWallet").addClass("d-none");

       $("#btn-disconnect-sidebar").removeClass("d-none");
       $("#connect-sidebar").addClass("d-none");

   } catch (e) {

       localStorage.removeItem("WEB3_CONNECT_CACHED_PROVIDER");
       selectedAccount = null;
       $("#dis-connect").addClass("d-none");
       $("#connect").removeClass("d-none");
       $("#btn-disconnect-sidebar").addClass("d-none");
       $("#connect-sidebar").removeClass("d-none");
       // Toast("Please connect to your wallet.", 3000, 0);
       return false;

   }
   
   var check = JSON.parse(
       localStorage.getItem("WEB3_CONNECT_CACHED_PROVIDER")
   );
   // if (check == "injected") {
   //     if (typeof ethereum == "undefined") {
   //         console.log('dfsf');
   //         // Toast(
   //         //     "There appears to be no Metamask Install on your browser, please try another browser or use wallet connect.",
   //         //     6000,
   //         //     0
   //         // );
   //         try {
   //             if (provider.close) {
   //                 await provider.disconnect();
   //                 await web3Modal.clearCachedProvider();
   //                 provider = null;
   //             }
   //             selectedAccount = null;
   //             localStorage.removeItem("WEB3_CONNECT_CACHED_PROVIDER");
   //             $('#btn-disconnect').addClass('d-none');
   //             $('#connect').removeClass('d-none');
   //             $('#confirm-order-btn').addClass('d-none');
   //             $('#connectWallet').removeClass('d-none');
   //         } catch (error) {
   //             console.log(error);
   //             selectedAccount = null;
   //             localStorage.removeItem("WEB3_CONNECT_CACHED_PROVIDER");
   //             localStorage.removeItem("WALLETCONNECT_DEEPLINK_CHOICE");
   //             $('#btn-disconnect').addClass('d-none');
   //             $('#connect').removeClass('d-none');
   //             $('#confirm-order-btn').addClass('d-none');
   //             $('#connectWallet').removeClass('d-none');
   //         }
   //         // localStorage.removeItem("WEB3_CONNECT_CACHED_PROVIDER");
   //         return;
   //     }
   // }
   return await fetchAccountData();
}

async function onDisconnect() {
   if (provider.close) {
      await provider.disconnect();
      await web3Modal.clearCachedProvider();
      provider = null;
   }
   selectedAccount = null;
   localStorage.removeItem("WEB3_CONNECT_CACHED_PROVIDER");

   $("#btn-connect").removeClass("d-none");
   $("#btn-disconnect").addClass("d-none");
}

// $("#connect").click(async function (event) {
//     await init();
//     var flag = await onConnect();
//     if (flag != false) {
//         location.reload();
//     }
// });

// $(document).on("click", "#disconnect-btn", function (event) {
//     $("#disconnect-model").modal("hide");
//     onDisconnect();
//     setTimeout(function () {
//         location.reload();
//     }, 600);
// });
// $(document).on("click", "#disconnect-btn", async function (event) {
//    $("#disconnect-metamask-modal").modal("hide");
//    onDisconnect();
//    await RefreshPageDetail(); //function To execute
// });
$("#btn-disconnect").click(function () {
   $("#disconnect-metamask-modal").modal("show");
});

if (is_live == "local" || is_live == "test") {
   bnb_block_url = "https://testnet.bscscan.com";
   WEB3_RPC_URL = "https://data-seed-prebsc-1-s1.binance.org:8545/";
} else {
   bnb_block_url = "https://etherscan.io/";
   WEB3_RPC_URL = "https://mainnet.infura.io/v3/9aa3d95b3bc440fa88ea12eaa4456161";
}

$(document).on("click", "#change-network-btn", async function (event) {
   chain = web3.utils.toHex(c_id);

   try {
      await ethereum.request({
         method: "wallet_switchEthereumChain",
         params: [{ chainId: chain }],
      });
   } catch (switchError) {
      if (switchError.code === 4902) {
         try {
            await ethereum.request({
               method: "wallet_addEthereumChain",
               params: [
                  {
                     chainId: chain,
                     chainName: "Binance Smart Chain",
                     nativeCurrency: {
                        name: "Binance Coin",
                        symbol: "BNB",
                        decimals: 18,
                     },
                     blockExplorerUrls: [bnb_block_url],
                     rpcUrls: [WEB3_RPC_URL],
                  },
               ],
            });
         } catch (error) {
            console.log("---error---");
            console.log(error);
         }
      }
   }
});

$(document).on("click", "#copy_referal_link", function (event) {
   var value = $("#copy_referal_link").val();
   var $temp = $("<input>");
   $("body").append($temp);
   $temp.val(value).select();
   document.execCommand("copy");
   $temp.remove();
   Toast("Copied", 3000, 1);
});

$(document).on("click", "#copy_address", async function (event) {
   var value = selectedAccount;
   var $temp = $("<input>");
   $("#disconnect-metamask-modal").append($temp);
   $temp.val(value).select();
   document.execCommand("copy");
   $temp.remove();
   Toast("Address Copied.", 3000, 1);
});
