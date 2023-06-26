var TokenContract;
var PreSaleContract;
var PublicSaleContract;
var SeedContract;
var PrivateAContract;
var PrivateBContract;
var preSaleTimer;
var publicSaleTimer;
var seedTimer;
var privateATimer;
var privateBTimer;
var usdPrice;
// today = (new Date()).toISOString().split('T')[0];
today = parseInt(new Date().getTime() / 1000);
var seeddate = parseInt($("#seeddate").val());
var privateAdate = parseInt($("#privateAdate").val());
var publicsaledate = parseInt($("#publicsaledate").val());
var hash = "";
function hideShowTabs() {
   hash = window.location.href.split("#")[1];
   if (typeof hash == "undefined") {
      var url = window.location.href.split("#")[0] + "#seed";
      window.location.replace(url);
   }
   if (hash == "seed" || hash == undefined) {
      if (currentTime <= SeedEndDate) {

         $("#seed").addClass("active");
         $("#seed").addClass("show");
         $("#private_sale_msg").addClass("d-none");
         $("#public_sale_msg").addClass("d-none");

         $("#seed-tab").addClass("active");
         $("#private-sale-a-tab").removeClass("active");
         $("#private-sale-b-tab").removeClass("active");
         $("#publicsale-tab").removeClass("active");

         $("#seed-inner-tab").addClass("show");
         $("#seed-inner-tab").addClass("active");
         $("#seed-inner").addClass("active");
         $("#seed-inner").addClass("show");

         $("#seed-payment-history").removeClass("show");
         $("#seed-payment-history").removeClass("active");
         $("#seed-pay-now-div").removeClass("show");
         $("#seed-pay-now-div").removeClass("active");
         $("#seed-payment-history-tab").removeClass("active");
         $("#seed-payment-history-tab").removeClass("show");
         urlreplace("seed", "seed-tab");
      } else if (currentTime >= PrivateStartDate && currentTime <= PrivateEndDate) {

         $("#seed").removeClass("active");
         $("#seed").removeClass("show");

         $("#privateA").addClass("active");
         $("#privateA").addClass("show");

         $("#private_sale_msg").removeClass("d-none");
         $("#public_sale_msg").addClass("d-none");

         $("#private-sale-a-tab").addClass("active");
         $("#private-sale-b-tab").removeClass("active");
         $("#seed-tab").removeClass("active");
         $("#publicsale-tab").removeClass("active");

         $("#privateA-inner-tab").addClass("show");
         $("#privateA-inner-tab").addClass("active");
         $("#privateA-inner").addClass("active");
         $("#privateA-inner").addClass("show");

         urlreplace("privateA", "private-sale-a-tab");
      } else {

         $("#publicsale-tab").addClass("active");
         $("#private_sale_msg").addClass("d-none");
         $("#public_sale_msg").removeClass("d-none");
         $("#white-list-tab").removeClass("active");
         $("#private-sale-a-tab").removeClass("active");
         $("#private-sale-b-tab").removeClass("active");

         $("#seed").removeClass("active");
         $("#seed").removeClass("show");
         $("#privateA").removeClass("active");
         $("#privateA").removeClass("show");
         $("#privateB").removeClass("active");
         $("#privateB").removeClass("show");

         $("#public-sale").addClass("active");
         $("#public-sale").addClass("show");

         $("#publicsale-div").removeClass("d-none");
         $("#publicsale-pay-now-div").addClass("d-none");
         $("#publicsale-payment-history-tab").removeClass("active");
         $("#publicsale-payment-history-tab").removeClass("show");
         $("#publicsale-payment-history").removeClass("active");
         $("#publicsale-payment-history").removeClass("show");
         $("#series-inner-b-tab").addClass("show");
         $("#series-inner-b-tab").addClass("active");
         $("#series-inner-b").addClass("active");
         $("#series-inner-b").addClass("show");
         $("#publicsale-buy-now-div").addClass("d-none");

         urlreplace("PublicSale", "publicsale-tab");
      }
   } else if (hash == "privateA") {
      if (currentTime <= SeedEndDate) {

         $("#seed").addClass("active");
         $("#seed").addClass("show");

         $("#seed-tab").addClass("active");

         $("#private_sale_msg").addClass("d-none");
         $("#public_sale_msg").addClass("d-none");

         $("#private-sale-a-tab").removeClass("active");
         $("#private-sale-b-tab").removeClass("active");
         $("#publicsale-tab").removeClass("active");

         $("#seed-inner-tab").addClass("show");
         $("#seed-inner-tab").addClass("active");
         $("#seed-inner").addClass("active");
         $("#seed-inner").addClass("show");
         $("#privateA").removeClass('show');
         $("#privateA").removeClass('active');

         urlreplace("seed", "seed-tab");
      } else if (currentTime >= PrivateStartDate && currentTime <= PrivateEndDate) {

         $("#seed").removeClass("active");
         $("#seed").removeClass("show");

         $("#privateA").addClass("active");
         $("#privateA").addClass("show");

         $("#private_sale_msg").removeClass("d-none");
         $("#public_sale_msg").addClass("d-none");

         $("#private-sale-a-tab").addClass("active");
         $("#private-sale-b-tab").removeClass("active");
         $("#seed-tab").removeClass("active");
         $("#publicsale-tab").removeClass("active");

         $("#privateA-inner-tab").addClass("show");
         $("#privateA-inner-tab").addClass("active");
         $("#privateA-inner").addClass("active");
         $("#privateA-inner").addClass("show");

         urlreplace("privateA", "private-sale-a-tab");
      } else {

         $("#publicsale-tab").addClass("active");
         $("#private_sale_msg").addClass("d-none");
         $("#public_sale_msg").removeClass("d-none");
         $("#private-sale-a-tab").removeClass("active");
         $("#private-sale-b-tab").removeClass("active");

         $("#seed").removeClass("active");
         $("#seed").removeClass("show");
         $("#privateA").removeClass("active");
         $("#privateA").removeClass("show");
         $("#privateB").removeClass("active");
         $("#privateB").removeClass("show");

         $("#public-sale").addClass("active");
         $("#public-sale").addClass("show");

         $("#publicsale-div").removeClass("d-none");
         $("#publicsale-pay-now-div").addClass("d-none");
         $("#publicsale-payment-history-tab").removeClass("active");
         $("#publicsale-payment-history-tab").removeClass("show");
         $("#publicsale-payment-history").removeClass("active");
         $("#publicsale-payment-history").removeClass("show");
         $("#series-inner-b-tab").addClass("show");
         $("#series-inner-b-tab").addClass("active");
         $("#series-inner-b").addClass("active");
         $("#series-inner-b").addClass("show");
         $("#publicsale-buy-now-div").addClass("d-none");

         urlreplace("PublicSale", "publicsale-tab");
      }
   } else if (hash == "PublicSale") {
      $("#publicsale-tab").addClass("active");
      $("#private_sale_msg").addClass("d-none");
      $("#public_sale_msg").removeClass("d-none");
      $("#white-list-tab").removeClass("active");
      $("#private-sale-a-tab").removeClass("active");
      $("#private-sale-b-tab").removeClass("active");
      $("#kol-sale-tab").removeClass("active");

      $("#seed").removeClass("active");
      $("#seed").removeClass("show");
      $("#privateA").removeClass("active");
      $("#privateA").removeClass("show");
      $("#privateB").removeClass("active");
      $("#privateB").removeClass("show");

      $("#public-sale").addClass("active");
      $("#public-sale").addClass("show");

      $("#publicsale-div").removeClass("d-none");
      $("#publicsale-pay-now-div").addClass("d-none");
      $("#publicsale-payment-history-tab").removeClass("active");
      $("#publicsale-payment-history-tab").removeClass("show");
      $("#publicsale-payment-history").removeClass("active");
      $("#publicsale-payment-history").removeClass("show");
      $("#series-inner-b-tab").addClass("show");
      $("#series-inner-b-tab").addClass("active");
      $("#series-inner-b").addClass("active");
      $("#series-inner-b").addClass("show");
      $("#publicsale-buy-now-div").addClass("d-none");

      // $("#public-sale").removeClass('show');
      // $("#public-sale").removeClass('active');

      urlreplace("PublicSale", "publicsale-tab");
   } else {
      hash = window.location.href.split("#")[1];
   }
}

jQuery(document).ready(async function ($) {
   setTimeout(() => {
      $(".box-loader").hide();
   }, 5000);

   if (localStorage.getItem("WEB3_CONNECT_CACHED_PROVIDER") != null) {
      await init();
      await onConnect();
      RefreshPageDetail(); //function To execute
   } else {
      $("#connect-wallet-div").addClass("d-none");
      $("#disconnect-wallet-div").removeClass("d-none");
   }

   $("#seed-tab").click(async function () {
      $("#private_sale_msg").addClass("d-none");
      $("#public_sale_msg").addClass("d-none");

      var url = window.location.href.split("#")[0] + "#seed";
      window.location.replace(url);
      $(".box-loader").show();
      await getSeedInvestorDetail(SeedContract, selectedAccount);
   });
   $("#private-sale-a-tab").click(async function () {
      $("#private_sale_msg").removeClass("d-none");
      $("#public_sale_msg").addClass("d-none");
      var url = window.location.href.split("#")[0] + "#privateA";
      window.location.replace(url);
      $(".box-loader").show();
      await getPrivateAInvestorDetail(PrivateAContract, selectedAccount);

   });
   $("#private-sale-b-tab").click(async function () {
      $("#private_sale_msg").removeClass("d-none");
      $("#public_sale_msg").addClass("d-none");
      var url = window.location.href.split("#")[0] + "#privateB";
      window.location.replace(url);
      $(".box-loader").show();
      await getPrivateBInvestorDetail(PrivateBContract, selectedAccount);
   });

   $("#publicsale-tab").click(async function () {
      $("#public_sale_msg").removeClass("d-none");
      $("#private_sale_msg").addClass("d-none");
      var url = window.location.href.split("#")[0] + "#PublicSale";
      window.location.replace(url);
      $(".box-loader").show();
      await getPublicSaleInvestorDetail(PublicSaleContract, selectedAccount);
   });
   $("#publicsale_token_amount").on("cut copy paste", function (e) {
      e.preventDefault();
   });

   if (selectedAccount == undefined) {
      return;
   }


   // SeedContract = new web3.eth.Contract(SeedAbi, SeedContractAddress);
   // PrivateAContract = new web3.eth.Contract(PrivateAAbi,PrivateSaleContractAddress);
   // PrivateBContract = new web3.eth.Contract(PrivateBAbi,PrivateBContractAddress);
   // PublicSaleContract = new web3.eth.Contract(PublicSaleAbi,PublicSaleContractAddress);
});

$("#btn-connect").click(async function (event) {
   await init();
   await onConnect();
   await RefreshPageDetail(); //function To execute
});

$(document).on("click", "#disconnect-btn", async function (event) {
   $("#disconnect-metamask-modal").modal("hide");
   onDisconnect();
   await RefreshPageDetail(); //function To execute
});

try {
   ethereum.on("accountsChanged", async (_chainId) => {
      await init();
      await onConnect();
      // await RefreshPageDetail(); //function To execute
   });
} catch (e) { }
try {
   ethereum.on("chainChanged", async (_chainId) => {
      await init();
      await onConnect();
      // await RefreshPageDetail(); //function To execute
   });
} catch (e) { }

function urlreplace(series, tab) {
   var url = window.location.href.split("#")[0] + "#" + series;
   hash = series;
   window.location.replace(url);
   $("#" + tab).trigger("click");
}
function getCoin(coin_id) {
   var coin_info = localStorage.getItem('coins')
   coin_info = JSON.parse(coin_info);
   return coin_info.find(el => el.id == coin_id)
}

async function RefreshPageDetail() {
   console.log("Selected Account : ", selectedAccount);
   if (typeof selectedAccount == "undefined" || selectedAccount == null) {
      $("#connect-wallet-div").addClass("d-none");
      $("#disconnect-wallet-div").removeClass("d-none");
      clearInterval(publicSaleTimer);
      clearInterval(privateATimer);
      clearInterval(seedTimer);
      clearInterval(privateBTimer);
      return false;
   } else {
      $("#connect-wallet-div").removeClass("d-none");
      $("#address").val(selectedAccount);
      $(".Wallet_address").val(selectedAccount);
      $("#disconnect-wallet-div").addClass("d-none");
      filters.investor_address = $(".Wallet_address").val();
      filterData(PrivateTransactionHistoryUrl, "publicsale-payment-history-table");
      filters.investor_address = $(".Wallet_address").val();
      filterData(seedTransactionHistoryUrl, "seed-payment-history-table");
      filters.investor_address = $(".Wallet_address").val();
      filterData(PrivateTransactionHistoryUrl, "private-payment-history-table");

      SeedContract = new web3.eth.Contract(SeedAbi, SeedContractAddress);
      // PrivateAContract = new web3.eth.Contract(PrivateAAbi, PrivateSaleContractAddress);
      // PublicSaleContract = new web3.eth.Contract(PublicSaleAbi, PublicSaleContractAddress);

      hideShowTabs();
   }
   $('#seed_coin_dropdown li:first').trigger('click');
   $('#privateA_coin_dropdown li:first').trigger('click');
   $('#privateB_coin_dropdown li:first').trigger('click');
   $('#publicsale_coin_dropdown li:first').trigger('click');
   TokenContract = new web3.eth.Contract(TokenAbi, TokenContractAddress);
   await getTokenBalance(TokenContract, selectedAccount);
   // await getTokenUsdPrice(TokenContract);
   await getSeedInvestorDetail(SeedContract, selectedAccount);
   // await getPrivateAInvestorDetail(PrivateAContract, selectedAccount);
   // await getPublicSaleInvestorDetail(PublicSaleContract, selectedAccount);
   if (hash == "seed") {
      if (today <= seeddate) {
         await getSeedInvestorDetail(SeedContract, selectedAccount);
      }
      $('#publicsale-buy-btn-div').addClass('d-none');
      $('#privateA-buy-btn-div').addClass('d-none');
      $('#privateB-buy-btn-div').addClass('d-none');
   }
   if (hash == "privateA") {
      if (today <= privateAdate) {
         await getPrivateAInvestorDetail(PrivateAContract, selectedAccount);
      }
      $('#seed-buy-btn-div').addClass('d-none');
      $('#publicsale-buy-btn-div').addClass('d-none');
      $('#privateB-buy-btn-div').addClass('d-none');
      $('#seed-waiting-time-div').addClass('d-none');

   }
   if (hash == "privateB") {
      if (today <= privateBdate) {
         await getPrivateBInvestorDetail(PrivateBContract, selectedAccount);
      }
      $('#seed-buy-btn-div').addClass('d-none');
      $('#privateA-buy-btn-div').addClass('d-none');
      $('#publicsale-buy-btn-div').addClass('d-none');
      $('#seed-waiting-time-div').addClass('d-none');
      $('#privateA-waiting-time-div').addClass('d-none');
   }
   if (hash == "PublicSale") {
      // if (today <= publicsaledate) {
      // }
      await getPublicSaleInvestorDetail(PublicSaleContract, selectedAccount);
      $('#seed-buy-btn-div').addClass('d-none');
      $('#privateA-buy-btn-div').addClass('d-none');
      $('#privateB-buy-btn-div').addClass('d-none');
      $('#seed-waiting-time-div').addClass('d-none');
      $('#privateA-waiting-time-div').addClass('d-none');
      $('#privateB-waiting-time-div').addClass('d-none');
   }
   HideAllTab(SeedContract, selectedAccount, "seed");
   HideAllTab(PrivateAContract, selectedAccount, "private-sale-a");
   HideAllTab(PrivateBContract, selectedAccount, "private-sale-b");
   HideAllTab(PublicSaleContract, selectedAccount, "publicsale");
}

//======================== Public Sale Start=============================//
async function getPublicSaleInvestorDetail(contract, address) {
   clearInterval(publicSaleTimer);
   PublicInvestor = await getInvestorDetail(contract, address);
   console.log("Publicsale Investor");
   console.log(PublicInvestor);
   locked_token = number_format(
      web3.utils.fromWei(PublicInvestor["lockedAcb"], "ether")
   );
   released_token = number_format(
      web3.utils.fromWei(PublicInvestor["releasedAcb"], "ether")
   );
   $("#publicsale-locked-balance").html(locked_token);
   $("#publicsale-release-balance").html(released_token);

   var PublicTimer;

   console.log("------------------------------------");
   console.log("Public Call After Time Interval Clear");
   console.log("------------------------------------");
   // if(today>publicsaledate){
   //    return false;
   // }
   Publicsale_TG_started = await isTokenGenerateStarted(contract);
   if (!Publicsale_TG_started) {
      $("#publicsale-buy-btn-div").removeClass("d-none");

      $("#public-sale-waiting-time-div").removeClass("d-none");
      $("#publicsale-time-lable").text("Token Generate Starts In :");
      publicSale_TG_time = await getTokenGenerateTime(contract);
      PublicTimer = publicSale_TG_time;
   } else {
      $("#publicsale-buy-btn-div").addClass("d-none");

      // PublicInvestor = await getInvestorDetail(contract, address);
      if (!PublicInvestor["tokenGenerated"]) {
         if (PublicInvestor["lockedAcb"] != 0) {
            $("#publicsale-tg-now-div").removeClass("d-none");
         }
      }

      console.log("Public Vesting Time Over Claim button show");
      if (parseInt(PublicInvestor["lockedAcb"]) == 0 && parseInt(PublicInvestor["releasedAcb"]) == 0) {
         $("#publicsale_over_div").removeClass("d-none");
         $("#publicsale_claim_over_div").addClass("d-none");
         $('#publicsale-buy-btn-div').addClass('d-none');
         $('#publicsale-tg-now-div').addClass('d-none');
         $('#publicsale-claim-now-div').addClass('d-none');
      } else {
         $("#publicsale_over_div").addClass("d-none");
         Publicsale_vesting_started = await isVestingTimeStarted(contract);
         if (!Publicsale_vesting_started) {
            $("#public-sale-waiting-time-div").removeClass("d-none");
            // $('#publicsale-buy-btn-div').removeClass('d-none');
            $("#publicsale-time-lable").text("Vesting Starts In:");
            publicSale_Vesting_time = await getVestingTime(contract);

            PublicTimer = publicSale_Vesting_time;
         } else {
            $("#public-sale-waiting-time-div").addClass("d-none");

            // PublicInvestor = await getInvestorDetail(contract, address);
            console.log("Investor Call");
            if (!PublicInvestor["tokenGenerated"]) {
               if (PublicInvestor["lockedAcb"] != 0) {
                  $("#publicsale-tg-now-div").removeClass("d-none");
                  $("#publicsale-claim-now-div").addClass("d-none");
               }
            } else {
               isclaim = await isEligibleForClaim(contract);
               if (isclaim) {
                  // clearInterval(PreSaleTimer);
                  console.log("claim Button Show");
                  $("#publicsale-claim-now-div").removeClass("d-none");
                  $("#publicsale-tg-now-div").addClass("d-none");
               } else {
                  if (parseInt(PublicInvestor["releasedAcb"]) == parseInt(PublicInvestor["lockedAcb"])) {
                     $("#publicsale_claim_over_div").removeClass("d-none");
                     $("#publicsale_over_div").addClass("d-none");
                     $("#publicsale-claim-now-div").addClass("d-none");
                  } else {
                     $("#publicsale-claim-now-div").addClass("d-none");
                     var previousClaimTime = parseInt(PublicInvestor["previousClaimTime"]);
                     if (is_live != "live") {
                        addNextClaimTime = 2 * 60; // local
                     } else {
                        addNextClaimTime = 24 * 60 * 60 * 30 // live
                     }
                     nextClaimTime = (previousClaimTime + addNextClaimTime) * 1000;
                     console.log(nextClaimTime);
                     $("#public-sale-waiting-time-div").removeClass("d-none");
                     $("#publicsale-time-lable").text("Next Claim Time :");
                     PublicTimer = nextClaimTime;
                  }
               }
            }
         }
      }
   }

   if (PublicTimer - Date.now() > 0) {
      publicSaleTimer = setInterval(function () {
         makePublicSaleTimer(PublicTimer);
      }, 1000);
   }
   $(".box-loader").hide();
}
//======================== Public Sale End=============================//

//======================== Seed Sale Start=============================//
async function getSeedInvestorDetail(contract, address) {
   // filters.investor_address = $("#address").val();
   // filterData(url,'presale-payment-history-table');
   clearInterval(seedTimer);
   SeedInvestor = await getInvestorDetail(contract, address);
   console.log("Seed Investor");
   console.log(SeedInvestor);
   locked_token = number_format(
      web3.utils.fromWei(SeedInvestor["lockedAcb"], "ether")
   );
   released_token = number_format(
      web3.utils.fromWei(SeedInvestor["releasedAcb"], "ether")
   );
   $("#seed-locked-balance").html(locked_token);
   $("#seed-release-balance").html(released_token);

   var SeedTimer;

   console.log("------------------------------------");
   console.log("Seed Call After Time Interval Clear");
   console.log("------------------------------------");
   // if(today>seeddate){
   //    return false;
   // }
   Seed_TG_started = await isTokenGenerateStarted(contract);
   if (!Seed_TG_started) {
      $("#seed-buy-btn-div").removeClass("d-none");

      $("#seed-waiting-time-div").removeClass("d-none");
      $("#seed-time-lable").text("Token Generate Starts In :");
      Seed_TG_time = await getTokenGenerateTime(contract);
      console.log("Inside Token Genration>>>>>>>>>>>>>>>>>>>.", Seed_TG_time);

      SeedTimer = Seed_TG_time;
   } else {
      $("#seed-buy-btn-div").addClass("d-none");
      // SeedInvestor = await getInvestorDetail(contract, address);
      if (!SeedInvestor["tokenGenerated"]) {
         if (SeedInvestor["lockedAcb"] != 0) {
            $("#seed-tg-now-div").removeClass("d-none");
         } else {
            $("#seed-tg-now-div").addClass("d-none");
         }
      }
      console.log("Seed Vesting Time Over Claim button show");
      if (parseInt(SeedInvestor["lockedAcb"]) == 0 && parseInt(SeedInvestor["releasedAcb"]) == 0) {
         $("#seed_over_div").removeClass("d-none");
         $("#seed_claim_over_div").addClass("d-none");
         // $("#seed-tab").prop("disabled", true);
         $('#seed-tg-now-div').addClass('d-none');
         $('#seed-buy-btn-div').addClass('d-none');
         $('#seed-claim-now-div').addClass('d-none');
      } else {
         $("#seed_over_div").addClass("d-none");
         Seed_vesting_started = await isVestingTimeStarted(contract);
         if (!Seed_vesting_started) {
            $("#seed-waiting-time-div").removeClass("d-none");
            $("#seed-time-lable").text("Vesting Starts In:");
            seed_Vesting_time = await getVestingTime(contract);

            SeedTimer = seed_Vesting_time;
         } else {
            $("#seed-waiting-time-div").addClass("d-none");

            // SeedInvestor = await getInvestorDetail(contract, address);
            console.log("Investor Call");
            if (!SeedInvestor["tokenGenerated"]) {
               if (SeedInvestor["lockedAcb"] != 0) {
                  $("#seed-tg-now-div").removeClass("d-none");
                  $("#seed_over_div").addClass("d-none");
                  $("#seed-claim-now-div").addClass("d-none");
               } else {
                  $("#seed-tg-now-div").addClass("d-none");
               }
            } else {
               isclaim = await isEligibleForClaim(contract);
               console.log("isclaim >>>>>>>>>>>>>>>>", isclaim);
               if (isclaim) {
                  console.log("claim Button Show");
                  $("#seed-claim-now-div").removeClass("d-none");
                  $("#seed-tg-now-div").addClass("d-none");
               } else {
                  if (parseInt(SeedInvestor["releasedAcb"]) == parseInt(SeedInvestor["lockedAcb"])) {
                     $("#seed_claim_over_div").removeClass("d-none");
                     $("#seed_over_div").addClass("d-none");
                     $("#seed-claim-now-div").addClass("d-none");

                  } else {
                     $("#seed-claim-now-div").addClass("d-none");
                     var previousClaimTime = parseInt(SeedInvestor["previousClaimTime"]);
                     if (is_live != "live") {
                        addNextClaimTime = 2 * 60; // local
                     } else {
                        addNextClaimTime = 24 * 60 * 60 * 30 // live
                     }
                     nextClaimTime =
                        (previousClaimTime + addNextClaimTime) * 1000;
                     $("#seed-waiting-time-div").removeClass("d-none");
                     $("#seed-time-lable").text("Next Claim Time :");
                     SeedTimer = nextClaimTime;
                     console.log(
                        "Next Cliam time>>>>>>>>>>>>>>>>>>>>>>>>>",
                        nextClaimTime
                     );
                  }
               }
            }
         }
      }
   }

   debugger
   if (SeedTimer - Date.now() > 0) {
      //var deadline = new Date(Date.parse(new Date()) + 12 * 24 * 60 * 60 * 1000);
      var deadline = new Date(SeedTimer);
      var c = new Clock(deadline, function () {
         $('#seed-waiting-time-div').addClass('d-none');
      });
      var page_timer = $('#flip_timer');
      page_timer.append(c.el);
      // seedTimer = setInterval(function () {
      //    makeSeedTimer(SeedTimer);
      // }, 1000);
   }else{
      $('#seed-waiting-time-div').addClass('d-none');
   }
   $(".box-loader").hide();
}
//======================== Seed Sale End=============================//

//======================== Private A Sale Start=============================//
async function getPrivateAInvestorDetail(contract, address) {
   // filters.investor_address = $("#address").val();
   // filterData(url,'presale-payment-history-table');
   clearInterval(privateATimer);
   PrivateAInvestor = await getInvestorDetail(contract, address);
   console.log("PrivateA Investor");
   console.log(PrivateAInvestor);
   locked_token = number_format(
      web3.utils.fromWei(PrivateAInvestor["lockedAcb"], "ether")
   );
   released_token = number_format(
      web3.utils.fromWei(PrivateAInvestor["releasedAcb"], "ether")
   );
   $("#privateA-locked-balance").html(locked_token);
   $("#privateA-release-balance").html(released_token);

   var PrivateATimer;

   console.log("------------------------------------");
   console.log("Private A Call After Time Interval Clear");
   console.log("------------------------------------");
   // if(today>privateAdate){
   //    return false;
   // }
   privateA_TG_started = await isTokenGenerateStarted(contract);
   if (!privateA_TG_started) {
      let status = false;
      await postAjax(whitelist_check_url, { address: address, is_sale: 1 }, function (res) {
         status = res.status;
      });
      if (status == false) {
         $("#privateA-whitelist-btn-div").removeClass("d-none");
         $("#privateA-buy-btn-div").addClass("d-none");
      } else {
         $("#privateA-whitelist-btn-div").addClass("d-none");
         $("#privateA-buy-btn-div").removeClass("d-none");
      }
      $("#privateA-waiting-time-div").removeClass("d-none");
      $("#privateA-time-lable").text("Token Generate Starts In :");
      PrivateA_TG_time = await getTokenGenerateTime(contract);
      console.log(
         "Inside Token Genration>>>>>>>>>>>>>>>>>>>.",
         PrivateA_TG_time
      );

      PrivateATimer = PrivateA_TG_time;
   } else {
      console.log("Elase Call==================>");
      $("#privateA-buy-btn-div").addClass("d-none");

      // PrivateAInvestor = await getInvestorDetail(contract, address);
      if (!PrivateAInvestor["tokenGenerated"]) {
         if (PrivateAInvestor["lockedAcb"] != 0) {
            $("#privateA-tg-now-div").removeClass("d-none");
         }
      }

      console.log("Private A Vesting Time Over Claim button show!");
      if (parseInt(PrivateAInvestor["lockedAcb"]) == 0 && parseInt(PrivateAInvestor["releasedAcb"]) == 0) {
         console.log("if call");
         $("#privateA_claim_over_div").addClass("d-none");
         $("#privateA_over_div").removeClass("d-none");
         // $("#private-sale-a-tab").prop("disabled", true);
         $('#privateA-buy-btn-div').addClass('d-none');
         $('#privateA-tg-now-div').addClass('d-none');
         $('#privateA-claim-now-div').addClass('d-none');
      } else {
         $("#privateA_over_div").addClass("d-none");
         PrivateA_vesting_started = await isVestingTimeStarted(contract);
         if (!PrivateA_vesting_started) {
            $("#privateA-waiting-time-div").removeClass("d-none");
            // $('#privateA-buy-btn-div').removeClass('d-none');
            $("#privateA-time-lable").text("Vesting Starts In:");
            privateA_Vesting_time = await getVestingTime(contract);

            PrivateATimer = privateA_Vesting_time;
         } else {
            $("#privateA-waiting-time-div").addClass("d-none");

            // PrivateAInvestor = await getInvestorDetail(contract, address);
            console.log("Investor Call");
            if (!PrivateAInvestor["tokenGenerated"]) {
               if (PrivateAInvestor["lockedAcb"] != 0) {
                  $("#privateA-tg-now-div").removeClass("d-none");
                  $("#privateA-claim-now-div").addClass("d-none");
               }
            } else {
               isclaim = await isEligibleForClaim(contract);
               console.log("isclaim >>>>>>>>>>>>>>>>", isclaim);
               if (isclaim) {
                  // clearInterval(PreSaleTimer);
                  console.log("claim Button Show");
                  $("#privateA-tg-now-div").addClass("d-none");
                  $("#privateA-claim-now-div").removeClass("d-none");
               } else {
                  if (parseInt(PrivateAInvestor["releasedAcb"]) == parseInt(PrivateAInvestor["lockedAcb"])) {
                     $("#privateA_claim_over_div").removeClass("d-none");
                     $("#privateA_over_div").addClass("d-none");
                     $("#privateA-claim-now-div").addClass("d-none");
                  } else {
                     $("#privateA-claim-now-div").addClass("d-none");
                     var previousClaimTime = parseInt(
                        PrivateAInvestor["previousClaimTime"]
                     );
                     if (is_live != "live") {
                        addNextClaimTime = 75 * 60; // local
                     } else {
                        addNextClaimTime = 24 * 60 * 60 * 30 // live
                     }
                     nextClaimTime = (previousClaimTime + addNextClaimTime) * 1000;
                     $("#privateA-waiting-time-div").removeClass("d-none");
                     $("#privateA-time-lable").text("Next Claim Time :");
                     PrivateATimer = nextClaimTime;
                     console.log(
                        "Next Cliam time>>>>>>>>>>>>>>>>>>>>>>>>>",
                        nextClaimTime
                     );
                  }
               }
            }
         }
      }
   }

   if (PrivateATimer - Date.now() > 0) {
      console.log("------------------------------------");
      console.log("Private A timer call");
      console.log("------------------------------------");
      privateATimer = setInterval(function () {
         makePrivateATimer(PrivateATimer);
      }, 1000);
   }
   $(".box-loader").hide();
}
//======================== Private A Sale End=============================//

//======================== Private B Sale Start=============================//
async function getPrivateBInvestorDetail(contract, address) {
   // filters.investor_address = $("#address").val();
   // filterData(url,'presale-payment-history-table');
   clearInterval(privateBTimer);
   PrivateBInvestor = await getInvestorDetail(contract, address);
   console.log("PrivateB Investor");
   console.log(PrivateBInvestor);
   locked_token = number_format(
      web3.utils.fromWei(PrivateBInvestor["lockedAcb"], "ether")
   );
   released_token = number_format(
      web3.utils.fromWei(PrivateBInvestor["releasedAcb"], "ether")
   );
   $("#privateB-locked-balance").html(locked_token);
   $("#privateB-release-balance").html(released_token);

   var PrivateBTimer;

   console.log("------------------------------------");
   console.log("Private B Call After Time Interval Clear");
   console.log("------------------------------------");
   // if(today>privateBdate){
   //    return false;
   // }
   PrivateB_TG_started = await isTokenGenerateStarted(contract);
   if (!PrivateB_TG_started) {
      let status = false;
      await postAjax(whitelist_check_url, { address: address, is_sale: 2 }, function (res) {
         status = res.status;
      });
      if (status == false) {
         $("#privateB-whitelist-btn-div").removeClass("d-none");
         $("#privateB-buy-btn-div").addClass("d-none");
      } else {
         $("#privateB-whitelist-btn-div").addClass("d-none");
         $("#privateB-buy-btn-div").removeClass("d-none");
      }
      $("#privateB-waiting-time-div").removeClass("d-none");
      $("#privateB-time-lable").text("Token Generate Starts In :");
      PrivateB_TG_time = await getTokenGenerateTime(contract);
      console.log("Inside Token Genration>>>>>>>>>>>>>>>>>>>.", PrivateB_TG_time);

      PrivateBTimer = PrivateB_TG_time;
   } else {
      $("#privateB-buy-btn-div").addClass("d-none");

      // PrivateBInvestor = await getInvestorDetail(contract, address);
      if (!PrivateBInvestor["tokenGenerated"]) {
         if (PrivateBInvestor["lockedAcb"] != 0) {
            $("#privateB-tg-now-div").removeClass("d-none");
         }
      }

      console.log("Private B Vesting Time Over Claim button show");
      if (parseInt(PrivateBInvestor["lockedAcb"]) == 0 && parseInt(PrivateBInvestor["releasedAcb"]) == 0) {
         $("#privateB_over_div").removeClass("d-none");
         $("#privateB_claim_over_div").addClass("d-none");
         // $("#private-sale-b-tab").prop("disabled", true);
         $('#privateB-buy-btn-div').addClass('d-none');
         $('#privateB-tg-now-div').addClass('d-none');
         $('#privateB-claim-now-div').addClass('d-none');
      } else {
         $("#privateB_over_div").addClass("d-none");
         PrivateB_vesting_started = await isVestingTimeStarted(contract);
         if (!PrivateB_vesting_started) {
            $("#privateB-waiting-time-div").removeClass("d-none");
            // $('#privateB-buy-btn-div').removeClass('d-none');
            $("#privateB-time-lable").text("Vesting Starts In:");
            privateB_Vesting_time = await getVestingTime(contract);

            PrivateBTimer = privateB_Vesting_time;
         } else {
            $("#privateB-waiting-time-div").addClass("d-none");

            // PrivateBInvestor = await getInvestorDetail(contract, address);
            console.log("Investor Call");
            if (!PrivateBInvestor["tokenGenerated"]) {
               if (PrivateBInvestor["lockedAcb"] != 0) {
                  $("#privateB-tg-now-div").removeClass("d-none");
                  $("#privateB-claim-now-div").addClass("d-none");
               }
            } else {
               isclaim = await isEligibleForClaim(contract);
               console.log("isclaim >>>>>>>>>>>>>>>>", isclaim);
               if (isclaim) {
                  // clearInterval(PreSaleTimer);
                  console.log("claim Button Show");
                  $("#privateB-claim-now-div").removeClass("d-none");
                  $("#privateB-tg-now-div").addClass("d-none");
               } else {
                  if (parseInt(PrivateBInvestor["releasedAcb"]) == parseInt(PrivateBInvestor["lockedAcb"])) {
                     $("#privateB_claim_over_div").removeClass("d-none");
                     $("#privateB_over_div").addClass("d-none");
                     $("#privateB-claim-now-div").addClass("d-none");
                  } else {
                     $("#privateB-claim-now-div").addClass("d-none");
                     var previousClaimTime = parseInt(
                        PrivateBInvestor["previousClaimTime"]
                     );
                     if (is_live != "live") {
                        addNextClaimTime = 2 * 60; // local
                     } else {
                        addNextClaimTime = 24 * 60 * 60 * 30 // live
                     }
                     nextClaimTime = (previousClaimTime + addNextClaimTime) * 1000;
                     $("#privateB-waiting-time-div").removeClass("d-none");
                     $("#privateB-time-lable").text("Next Claim Time :");
                     PrivateBTimer = nextClaimTime;
                     console.log(
                        "Next Cliam time>>>>>>>>>>>>>>>>>>>>>>>>>",
                        nextClaimTime
                     );
                  }
               }
            }
         }
      }
   }
   if (PrivateBTimer - Date.now() > 0) {
      privateBTimer = setInterval(function () {
         makePrivateBTimer(PrivateBTimer);
      }, 1000);
   }
   $(".box-loader").hide();
}
//======================== Private B Sale End=============================//

//============================================== Timers ====================================================//

//======================== Seed Sale Time =============================//
function makeSeedTimer(time) {
   now = Date.now();
   var seedTimeLeft = time - now;

   var days = Math.floor(seedTimeLeft / (1000 * 60 * 60 * 24));
   // console.log("seed days",days);
   var hours = Math.floor(
      (seedTimeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
   );
   var minutes = Math.floor((seedTimeLeft % (1000 * 60 * 60)) / (1000 * 60));
   var seconds = Math.floor((seedTimeLeft % (1000 * 60)) / 1000);
   if (days < 0 && hours < 0 && minutes < 0 && seconds < 0) {
      clearInterval(seedTimer);
      $("#seed-waiting-time-div").addClass("d-none");
      // publicSaleContractMethod();
      console.log("------------------------------------");
      console.log("Seed Generate time Call");
      console.log("------------------------------------");
      $(".box-loader").show();
      setTimeout(() => {
         getSeedInvestorDetail(SeedContract, selectedAccount);
      }, 15000);
   } else if (days >= 0 && hours >= 0 && minutes >= 0 && seconds >= 0) {
      days = ("000" + days).slice(-3);
      hours = ("0" + hours).slice(-2);
      minutes = ("0" + minutes).slice(-2);
      // console.log(days, hours, minutes);
      $("#seed-days-0").html(
         "<span>" +
         days[0] +
         "</span>"
      );
      $("#seed-days-1").html(
         "<span>" +
         days[1] +
         "</span>"
      );
      $("#seed-days-2").html(
         "<span>" +
         days[2] +
         "</span>"
      );



      $("#seed-hours-0").html(
         "<span>" + hours[0] + "</span>"
      );
      $("#seed-hours-1").html(
         "<span>" + hours[1] + "</span>"
      );
      $("#seed-minutes-0").html(
         "<span>" + minutes[0] + "</span>"
      );
      $("#seed-minutes-1").html(
         "<span>" + minutes[1] + "</span>"
      );
   }
}
//======================== Private Sale A Time =============================//
function makePrivateATimer(time) {
   now = Date.now();
   var PrivateATimeLeft = time - now;
   var days = Math.floor(PrivateATimeLeft / (1000 * 60 * 60 * 24));
   var hours = Math.floor(
      (PrivateATimeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
   );
   var minutes = Math.floor(
      (PrivateATimeLeft % (1000 * 60 * 60)) / (1000 * 60)
   );
   var seconds = Math.floor((PrivateATimeLeft % (1000 * 60)) / 1000);
   if (days < 0 && hours < 0 && minutes < 0 && seconds < 0) {
      clearInterval(privateATimer);
      $("#privateA-waiting-time-div").addClass("d-none");
      // publicSaleContractMethod();
      console.log("------------------------------------");
      console.log("Private A Generate time Call");
      console.log("------------------------------------");
      $(".box-loader").show();
      setTimeout(() => {
         getPrivateAInvestorDetail(PrivateAContract, selectedAccount);
      }, 10000);
   } else if (days >= 0 && hours >= 0 && minutes >= 0 && seconds >= 0) {
      days = ("000" + days).slice(-3);
      hours = ("0" + hours).slice(-2);
      minutes = ("0" + minutes).slice(-2);
      // console.log(days, hours, minutes);
      $("#privateA-days-0").html(
         "<span>" +
         days[0] +
         "</span>"
      );
      $("#privateA-days-1").html(
         "<span>" +
         days[1] +
         "</span>"
      );
      $("#privateA-days-2").html(
         "<span>" +
         days[2] +
         "</span>"
      );
      $("#privateA-hours-0").html(
         "<span>" + hours[0] + "</span>"
      );
      $("#privateA-hours-1").html(
         "<span>" + hours[1] + "</span>"
      );
      $("#privateA-minutes-0").html(
         "<span>" + minutes[0] + "</span>"
      );
      $("#privateA-minutes-1").html(
         "<span>" + minutes[1] + "</span>"
      );
   }
}
//======================== Private Sale B Time =============================//
function makePrivateBTimer(time) {
   now = Date.now();
   var PrivateBTimeLeft = time - now;
   var days = Math.floor(PrivateBTimeLeft / (1000 * 60 * 60 * 24));
   var hours = Math.floor(
      (PrivateBTimeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
   );
   var minutes = Math.floor(
      (PrivateBTimeLeft % (1000 * 60 * 60)) / (1000 * 60)
   );
   var seconds = Math.floor((PrivateBTimeLeft % (1000 * 60)) / 1000);
   if (days < 0 && hours < 0 && minutes < 0 && seconds < 0) {
      clearInterval(privateBTimer);
      $("#privateB-waiting-time-div").addClass("d-none");
      // publicSaleContractMethod();
      console.log("------------------------------------");
      console.log("PrivateB Generate time Call");
      console.log("------------------------------------");
      $(".box-loader").show();
      setTimeout(() => {
         getPrivateBInvestorDetail(PrivateBContract, selectedAccount);
      }, 10000);
   } else if (days >= 0 && hours >= 0 && minutes >= 0 && seconds >= 0) {
      days = ("000" + days).slice(-3);
      hours = ("0" + hours).slice(-2);
      minutes = ("0" + minutes).slice(-2);
      // console.log(days, hours, minutes);
      $("#privateB-days-0").html(
         "<span>" +
         days[0] +
         "</span>"
      );
      $("#privateB-days-1").html(
         "<span>" +
         days[1] +
         "</span>"
      );
      $("#privateB-days-2").html(
         "<span>" +
         days[2] +
         "</span>"
      );
      $("#privateB-hours-0").html(
         "<span>" + hours[0] + "</span>"
      );
      $("#privateB-hours-1").html(
         "<span>" + hours[1] + "</span>"
      );
      $("#privateB-minutes-0").html(
         "<span>" + minutes[0] + "</span>"
      );
      $("#privateB-minutes-1").html(
         "<span>" + minutes[1] + "</span>"
      );
   }
}
//======================== Public Sale Time =============================//
function makePublicSaleTimer(time) {
   now = Date.now();
   var publicSaleTimeLeft = time - now;
   var days = Math.floor(publicSaleTimeLeft / (1000 * 60 * 60 * 24));
   var hours = Math.floor(
      (publicSaleTimeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
   );
   var minutes = Math.floor(
      (publicSaleTimeLeft % (1000 * 60 * 60)) / (1000 * 60)
   );
   var seconds = Math.floor((publicSaleTimeLeft % (1000 * 60)) / 1000);
   if (days < 0 && hours < 0 && minutes < 0 && seconds < 0) {
      clearInterval(publicSaleTimer);
      $("#public-sale-waiting-time").addClass("d-none");
      // publicSaleContractMethod();
      console.log("------------------------------------");
      console.log("Public Generate time Call");
      console.log("------------------------------------");
      $(".box-loader").show();
      setTimeout(() => {
         getPublicSaleInvestorDetail(PublicSaleContract, selectedAccount);
      }, 10000);
   } else if (days >= 0 && hours >= 0 && minutes >= 0 && seconds >= 0) {
      days = ("000" + days).slice(-3);
      hours = ("0" + hours).slice(-2);
      minutes = ("0" + minutes).slice(-2);
      $("#public-sale-days-0").html(
         "<span>" +
         days[0] +
         "</span>"
      );
      $("#public-sale-days-1").html(
         "<span>" +
         days[1] +
         "</span>"
      );
      $("#public-sale-days-2").html(
         "<span>" +
         days[2] +
         "</span>"
      );
      $("#public-sale-hours-0").html(
         "<span>" + hours[0] + "</span>"
      );
      $("#public-sale-hours-1").html(
         "<span>" + hours[1] + "</span>"
      );
      $("#public-sale-minutes-0").html(
         "<span>" + minutes[0] + "</span>"
      );
      $("#public-sale-minutes-1").html(
         "<span>" + minutes[1] + "</span>"
      );
   }
}


// Hide - show of Seed
$("#seed_coin_dropdown li").on("click", async function () {
   var getValue = $(this).html();
   $("#seed_dLabel").html(getValue);
   coin_id = $(this).data("value");
   $('#seed-allowance-btn').addClass('d-none');
   $('#seed-pay-now-btn').addClass('d-none');
   if (coin_id != '') {
      $('#seed_token_amount').prop('disabled', false);
      $('#seed_usd_amount').prop('disabled', false);
      $('#seed_token_amount').val('');
      $('#seed_usd_amount').val('');
      coin_data = getCoin(coin_id);
      $('#seed_coin').val(coin_id);
      $('#seed_to_token_name').text(coin_data.symbol);
      $('#seed_to_token_title').text(coin_data.symbol)
      $('#seed_to_token_label').text(coin_data.symbol);
      ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
      tokenDecimals = await ERC20Contract.methods.decimals().call();
      Allowance = await ERC20Contract.methods.allowance(selectedAccount, SeedContractAddress).call();
      usd_amount = await SeedContract.methods.whiteListTokenAddress(coin_data.contract_address).call();
      usd_amount = 1 / (usd_amount / 100);
      $('#seed_to_token_amount').text(usd_amount.toFixed(2))
      $('#seed_to_token_amount1').text(usd_amount.toFixed(2))


      console.log('-------------------');
      console.log(tokenDecimals, Allowance);
      console.log('-------------------');
      Allowance = Allowance / Math.pow(10, tokenDecimals);
      usd = $("#seed_usd_amount").val();
      if (usd == "") {
         usd = 0;
      }
      // usd = usd * Math.pow(10,tokenDecimals);
      if (Allowance == 0) {
         $('#seed-allowance-btn').removeClass('d-none');
         $('#seed-pay-now-btn').addClass('d-none');
         return false;
      }
      if (Allowance < usd) {
         $('#seed-allowance-btn').removeClass('d-none');
         $('#seed-pay-now-btn').addClass('d-none');
      } else {
         $('#seed-allowance-btn').addClass('d-none');
         $('#seed-pay-now-btn').removeClass('d-none');
      }
   }
});

// Hide - show of Private Sale A
$("#privateA_coin_dropdown li").on("click", async function () {
   var getValue = $(this).html();
   $("#privateA_coin").val($(this).data("value"));
   $("#privateA_dLabel").html(getValue);
   $('#privateA-allowance-btn').addClass('d-none');
   $('#privateA-pay-now-btn').addClass('d-none');
   coin_id = $(this).data("value");
   if (coin_id != '') {
      coin_data = getCoin(coin_id);
      $('#privateA_token_amount').prop('disabled', false);
      $('#privateA_usd_amount').prop('disabled', false);
      $('#privateA_token_amount').val('');
      $('#privateA_usd_amount').val('');
      $('#privateA_to_token_name').text(coin_data.symbol);
      $('#privateA_to_token_title').text(coin_data.symbol)
      $('#privateA_to_token_label').text(coin_data.symbol);
      ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
      tokenDecimals = await ERC20Contract.methods.decimals().call();
      Allowance = await ERC20Contract.methods.allowance(selectedAccount, SeedContractAddress).call();
      usd_amount = await PrivateAContract.methods.whiteListTokenAddress(coin_data.contract_address).call();
      usd_amount = 1 / usd_amount;

      $('#privateA_to_token_amount').text(usd_amount.toFixed(2))
      $('#privateA_to_token_amount1').text(usd_amount.toFixed(2))
      console.log('-------------------');
      console.log(tokenDecimals, Allowance);
      console.log('-------------------');
      Allowance = Allowance / Math.pow(10, tokenDecimals);
      usd = $("#privateA_usd_amount").val();
      if (usd == "") {
         usd = 0;
      }
      // usd = usd * Math.pow(10,tokenDecimals);
      if (Allowance == 0) {
         $('#privateA-allowance-btn').removeClass('d-none');
         $('#privateA-pay-now-btn').addClass('d-none');
         return false;
      }
      if (Allowance < usd) {
         $('#privateA-allowance-btn').removeClass('d-none');
         $('#privateA-pay-now-btn').addClass('d-none');
      } else {
         $('#privateA-allowance-btn').addClass('d-none');
         $('#privateA-pay-now-btn').removeClass('d-none');
      }
   }

});

// Hide - show of Private Sale B
$("#privateB_coin_dropdown li").on("click", async function () {
   var getValue = $(this).html();
   $("#privateB_dLabel").html(getValue);
   coin_id = $(this).data("value");
   $('#privateB-allowance-btn').addClass('d-none');
   $('#privateB-pay-now-btn').addClass('d-none');
   if (coin_id != '') {
      $("#privateB_coin").val(coin_id);
      $('#privateB_token_amount').prop('disabled', false);
      $('#privateB_usd_amount').prop('disabled', false);
      $('#privateB_token_amount').val('');
      $('#privateB_usd_amount').val('');
      coin_data = getCoin(coin_id);
      $('#privateB_to_token_name').text(coin_data.symbol);
      $('#privateB_to_token_label').text(coin_data.symbol);
      $('#privateB_to_token_title').text(coin_data.symbol)
      ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
      tokenDecimals = await ERC20Contract.methods.decimals().call();
      Allowance = await ERC20Contract.methods.allowance(selectedAccount, PrivateBContractAddress).call();
      usd_amount = await PrivateBContract.methods.whiteListTokenAddress(coin_data.contract_address).call();
      usd_amount = 1 / usd_amount;

      $('#privateB_to_token_amount').text(usd_amount.toFixed(2))
      $('#privateB_to_token_amount1').text(usd_amount.toFixed(2))

      console.log('-------------------');
      console.log(tokenDecimals, Allowance);
      console.log('-------------------');
      Allowance = Allowance / Math.pow(10, tokenDecimals);
      usd = $("#privateB_usd_amount").val();
      if (usd == "") {
         usd = 0;
      }
      // usd = usd * Math.pow(10,tokenDecimals);
      if (Allowance == 0) {
         $('#privateB-allowance-btn').removeClass('d-none');
         $('#privateB-pay-now-btn').addClass('d-none');
         return false;
      }
      if (Allowance < usd) {
         $('#privateB-allowance-btn').removeClass('d-none');
         $('#privateB-pay-now-btn').addClass('d-none');
      } else {
         $('#privateB-allowance-btn').addClass('d-none');
         $('#privateB-pay-now-btn').removeClass('d-none');
      }
   }
});

// Hide - show of Public Sale
$("#publicsale_coin_dropdown li").on("click", async function () {
   var getValue = $(this).html();
   $("#publicsale_dLabel").html(getValue);
   coin_id = $(this).data("value");
   $('#publicsale-allowance-btn').addClass('d-none');
   $('#publicsale-pay-now-btn').addClass('d-none');
   if (coin_id != '') {
      $("#publicsale_coin").val(coin_id);
      $('#publicsale_token_amount').prop('disabled', false);
      $('#publicsale_usd_amount').prop('disabled', false);
      $('#publicsale_token_amount').val('');
      $('#publicsale_usd_amount').val('');
      coin_data = getCoin(coin_id);
      $('#publicsale_to_token_name').text(coin_data.symbol);
      $('#publicsale_to_token_label').text(coin_data.symbol);
      $('#publicsale_to_token_title').text(coin_data.symbol)
      ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
      tokenDecimals = await ERC20Contract.methods.decimals().call();
      Allowance = await ERC20Contract.methods.allowance(selectedAccount, PublicSaleContractAddress).call();
      usd_amount = await PublicSaleContract.methods.whiteListTokenAddress(coin_data.contract_address).call();
      usd_amount = 1 / (usd_amount / 100);

      $('#publicsale_to_token_amount').text(usd_amount.toFixed(2))
      $('#publicsale_to_token_amount1').text(usd_amount.toFixed(2))

      console.log('-------------------');
      console.log(tokenDecimals, Allowance);
      console.log('-------------------');
      Allowance = Allowance / Math.pow(10, tokenDecimals);
      usd = $("#publicsale_usd_amount").val();
      if (usd == "") {
         usd = 0;
      }
      // usd = usd * Math.pow(10,tokenDecimals);
      if (Allowance == 0) {
         $('#publicsale-allowance-btn').removeClass('d-none');
         $('#publicsale-pay-now-btn').addClass('d-none');
         return false;
      }
      if (Allowance < usd) {
         $('#publicsale-allowance-btn').removeClass('d-none');
         $('#publicsale-pay-now-btn').addClass('d-none');
      } else {
         $('#publicsale-allowance-btn').addClass('d-none');
         $('#publicsale-pay-now-btn').removeClass('d-none');
      }
   }
});


//keypress bind
//seed
$(document).on("keypress", "#seed_token_amount", async function () {
   var $this = $(this);
   if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
      ((event.which < 48 || event.which > 57) &&
         (event.which != 0 && event.which != 18))) {
      event.preventDefault();
   }

   var text = $(this).val();

   var vlaues = text.split('.');
   if (typeof vlaues[1] != 'undefined') {

      if (vlaues[1].length >= 8) {
         event.preventDefault();
      }
   }
   if ((event.which == 46) && (text.indexOf('.') == -1)) {
      setTimeout(function () {
         if ($this.val().substring($this.val().indexOf('.')).length > 8) {
            $this.val($this.val().substring(0, $this.val().indexOf('.') + 8));
         }
      }, 1);
   }
   if ((text.indexOf('.') != -1) &&
      (text.substring(text.indexOf('.')).length > 8) &&
      (event.which != 0 && event.which != 18) &&
      ($(this)[0].selectionStart >= text.length - 8)) {
      event.preventDefault();
   }
});
$("#seed_usd_amount").keypress(function (event) {
   var $this = $(this);
   if (
      (event.which != 46 || $this.val().indexOf(".") != -1) &&
      (event.which < 48 || event.which > 57) &&
      event.which != 0 &&
      event.which != 18
   ) {
      event.preventDefault();
   }

   var text = $(this).val();

   var vlaues = text.split(".");

   if (typeof vlaues[1] != 'undefined') {

      if (vlaues[1].length >= 8) {
         event.preventDefault();
      }
   }
   if (event.which == 46 && text.indexOf(".") == -1) {
      setTimeout(function () {
         if ($this.val().substring($this.val().indexOf(".")).length > 8) {
            $this.val($this.val().substring(0, $this.val().indexOf(".") + 8));
         }
      }, 1);
   }
   if (
      text.indexOf(".") != -1 &&
      text.substring(text.indexOf(".")).length > 8 &&
      event.which != 0 &&
      event.which != 18 &&
      $(this)[0].selectionStart >= text.length - 8
   ) {
      event.preventDefault();
   }
});

//private A
$(document).on("keypress", "#privateA_token_amount", async function () {
   var $this = $(this);
   if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
      ((event.which < 48 || event.which > 57) &&
         (event.which != 0 && event.which != 18))) {
      event.preventDefault();
   }

   var text = $(this).val();

   var vlaues = text.split('.');
   if (typeof vlaues[1] != 'undefined') {

      if (vlaues[1].length >= 8) {
         event.preventDefault();
      }
   }
   if ((event.which == 46) && (text.indexOf('.') == -1)) {
      setTimeout(function () {
         if ($this.val().substring($this.val().indexOf('.')).length > 8) {
            $this.val($this.val().substring(0, $this.val().indexOf('.') + 8));
         }
      }, 1);
   }
   if ((text.indexOf('.') != -1) &&
      (text.substring(text.indexOf('.')).length > 8) &&
      (event.which != 0 && event.which != 18) &&
      ($(this)[0].selectionStart >= text.length - 8)) {
      event.preventDefault();
   }
});
$("#privateA_usd_amount").keypress(function (event) {
   var $this = $(this);
   if (
      (event.which != 46 || $this.val().indexOf(".") != -1) &&
      (event.which < 48 || event.which > 57) &&
      event.which != 0 &&
      event.which != 18
   ) {
      event.preventDefault();
   }

   var text = $(this).val();

   var vlaues = text.split(".");

   if (vlaues[1].length >= 2) {
      event.preventDefault();
   }
   if (event.which == 46 && text.indexOf(".") == -1) {
      setTimeout(function () {
         if ($this.val().substring($this.val().indexOf(".")).length > 8) {
            $this.val($this.val().substring(0, $this.val().indexOf(".") + 8));
         }
      }, 1);
   }
   if (
      text.indexOf(".") != -1 &&
      text.substring(text.indexOf(".")).length > 8 &&
      event.which != 0 &&
      event.which != 18 &&
      $(this)[0].selectionStart >= text.length - 8
   ) {
      event.preventDefault();
   }
});

//private B
$(document).on("keypress", "#privateB_token_amount", async function () {
   var $this = $(this);
   if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
      ((event.which < 48 || event.which > 57) &&
         (event.which != 0 && event.which != 18))) {
      event.preventDefault();
   }

   var text = $(this).val();

   var vlaues = text.split('.');
   if (typeof vlaues[1] != 'undefined') {

      if (vlaues[1].length >= 8) {
         event.preventDefault();
      }
   }
   if ((event.which == 46) && (text.indexOf('.') == -1)) {
      setTimeout(function () {
         if ($this.val().substring($this.val().indexOf('.')).length > 8) {
            $this.val($this.val().substring(0, $this.val().indexOf('.') + 8));
         }
      }, 1);
   }
   if ((text.indexOf('.') != -1) &&
      (text.substring(text.indexOf('.')).length > 8) &&
      (event.which != 0 && event.which != 18) &&
      ($(this)[0].selectionStart >= text.length - 8)) {
      event.preventDefault();
   }
});
$("#privateB_usd_amount").keypress(function (event) {
   var $this = $(this);
   if (
      (event.which != 46 || $this.val().indexOf(".") != -1) &&
      (event.which < 48 || event.which > 57) &&
      event.which != 0 &&
      event.which != 18
   ) {
      event.preventDefault();
   }

   var text = $(this).val();

   var vlaues = text.split(".");

   if (vlaues[1] != undefined && vlaues[1].length >= 2) {
      event.preventDefault();
   }
   if (event.which == 46 && text.indexOf(".") == -1) {
      setTimeout(function () {
         if ($this.val().substring($this.val().indexOf(".")).length > 8) {
            $this.val($this.val().substring(0, $this.val().indexOf(".") + 8));
         }
      }, 1);
   }
   if (
      text.indexOf(".") != -1 &&
      text.substring(text.indexOf(".")).length > 8 &&
      event.which != 0 &&
      event.which != 18 &&
      $(this)[0].selectionStart >= text.length - 8
   ) {
      event.preventDefault();
   }
});

//public sale
$(document).on("keypress", "#publicsale_token_amount", async function () {
   var $this = $(this);
   if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
      ((event.which < 48 || event.which > 57) &&
         (event.which != 0 && event.which != 18))) {
      event.preventDefault();
   }

   var text = $(this).val();

   var vlaues = text.split('.');
   if (typeof vlaues[1] != 'undefined') {

      if (vlaues[1].length >= 8) {
         event.preventDefault();
      }
   }
   if ((event.which == 46) && (text.indexOf('.') == -1)) {
      setTimeout(function () {
         if ($this.val().substring($this.val().indexOf('.')).length > 8) {
            $this.val($this.val().substring(0, $this.val().indexOf('.') + 8));
         }
      }, 1);
   }
   if ((text.indexOf('.') != -1) &&
      (text.substring(text.indexOf('.')).length > 8) &&
      (event.which != 0 && event.which != 18) &&
      ($(this)[0].selectionStart >= text.length - 8)) {
      event.preventDefault();
   }
});
$("#publicsale_usd_amount").keypress(function (event) {
   var $this = $(this);
   if (
      (event.which != 46 || $this.val().indexOf(".") != -1) &&
      (event.which < 48 || event.which > 57) &&
      event.which != 0 &&
      event.which != 18
   ) {
      event.preventDefault();
   }

   var text = $(this).val();
   var vlaues = text.split(".");
   if (vlaues[1] != undefined && vlaues[1].length >= 2) {
      event.preventDefault();
   }
   if (event.which == 46 && text.indexOf(".") == -1) {
      setTimeout(function () {
         if ($this.val().substring($this.val().indexOf(".")).length > 8) {
            $this.val($this.val().substring(0, $this.val().indexOf(".") + 8));
         }
      }, 1);
   }

   if (
      text.indexOf(".") != -1 &&
      text.substring(text.indexOf(".")).length > 8 &&
      event.which != 0 &&
      event.which != 18 &&
      $(this)[0].selectionStart >= text.length - 8
   ) {
      event.preventDefault();
   }
});

//allowance and pay button display

//seed
$("#seed_token_amount").keyup(async function () {
   val = $("#seed_token_amount").val();
   usdPrice = $('#seed_to_token_amount').text();
   usd = val * usdPrice;
   if (val == "") {
      $("#seed_usd_amount").val("");
   } else {
      $("#seed_usd_amount").val(number_usd(usd));
   }
   coin_id = $('#seed_coin').val();
   console.log('coin id : ', coin_id);
   if (coin_id != '') {
      coin_data = getCoin(coin_id);
      ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
      tokenDecimals = await ERC20Contract.methods.decimals().call();
      Allowance = await ERC20Contract.methods.allowance(selectedAccount, SeedContractAddress).call();
      console.log('-------------------');
      console.log(tokenDecimals, Allowance, usd);
      console.log('-------------------');
      Allowance = Allowance / Math.pow(10, tokenDecimals);
      // usd = usd * Math.pow(10,tokenDecimals);
      console.log(tokenDecimals, Allowance, usd);
      if (Allowance == 0) {
         $('#seed-allowance-btn').removeClass('d-none');
         $('#seed-pay-now-btn').addClass('d-none');
         return false;
      }
      if (Allowance < usd) {
         $('#seed-allowance-btn').removeClass('d-none');
         $('#seed-pay-now-btn').addClass('d-none');
      } else {
         $('#seed-allowance-btn').addClass('d-none');
         $('#seed-pay-now-btn').removeClass('d-none');
      }
   }
});
$("#seed_usd_amount").keyup(async function () {
   val = $("#seed_usd_amount").val();
   usdPrice = $('#seed_to_token_amount').text();
   token = val / usdPrice;
   let usd = val;
   if (val == "") {
      $("#seed_token_amount").val("");
   } else {
      $("#seed_token_amount").val(number_token(token));
   }
   coin_id = $('#seed_coin').val();
   console.log('coin id : ', coin_id);
   if (coin_id != '') {
      coin_data = getCoin(coin_id);
      ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
      tokenDecimals = await ERC20Contract.methods.decimals().call();
      Allowance = await ERC20Contract.methods.allowance(selectedAccount, SeedContractAddress).call();
      console.log('-------------------');
      console.log(tokenDecimals, Allowance, usd);
      console.log('-------------------');
      Allowance = Allowance / Math.pow(10, tokenDecimals);
      // usd = usd * Math.pow(10,tokenDecimals);
      console.log(tokenDecimals, Allowance, usd);
      if (Allowance == 0) {
         $('#seed-allowance-btn').removeClass('d-none');
         $('#seed-pay-now-btn').addClass('d-none');
         return false;
      }
      if (Allowance < usd) {
         $('#seed-allowance-btn').removeClass('d-none');
         $('#seed-pay-now-btn').addClass('d-none');
      } else {
         $('#seed-allowance-btn').addClass('d-none');
         $('#seed-pay-now-btn').removeClass('d-none');
      }
   }
});

//private A
$("#privateA_token_amount").keyup(async function () {
   let val = $("#privateA_token_amount").val();
   let usdPrice = $('#privateA_to_token_amount').text();

   usd = val * usdPrice;
   if (val == "") {
      $("#privateA_usd_amount").val("");
   } else {
      $("#privateA_usd_amount").val(number_usd(usd));
   }
   coin_id = $('#privateA_coin').val();
   console.log('coin id : ', coin_id);
   if (coin_id != '') {
      coin_data = getCoin(coin_id);
      ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
      tokenDecimals = await ERC20Contract.methods.decimals().call();
      Allowance = await ERC20Contract.methods.allowance(selectedAccount, PrivateSaleContractAddress).call();
      Allowance = Allowance / Math.pow(10, tokenDecimals);
      // usd = usd * Math.pow(10,tokenDecimals);
      console.log('-------------------');
      console.log(tokenDecimals, Allowance, usd);
      console.log('-------------------');
      if (Allowance == 0) {
         $('#privateA-allowance-btn').removeClass('d-none');
         $('#privateA-pay-now-btn').addClass('d-none');
         return false;
      }
      if (Allowance < usd) {
         $('#privateA-allowance-btn').removeClass('d-none');
         $('#privateA-pay-now-btn').addClass('d-none');
      } else {
         $('#privateA-allowance-btn').addClass('d-none');
         $('#privateA-pay-now-btn').removeClass('d-none');
      }
   }
});
$("#privateA_usd_amount").keyup(async function () {
   let val = $("#privateA_usd_amount").val();
   let usdPrice = $('#privateA_to_token_amount').text();
   token = val / usdPrice;
   if (val == "") {
      $("#privateA_token_amount").val("");
   } else {
      $("#privateA_token_amount").val(number_token(token));
   }
   coin_id = $('#privateA_coin').val();
   console.log('coin id : ', coin_id);
   let usd = val;
   if (coin_id != '') {
      coin_data = getCoin(coin_id);
      ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
      tokenDecimals = await ERC20Contract.methods.decimals().call();
      Allowance = await ERC20Contract.methods.allowance(selectedAccount, PrivateSaleContractAddress).call();

      Allowance = Allowance / Math.pow(10, tokenDecimals);
      // usd = usd * Math.pow(10,tokenDecimals);
      console.log('-------------------');
      console.log(tokenDecimals, Allowance, usd);
      console.log('-------------------');
      if (Allowance == 0) {
         $('#privateA-allowance-btn').removeClass('d-none');
         $('#privateA-pay-now-btn').addClass('d-none');
         return false;
      }
      if (Allowance < usd) {
         $('#privateA-allowance-btn').removeClass('d-none');
         $('#privateA-pay-now-btn').addClass('d-none');
      } else {
         $('#privateA-allowance-btn').addClass('d-none');
         $('#privateA-pay-now-btn').removeClass('d-none');
      }
   }
});

//private B
$("#privateB_token_amount").keyup(async function () {
   val = $("#privateB_token_amount").val();
   usdPrice = $('#privateB_to_token_amount').text();
   usd = val * usdPrice;
   if (val == "") {
      $("#privateB_usd_amount").val("");
   } else {
      $("#privateB_usd_amount").val(number_usd(usd));
   }
   coin_id = $('#privateB_coin').val();
   console.log('coin id : ', coin_id);
   if (coin_id != '') {
      coin_data = getCoin(coin_id);
      console.log(coin_data);
      ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
      tokenDecimals = await ERC20Contract.methods.decimals().call();
      Allowance = await ERC20Contract.methods.allowance(selectedAccount, PrivateBContractAddress).call();

      Allowance = Allowance / Math.pow(10, tokenDecimals);
      // usd = usd * Math.pow(10,tokenDecimals);
      console.log('-------------------');
      console.log(tokenDecimals, Allowance, usd);
      console.log('-------------------');
      if (Allowance == 0) {
         $('#privateB-allowance-btn').removeClass('d-none');
         $('#privateB-pay-now-btn').addClass('d-none');
         return false;
      }
      if (Allowance < usd) {
         $('#privateB-allowance-btn').removeClass('d-none');
         $('#privateB-pay-now-btn').addClass('d-none');
      } else {
         $('#privateB-allowance-btn').addClass('d-none');
         $('#privateB-pay-now-btn').removeClass('d-none');
      }
   }
});
$("#privateB_usd_amount").keyup(async function () {
   val = $("#privateB_usd_amount").val();
   usdPrice = $('#privateB_to_token_amount').text();
   token = val / usdPrice;
   let usd = val;
   if (val == "") {
      $("#privateB_token_amount").val("");
   } else {
      $("#privateB_token_amount").val(number_token(token));
   }
   if (coin_id != '') {
      coin_data = getCoin(coin_id);
      console.log(coin_data);
      ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
      tokenDecimals = await ERC20Contract.methods.decimals().call();
      Allowance = await ERC20Contract.methods.allowance(selectedAccount, PrivateBContractAddress).call();
      Allowance = Allowance / Math.pow(10, tokenDecimals);
      console.log('-------------------');
      console.log(tokenDecimals, Allowance, usd);
      console.log('-------------------');
      // usd = usd * Math.pow(10,tokenDecimals);
      if (Allowance == 0) {
         $('#privateB-allowance-btn').removeClass('d-none');
         $('#privateB-pay-now-btn').addClass('d-none');
         return false;
      }
      if (Allowance < usd) {
         $('#privateB-allowance-btn').removeClass('d-none');
         $('#privateB-pay-now-btn').addClass('d-none');
      } else {
         $('#privateB-allowance-btn').addClass('d-none');
         $('#privateB-pay-now-btn').removeClass('d-none');
      }
   }
});

//public sale
$("#publicsale_token_amount").keyup(async function () {
   val = $("#publicsale_token_amount").val();
   usdPrice = $('#publicsale_to_token_amount').text();
   usd = val * usdPrice;
   if (val == "") {
      $("#publicsale_usd_amount").val("");
   } else {
      $("#publicsale_usd_amount").val(number_usd(usd));
   }
   coin_id = $('#publicsale_coin').val();
   console.log('coin id : ', coin_id);
   if (coin_id != '') {
      coin_data = getCoin(coin_id);
      console.log(coin_data);
      ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
      tokenDecimals = await ERC20Contract.methods.decimals().call();
      Allowance = await ERC20Contract.methods.allowance(selectedAccount, PublicSaleContractAddress).call();
      console.log('-------------------');
      console.log(tokenDecimals, Allowance, usd);
      console.log('-------------------');
      Allowance = Allowance / Math.pow(10, tokenDecimals);
      // usd = usd * Math.pow(10,tokenDecimals);
      if (Allowance == 0) {
         $('#publicsale-allowance-btn').removeClass('d-none');
         $('#publicsale-pay-now-btn').addClass('d-none');
         return false;
      }
      if (Allowance < usd) {
         $('#publicsale-allowance-btn').removeClass('d-none');
         $('#publicsale-pay-now-btn').addClass('d-none');
      } else {
         $('#publicsale-allowance-btn').addClass('d-none');
         $('#publicsale-pay-now-btn').removeClass('d-none');
      }
   }
});
$("#publicsale_usd_amount").keyup(async function () {
   let val = $("#publicsale_usd_amount").val();
   let usdPrice = $('#publicsale_to_token_amount').text();
   token = val / usdPrice;
   if (val == "") {
      $("#publicsale_token_amount").val("");
   } else {
      $("#publicsale_token_amount").val(number_token(token));
   }
   let usd = val;
   coin_id = $('#publicsale_coin').val();
   console.log('coin id : ', coin_id);
   if (coin_id != '') {
      coin_data = getCoin(coin_id);
      console.log(coin_data);
      ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
      tokenDecimals = await ERC20Contract.methods.decimals().call();
      Allowance = await ERC20Contract.methods.allowance(selectedAccount, PublicSaleContractAddress).call();
      Allowance = Allowance / Math.pow(10, tokenDecimals);
      console.log('-------------------');
      console.log(tokenDecimals, Allowance, usd);
      console.log('-------------------');
      // usd = usd * Math.pow(10,tokenDecimals);
      if (Allowance == 0) {
         $('#publicsale-allowance-btn').removeClass('d-none');
         $('#publicsale-pay-now-btn').addClass('d-none');
         return false;
      }
      if (Allowance < usd) {
         $('#publicsale-allowance-btn').removeClass('d-none');
         $('#publicsale-pay-now-btn').addClass('d-none');
      } else {
         $('#publicsale-allowance-btn').addClass('d-none');
         $('#publicsale-pay-now-btn').removeClass('d-none');
      }
   }
});

//allowance , pay btn , whitelist click
//seed
$("#seed-allowance-btn").click(async function (e) {
   let usd_amount = $("#seed_usd_amount").val() == "" ? 0 : parseFloat($("#seed_usd_amount").val());
   let min_usd = $("#seed_minimum").html();
   let max_usd = $("#seed_maximum").html();
   if (usd_amount < min_usd) {
      Toast('Please enter USD amount greater than ' + min_usd, 3000, 0);
      return;
   }
   if (usd_amount > max_usd) {
      Toast('Please enter USD amount less than ' + max_usd, 3000, 0);
      return;
   }
   $("#seed_allowance_spinner").removeClass("d-none");
   $("#seed-allowance-btn").prop("disabled", true);
   coin_id = $('#seed_coin').val();
   coin_data = getCoin(coin_id);
   ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
   tokenDecimals = await ERC20Contract.methods.decimals().call();
   if (is_live != "live") {
      allowance_amount = "20000000000000000000000000000";
   } else {
      allowance_amount = 20000000000 * Math.pow(10, tokenDecimals);
      allowance_amount = allowance_amount.toString();
   }
   var data = ERC20Contract.methods.approve(SeedContractAddress, allowance_amount).encodeABI();
   transactionParameters = {
      from: selectedAccount,
      to: coin_data.contract_address,
      data: data,
      value: '0x00'
   };

   web3.eth.sendTransaction(transactionParameters)
      .once('transactionHash', function (payload) {
         Toast('Your Transaction is being confirmed', 3000, 3);
      })
      .on("receipt", async function (receipt) {
         $("#seed_allowance_spinner").addClass("d-none");
         $("#seed-allowance-btn").prop("disabled", false);
         $('#seed-allowance-btn').addClass('d-none');
         $('#seed-pay-now-btn').removeClass('d-none');
      })
      .on("error", function (error, receipt) {
         Toast('User reject transaction', 3000, 0);
         $("#seed_allowance_spinner").addClass("d-none");
         $("#seed-allowance-btn").prop("disabled", false);
      })

});
$("#seed-pay-now-btn").click(async function (e) {
   $("#seed_pay_now_spinner").removeClass("d-none");
   $("#seed-pay-now-btn").prop("disabled", true);

   let usd_amount = $("#seed_usd_amount").val() == "" ? 0 : parseFloat($("#seed_usd_amount").val());
   let min_usd = $("#seed_minimum").html();
   let max_usd = $("#seed_maximum").html();
   if (usd_amount < min_usd) {
      Toast('Please enter USD amount greater than ' + min_usd, 3000, 0);
      $("#seed_pay_now_spinner").addClass("d-none");
      $("#seed-pay-now-btn").prop("disabled", false);
      return;
   }
   if (usd_amount > max_usd) {
      Toast('Please enter USD amount less than ' + max_usd, 3000, 0);
      $("#seed_pay_now_spinner").addClass("d-none");
      $("#seed-pay-now-btn").prop("disabled", false);
      return;
   }
   acb_amount = $('#seed_token_amount').val();
   if (acb_amount == '') {
      Toast('Please, Enter ACB amount', 3000, 0);
      $("#seed_pay_now_spinner").addClass("d-none");
      $("#seed-pay-now-btn").prop("disabled", false);
      return false;
   }
   ubi_usd_amount = $('.token_usd_price').text()
   usd_amount = $("#seed_usd_amount").val();
   coin_id = $('#seed_coin').val();
   coin_data = getCoin(coin_id);
   ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
   tokenDecimals = await TokenContract.methods.decimals().call();

   multiplier = Math.pow(10, tokenDecimals);
   acb_amount = BigInt(acb_amount * multiplier);
   acb_amount = acb_amount.toString();
   console.log(coin_data.contract_address, usd_amount);
   var data = SeedContract.methods.addInvestor(coin_data.contract_address, acb_amount).encodeABI();
   transactionParameters = {
      from: selectedAccount,
      to: SeedContractAddress,
      data: data,
      value: '0x00'
   };

   web3.eth.sendTransaction(transactionParameters)
      .once('transactionHash', function (payload) {
         console.log(payload);
         Toast('Your Transaction is being confirmed', 3000, 3);
      })
      .on("receipt", async function (receipt) {
         $("#seed_pay_now_spinner").addClass("d-none");
         $("#seed-pay-now-btn").prop("disabled", false);
         $("#seed_usd_amount").val('');
         $("#seed_token_amount").val('');
      })
      .on("error", function (error, receipt) {
         Toast('User reject transaction', 3000, 0);
         $("#seed_pay_now_spinner").addClass("d-none");
         $("#seed-pay-now-btn").prop("disabled", false);
      })

});

//private A
$("#privateA-allowance-btn").click(async function (e) {
   let usd_amount = $("#privateA_usd_amount").val() == "" ? 0 : parseFloat($("#privateA_usd_amount").val());
   let min_usd = $("#private_a_minimum").html();
   let max_usd = $("#private_a_maximum").html();
   if (usd_amount < min_usd) {
      Toast('Please enter USD amount greater than ' + min_usd, 3000, 0);
      return;
   }
   if (usd_amount > max_usd) {
      Toast('Please enter USD amount less than ' + max_usd, 3000, 0);
      return;
   }
   $("#privateA_allowance_spinner").removeClass("d-none");
   $("#privateA-allowance-btn").prop("disabled", true);
   coin_id = $('#privateA_coin').val();
   coin_data = getCoin(coin_id);
   ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
   tokenDecimals = await ERC20Contract.methods.decimals().call();
   if (is_live != "live") {
      allowance_amount = "20000000000000000000000000000";
   } else {
      allowance_amount = 20000000000 * Math.pow(10, tokenDecimals);
      allowance_amount = allowance_amount.toString();
   }
   var data = ERC20Contract.methods.approve(PrivateSaleContractAddress, allowance_amount).encodeABI();
   transactionParameters = {
      from: selectedAccount,
      to: coin_data.contract_address,
      data: data,
      value: '0x00'
   };

   web3.eth.sendTransaction(transactionParameters)
      .once('transactionHash', function (payload) {
         Toast('Your Transaction is being confirmed', 3000, 3);
      })
      .on("receipt", async function (receipt) {
         $("#privateA_allowance_spinner").addClass("d-none");
         $("#privateA-allowance-btn").prop("disabled", false);
         $('#privateA-allowance-btn').addClass('d-none');
         $('#privateA-pay-now-btn').removeClass('d-none');
      })
      .on("error", function (error, receipt) {
         Toast('User reject transaction', 3000, 0);
         $("#privateA_allowance_spinner").addClass("d-none");
         $("#privateA-allowance-btn").prop("disabled", false);
      })

});
$("#privateA-pay-now-btn").click(async function (e) {
   let usd_amount = $("#privateA_usd_amount").val() == "" ? 0 : parseFloat($("#privateA_usd_amount").val());
   let min_usd = $("#private_a_minimum").html();
   let max_usd = $("#private_a_maximum").html();
   if (usd_amount < min_usd) {
      Toast('Please enter USD amount greater than ' + min_usd, 3000, 0);
      return;
   }
   if (usd_amount > max_usd) {
      Toast('Please enter USD amount less than ' + max_usd, 3000, 0);
      return;
   }
   $("#privateA_pay_now_spinner").removeClass("d-none");
   $("#privateA-pay-now-btn").prop("disabled", true);

   acb_amount = $('#privateA_token_amount').val();
   if (acb_amount == '') {
      Toast('Please, Enter ACB amount', 3000, 0);
      $("#privateA_pay_now_spinner").addClass("d-none");
      $("#privateA-pay-now-btn").prop("disabled", false);
      return false;
   }
   usd_amount = $("#privateA_usd_amount").val();
   coin_id = $('#privateA_coin').val();
   coin_data = getCoin(coin_id);
   ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
   tokenDecimals = await TokenContract.methods.decimals().call();

   multiplier = Math.pow(10, tokenDecimals);
   acb_amount = BigInt(acb_amount * multiplier);
   acb_amount = acb_amount.toString();
   console.log(coin_data.contract_address, usd_amount);
   var data = PrivateAContract.methods.addInvestor(coin_data.contract_address, acb_amount).encodeABI();
   transactionParameters = {
      from: selectedAccount,
      to: PrivateSaleContractAddress,
      data: data,
      value: '0x00'
   };

   web3.eth.sendTransaction(transactionParameters)
      .once('transactionHash', function (payload) {
         console.log(payload);
         Toast('Your Transaction is being confirmed', 3000, 3);
      })
      .on("receipt", async function (receipt) {
         $("#privateA_pay_now_spinner").addClass("d-none");
         $("#privateA-pay-now-btn").prop("disabled", false);
         $("#privateA_usd_amount").val('');
         $("#privateA_token_amount").val('');
         filters.investor_address = $(".Wallet_address").val();
         filterData(privateA_history_url, "private-payment-history-table");
      })
      .on("error", function (error, receipt) {
         Toast('User reject transaction', 3000, 0);
         $("#privateA_pay_now_spinner").addClass("d-none");
         $("#privateA-pay-now-btn").prop("disabled", false);
      })

});
$("#privateA-whitelist-btn").click(async function (e) {
   $("#privateA_whitelist_spinner").removeClass('d-none');
   $("#privateA-whitelist-btn").prop("disabled", true);
   await postAjax(whitelist_url, { address: selectedAccount, is_sale: 1 }, function (res) {
      Toast(res.msg, 3000, res.flag);
      if (res.flag == 1) {
         $("#privateA-buy-btn-div").removeClass("d-none");
         $("#privateA-whitelist-btn-div").addClass("d-none");
      }
      $("#privateA_whitelist_spinner").addClass('d-none');
      $("#privateA-whitelist-btn").prop("disabled", false);
   });
});

//private B 
$("#privateB-allowance-btn").click(async function (e) {
   let usd_amount = $("#privateB_usd_amount").val() == "" ? 0 : parseFloat($("#privateB_usd_amount").val());
   let min_usd = $("#private_b_minimum").html();
   let max_usd = $("#private_b_maximum").html();
   if (usd_amount < min_usd) {
      Toast('Please enter USD amount greater than ' + min_usd, 3000, 0);
      return;
   }
   if (usd_amount > max_usd) {
      Toast('Please enter USD amount less than ' + max_usd, 3000, 0);
      return;
   }
   $("#privateB_allowance_spinner").removeClass("d-none");
   $("#privateB-allowance-btn").prop("disabled", true);
   coin_id = $("#privateB_coin").val();
   coin_data = getCoin(coin_id);
   ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
   tokenDecimals = await ERC20Contract.methods.decimals().call();
   if (is_live != "live") {
      allowance_amount = "20000000000000000000000000000";
   } else {
      allowance_amount = 20000000000 * Math.pow(10, tokenDecimals);
      allowance_amount = allowance_amount.toString();
   }
   var data = ERC20Contract.methods.approve(PrivateBContractAddress, allowance_amount).encodeABI();
   transactionParameters = {
      from: selectedAccount,
      to: coin_data.contract_address,
      data: data,
      value: '0x00'
   };

   web3.eth.sendTransaction(transactionParameters)
      .once('transactionHash', function (payload) {
         Toast('Your Transaction is being confirmed', 3000, 3);
      })
      .on("receipt", async function (receipt) {
         $("#privateB_allowance_spinner").addClass("d-none");
         $("#privateB-allowance-btn").prop("disabled", false);
         $('#privateB-allowance-btn').addClass('d-none');
         $('#privateB-pay-now-btn').removeClass('d-none');
      })
      .on("error", function (error, receipt) {
         Toast('User reject transaction', 3000, 0);
         $("#privateB_allowance_spinner").addClass("d-none");
         $("#privateB-allowance-btn").prop("disabled", false);
      })

});
$("#privateB-pay-now-btn").click(async function (e) {
   let usd_amount = $("#privateB_usd_amount").val() == "" ? 0 : parseFloat($("#privateB_usd_amount").val());
   let min_usd = $("#private_b_minimum").html();
   let max_usd = $("#private_b_maximum").html();
   if (usd_amount < min_usd) {
      Toast('Please enter USD amount greater than ' + min_usd, 3000, 0);
      return;
   }
   if (usd_amount > max_usd) {
      Toast('Please enter USD amount less than ' + max_usd, 3000, 0);
      return;
   }
   $("#privateB_pay_now_spinner").removeClass("d-none");
   $("#privateB-pay-now-btn").prop("disabled", true);

   acb_amount = $('#privateB_token_amount').val();
   if (acb_amount == '') {
      Toast('Please, Enter ACB amount', 3000, 0);
      $("#privateB_pay_now_spinner").addClass("d-none");
      $("#privateB-pay-now-btn").prop("disabled", false);
      return false;
   }
   usd_amount = $("#privateB_usd_amount").val();
   coin_id = $("#privateB_coin").val();
   coin_data = getCoin(coin_id);
   ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
   tokenDecimals = await TokenContract.methods.decimals().call();

   multiplier = Math.pow(10, tokenDecimals);
   acb_amount = BigInt(acb_amount * multiplier);
   acb_amount = acb_amount.toString();
   console.log(coin_data.contract_address, usd_amount);
   var data = PrivateBContract.methods.addInvestor(coin_data.contract_address, acb_amount).encodeABI();
   transactionParameters = {
      from: selectedAccount,
      to: PrivateBContractAddress,
      data: data,
      value: '0x00'
   };

   web3.eth.sendTransaction(transactionParameters)
      .once('transactionHash', function (payload) {
         console.log(payload);
         Toast('Your Transaction is being confirmed', 3000, 3);
      })
      .on("receipt", async function (receipt) {
         $("#privateB_pay_now_spinner").addClass("d-none");
         $("#privateB-pay-now-btn").prop("disabled", false);
         $("#privateB_usd_amount").val('');
         $("#privateB_token_amount").val('');
         filters.investor_address = $(".Wallet_address").val();
         filterData(privateB_history_url, "privateB-payment-history-table");
      })
      .on("error", function (error, receipt) {
         Toast('User reject transaction', 3000, 0);
         $("#privateB_pay_now_spinner").addClass("d-none");
         $("#privateB-pay-now-btn").prop("disabled", false);
      })

});
$("#privateB-whitelist-btn").click(async function (e) {
   $("#privateB_whitelist_spinner").removeClass('d-none');
   $("#privateB-whitelist-btn").prop("disabled", true);
   await postAjax(whitelist_url, { address: selectedAccount, is_sale: 2 }, function (res) {
      Toast(res.msg, 3000, res.flag);
      if (res.flag == 1) {
         $("#privateB-buy-btn-div").removeClass("d-none");
         $("#privateB-whitelist-btn-div").addClass("d-none");
      }
      $("#privateB_whitelist_spinner").addClass('d-none');
      $("#privateB-whitelist-btn").prop("disabled", false);
   });
});

//public sale
$("#publicsale-allowance-btn").click(async function (e) {
   $("#publicsale_allowance_spinner").removeClass("d-none");
   $("#publicsale-allowance-btn").prop("disabled", true);
   coin_id = $("#publicsale_coin").val();
   coin_data = getCoin(coin_id);
   ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
   tokenDecimals = await ERC20Contract.methods.decimals().call();
   if (is_live != "live") {
      allowance_amount = "20000000000000000000000000000";
   } else {
      allowance_amount = 20000000000 * Math.pow(10, tokenDecimals);
      allowance_amount = allowance_amount.toString();
   }
   var data = ERC20Contract.methods.approve(PublicSaleContractAddress, allowance_amount).encodeABI();
   transactionParameters = {
      from: selectedAccount,
      to: coin_data.contract_address,
      data: data,
      value: '0x00'
   };

   web3.eth.sendTransaction(transactionParameters)
      .once('transactionHash', function (payload) {
         Toast('Your Transaction is being confirmed', 3000, 3);
      })
      .on("receipt", async function (receipt) {
         $("#publicsale_allowance_spinner").addClass("d-none");
         $("#publicsale-allowance-btn").prop("disabled", false);
         $('#publicsale-allowance-btn').addClass('d-none');
         $('#publicsale-pay-now-btn').removeClass('d-none');
      })
      .on("error", function (error, receipt) {
         Toast('User reject transaction', 3000, 0);
         $("#publicsale_allowance_spinner").addClass("d-none");
         $("#publicsale-allowance-btn").prop("disabled", false);
      })
});
$("#publicsale-pay-now-btn").click(async function (e) {
   $("#publicsale_pay_now_spinner").removeClass("d-none");
   $("#publicsale-pay-now-btn").prop("disabled", true);

   acb_amount = $('#publicsale_token_amount').val();
   if (acb_amount == '') {
      Toast('Please, Enter ACB amount', 3000, 0);
      $("#publicsale_pay_now_spinner").addClass("d-none");
      $("#publicsale-pay-now-btn").prop("disabled", false);
      return false;
   }
   usd_amount = $("#publicsale_usd_amount").val();
   coin_data = getCoin(coin_id);
   ERC20Contract = new web3.eth.Contract(ERC20Abi, coin_data.contract_address);
   tokenDecimals = await TokenContract.methods.decimals().call();

   multiplier = Math.pow(10, tokenDecimals);
   acb_amount = BigInt(acb_amount * multiplier);
   acb_amount = acb_amount.toString();
   console.log(coin_data.contract_address, usd_amount);
   var data = PublicSaleContract.methods.addInvestor(coin_data.contract_address, acb_amount).encodeABI();
   transactionParameters = {
      from: selectedAccount,
      to: PublicSaleContractAddress,
      data: data,
      value: '0x00'
   };

   web3.eth.sendTransaction(transactionParameters)
      .once('transactionHash', function (payload) {
         console.log(payload);
         Toast('Your Transaction is being confirmed', 3000, 3);
      })
      .on("receipt", async function (receipt) {
         $("#publicsale_pay_now_spinner").addClass("d-none");
         $("#publicsale-pay-now-btn").prop("disabled", false);
         $("#publicsale_usd_amount").val('');
         $("#publicsale_token_amount").val('');
         filters.investor_address = $(".Wallet_address").val();
         filterData(public_history_url, "publicsale-payment-history-table");
      })
      .on("error", function (error, receipt) {
         Toast('User reject transaction', 3000, 0);
         $("#publicsale_pay_now_spinner").addClass("d-none");
         $("#publicsale-pay-now-btn").prop("disabled", false);
      })

});


// tg , claim button 

//seed
$("#seed-tg-now-btn").click(function (event) {

   $("#seed_tg_now_spinner").show();
   $("#seed_tg_now_spinner").removeClass("d-none");
   $("#seed-tg-now-btn").prop("disabled", true);
   var from = selectedAccount;
   var to = SeedContractAddress;
   var data = SeedContract.methods.generateToken().encodeABI();
   transactionParameters = {
      to: to,
      from: from,
      data: data,
      value: "0x00",
   };
   web3.eth
      .sendTransaction(transactionParameters)
      .once("transactionHash", function (payload) {
         Toast("Your Transaction is being confirmed", 3000, 3);
      })
      .on("receipt", function (receipt) {
         $("#seed_tg_now_spinner").hide();
         $("#seed-tg-now-btn").prop("disabled", false);
         Toast("Token Generate Successfully done", 3000, 1);
         setTimeout(function () {
            location.reload();
         }, 2000);
      })
      .on("error", function (error, receipt) {
         if (typeof receipt != "undefined") {
         } else {
            $("#toast").remove();
            Toast("It seems like your transaction failed.", 3000, 0);
         }
         $("#seed_tg_now_spinner").hide();
         $("#seed-tg-now-btn").prop("disabled", false);
         return;
      });
});
$("#seed-claim-now-btn").click(function (event) {
   $("#seed_claim_now_spinner").removeClass("d-none");
   $("#seed_claim_now_spinner").show();
   $("#seed-claim-now-btn").prop("disabled", true);
   var from = selectedAccount;
   var to = SeedContractAddress;
   var data = SeedContract.methods.claimAcb().encodeABI();
   transactionParameters = {
      to: to,
      from: from,
      data: data,
      value: "0x00",
   };
   web3.eth
      .sendTransaction(transactionParameters)
      .once("transactionHash", function (payload) {
         Toast("Your Transaction is being confirmed", 3000, 3);
      })
      .on("receipt", function (receipt) {
         $("#seed_claim_now_spinner").hide();
         $("#seed-claim-now-btn").prop("disabled", false);
         Toast("Claim Successfully done", 3000, 1);
         setTimeout(function () {
            location.reload();
         }, 2000);
      })
      .on("error", function (error, receipt) {
         if (typeof receipt != "undefined") {
         } else {
            $("#toast").remove();
            Toast("It seems like your transaction failed.", 3000, 0);
         }
         $("#seed_claim_now_spinner").hide();
         $("#seed-claim-now-btn").prop("disabled", false);
         return;
      });
});

// private A
$("#privateA-tg-now-btn").click(function (event) {
   $("#privateA_tg_now_spinner").show();
   $("#privateA_tg_now_spinner").removeClass("d-none");
   $("#privateA-tg-now-btn").prop("disabled", true);
   var from = selectedAccount;
   var to = PrivateSaleContractAddress;
   var data = PrivateAContract.methods.generateToken().encodeABI();
   transactionParameters = {
      to: to,
      from: from,
      data: data,
      value: "0x00",
   };
   web3.eth
      .sendTransaction(transactionParameters)
      .once("transactionHash", function (payload) {
         Toast("Your Transaction is being confirmed", 3000, 3);
      })
      .on("receipt", function (receipt) {
         $("#privateA_tg_now_spinner").hide();
         $("#privateA-tg-now-btn").prop("disabled", false);
         Toast("Token Generate Successfully done", 3000, 1);
         setTimeout(function () {
            location.reload();
         }, 2000);
      })
      .on("error", function (error, receipt) {
         if (typeof receipt != "undefined") {
         } else {
            $("#toast").remove();
            Toast("It seems like your transaction failed.", 3000, 0);
         }
         $("#privateA_tg_now_spinner").hide();
         $("#privateA-tg-now-btn").prop("disabled", false);
         return;
      });
});
$("#privateA-claim-now-btn").click(function (event) {
   $("#privateA_claim_now_spinner").removeClass("d-none");
   $("#privateA_claim_now_spinner").show();
   $("#privateA-claim-now-btn").prop("disabled", true);
   var from = selectedAccount;
   var to = PrivateSaleContractAddress;
   var data = PrivateAContract.methods.claimUbi().encodeABI();
   transactionParameters = {
      to: to,
      from: from,
      data: data,
      value: "0x00",
   };
   web3.eth
      .sendTransaction(transactionParameters)
      .once("transactionHash", function (payload) {
         Toast("Your Transaction is being confirmed", 3000, 3);
      })
      .on("receipt", function (receipt) {
         $("#privateA_claim_now_spinner").hide();
         $("#privateA-claim-now-btn").prop("disabled", false);
         Toast("Claim Successfully done", 3000, 1);
         setTimeout(function () {
            location.reload();
         }, 2000);
      })
      .on("error", function (error, receipt) {
         if (typeof receipt != "undefined") {
         } else {
            $("#toast").remove();
            Toast("It seems like your transaction failed.", 3000, 0);
         }
         $("#privateA_claim_now_spinner").hide();
         $("#privateA-claim-now-btn").prop("disabled", false);
         return;
      });
});

//private B
$("#privateB-tg-now-btn").click(function (event) {

   $("#privateB_tg_now_spinner").show();
   $("#privateB_tg_now_spinner").removeClass("d-none");
   $("#privateB-tg-now-btn").prop("disabled", true);
   var from = selectedAccount;
   var to = PrivateBContractAddress;
   var data = PrivateBContract.methods.generateToken().encodeABI();
   transactionParameters = {
      to: to,
      from: from,
      data: data,
      value: "0x00",
   };
   web3.eth
      .sendTransaction(transactionParameters)
      .once("transactionHash", function (payload) {
         Toast("Your Transaction is being confirmed", 3000, 3);
      })
      .on("receipt", function (receipt) {
         $("#privateB_tg_now_spinner").hide();
         $("#privateB-tg-now-btn").prop("disabled", false);
         Toast("Token Generate Successfully done", 3000, 1);
         setTimeout(function () {
            location.reload();
         }, 2000);
      })
      .on("error", function (error, receipt) {
         if (typeof receipt != "undefined") {
         } else {
            $("#toast").remove();
            Toast("It seems like your transaction failed.", 3000, 0);
         }
         $("#privateB_tg_now_spinner").hide();
         $("#privateB-tg-now-btn").prop("disabled", false);
         return;
      });
});
$("#privateB-claim-now-btn").click(function (event) {
   $("#privateB_claim_now_spinner").removeClass("d-none");
   $("#privateB_claim_now_spinner").show();
   $("#privateB-claim-now-btn").prop("disabled", true);
   var from = selectedAccount;
   var to = PrivateBContractAddress;
   var data = PrivateBContract.methods.claimUbi().encodeABI();
   transactionParameters = {
      to: to,
      from: from,
      data: data,
      value: "0x00",
   };
   web3.eth
      .sendTransaction(transactionParameters)
      .once("transactionHash", function (payload) {
         Toast("Your Transaction is being confirmed", 3000, 3);
      })
      .on("receipt", function (receipt) {
         $("#privateB_claim_now_spinner").hide();
         $("#privateB-claim-now-btn").prop("disabled", false);
         Toast("Claim Successfully done", 3000, 1);
         setTimeout(function () {
            location.reload();
         }, 2000);
      })
      .on("error", function (error, receipt) {
         if (typeof receipt != "undefined") {
         } else {
            $("#toast").remove();
            Toast("It seems like your transaction failed.", 3000, 0);
         }
         $("#privateB_claim_now_spinner").hide();
         $("#privateB-claim-now-btn").prop("disabled", false);
         return;
      });
});

//public Sale
$("#publicsale-tg-now-btn").click(function (event) {
   $("#publicsale_tg_now_spinner").show();
   $("#publicsale_tg_now_spinner").removeClass("d-none");
   $("#publicsale-tg-now-btn").prop("disabled", true);
   var from = selectedAccount;
   var to = PublicSaleContractAddress;
   var data = PublicSaleContract.methods.generateToken().encodeABI();
   transactionParameters = {
      to: to,
      from: from,
      data: data,
      value: "0x00",
   };
   web3.eth
      .sendTransaction(transactionParameters)
      .once("transactionHash", function (payload) {
         Toast("Your Transaction is being confirmed", 3000, 3);
      })
      .on("receipt", function (receipt) {
         $("#publicsale_tg_now_spinner").hide();
         $("#publicsale-tg-now-btn").prop("disabled", false);
         Toast("Token Generate Successfully done", 3000, 1);
         setTimeout(function () {
            location.reload();
         }, 2000);
      })
      .on("error", function (error, receipt) {
         if (typeof receipt != "undefined") {
         } else {
            $("#toast").remove();
            Toast("It seems like your transaction failed.", 3000, 0);
         }
         $("#publicsale_tg_now_spinner").hide();
         $("#publicsale-tg-now-btn").prop("disabled", false);
         return;
      });
});
$("#publicsale-claim-now-btn").click(function (event) {
   $("#publicsale_claim_now_spinner").removeClass("d-none");
   $("#publicsale_claim_now_spinner").show();
   $("#publicsale-claim-now-btn").prop("disabled", true);
   var from = selectedAccount;
   var to = PublicSaleContractAddress;
   var data = PublicSaleContract.methods.claimUbi().encodeABI();
   transactionParameters = {
      to: to,
      from: from,
      data: data,
      value: "0x00",
   };
   web3.eth
      .sendTransaction(transactionParameters)
      .once("transactionHash", function (payload) {
         Toast("Your Transaction is being confirmed", 3000, 3);
      })
      .on("receipt", function (receipt) {
         $("#presale_claim_now_spinner").hide();
         $("#presale-claim-now-btn").prop("disabled", false);
         Toast("Claim Successfully done", 3000, 1);
         setTimeout(function () {
            location.reload();
         }, 2000);
      })
      .on("error", function (error, receipt) {
         if (typeof receipt != "undefined") {
         } else {
            $("#toast").remove();
            Toast("It seems like your transaction failed.", 3000, 0);
         }
         $("#presale_claim_now_spinner").hide();
         $("#presale-claim-now-btn").prop("disabled", false);
         return;
      });
});

//tab click

//seed
$("#seed-tab").click(async function (event) {
   clearAllInterval();
});
$(document).on("click", "#seed-inner-tab", function (event) {
   $("#seed-payment-history").addClass("d-none");
   $("#seed-pay-now-div").addClass("d-none");
   $("#seed-inner").addClass("active");
});
$(document).on("click", "#seed-buy-now-btn", function (event) {
   $("#seed-div").addClass("d-none");
   $("#seed-buy-now-div").removeClass("d-none");
});
$(document).on("click", "#seed-buy-now-back-btn", async function (event) {
   await getSeedInvestorDetail(SeedContract, selectedAccount);
   $("#seed-div").removeClass("d-none");
   $("#seed-buy-now-div").addClass("d-none");

});
$(document).on("click", "#seed-pay-now-back-btn", function (event) {
   $("#seed-div").removeClass("d-none");
   $("#seed-payment-history").removeClass("d-none");
   $("#seed-pay-now-div").addClass("d-none");
});
$(document).on("click", "#seed-payment-history-tab", function (event) {
   $("#seed-payment-history").removeClass("d-none");
   $("#seed-pay-now-div").addClass("d-none");
   // $('#seed-buy-now-btn').addClass('d-none');

   filters.investor_address = $(".Wallet_address").val();
   filterData(seedTransactionHistoryUrl, "seed-payment-history-table");
});

//Private a

$(document).on("click", "#privateA-inner-tab", function (event) {
   $("#privateA-payment-history").addClass("d-none");
   $("#privateA-pay-now-div").addClass("d-none");
   $("#privateA-inner").addClass("active");
});
$(document).on("click", "#privateA-buy-now-btn", function (event) {
   $("#privateA-div").addClass("d-none");
   $("#privateA-buy-now-div").removeClass("d-none");
});
$(document).on("click", "#privateA-buy-now-back-btn", async function (event) {
   await getPrivateAInvestorDetail(PrivateAContract, selectedAccount);
   $("#privateA-div").removeClass("d-none");
   $("#privateA-buy-now-div").addClass("d-none");
});
$(document).on("click", "#privateA-pay-now-back-btn", function (event) {
   $("#privateA-div").removeClass("d-none");
   $("#privateA-payment-history").removeClass("d-none");
   $("#privateA-pay-now-div").addClass("d-none");
});
$(document).on("click", "#privateA-payment-history-tab", function (event) {
   $("#privateA-payment-history").removeClass("d-none");
   $("#privateA-pay-now-div").addClass("d-none");
   // $('#privateA-buy-now-btn').addClass('d-none');

   filters.investor_address = $(".Wallet_address").val();
   filterData(privateA_history_url, "private-payment-history-table");
});

// private B
$("#private-sale-b-tab").click(async function (event) {
   clearAllInterval();
});
$(document).on("click", "#privateB-inner-tab", function (event) {
   $("#privateB-payment-history").addClass("d-none");
   $("#privateB-pay-now-div").addClass("d-none");
   $("#privateB-inner").addClass("active");
});
$(document).on("click", "#privateB-buy-now-btn", function (event) {
   $("#privateB-div").addClass("d-none");
   $("#privateB-buy-now-div").removeClass("d-none");
});
$(document).on("click", "#privateB-buy-now-back-btn", async function (event) {
   await getPrivateBInvestorDetail(PrivateBContract, selectedAccount);
   $("#privateB-div").removeClass("d-none");
   $("#privateB-buy-now-div").addClass("d-none");
});
$(document).on("click", "#privateB-pay-now-back-btn", function (event) {
   $("#privateB-div").removeClass("d-none");
   $("#privateB-payment-history").removeClass("d-none");
   $("#privateB-pay-now-div").addClass("d-none");
});
$(document).on("click", "#privateB-payment-history-tab", function (event) {
   $("#privateB-payment-history").removeClass("d-none");
   $("#privateB-pay-now-div").addClass("d-none");
   // $('#privateB-buy-now-btn').addClass('d-none');

   filters.investor_address = $(".Wallet_address").val();
   filterData(privateB_history_url, "privateB-payment-history-table");
});

// public sale
$("#publicsale-tab").click(async function (event) {
   clearAllInterval();
});
$(document).on("click", "#publicsale-payment-history-tab", function (event) {
   $("#publicsale-payment-history").removeClass("d-none");
   $("#publicsale-pay-now-div").addClass("d-none");
   // $('#publicsale-buy-now-btn').addClass('d-none');

   filters.investor_address = $(".Wallet_address").val();
   filterData(public_history_url, "publicsale-payment-history-table");
});
$(document).on("click", "#series-inner-b-tab", function (event) {
   $("#publicsale-buy-now-btn").removeClass("d-none");
});
$(document).on("click", "#publicsale-buy-now-btn", async function (event) {
   $("#publicsale-div").addClass("d-none");
   $("#publicsale-buy-now-div").removeClass("d-none");
});
$(document).on("click", "#publicsale-buy-now-back-btn", async function (event) {
   await getPublicSaleInvestorDetail(PublicSaleContract, selectedAccount);
   $("#publicsale-div").removeClass("d-none");
   $("#publicsale-buy-now-div").addClass("d-none");
});
$(document).on("click", "#pubsale-pay-now-back-btn", function (event) {
   $("#publicsale-div").removeClass("d-none");
   $("#publicsale-buy-now-div").addClass("d-none");
});
$(document).on("click", "#publicsale-pay-now-back-btn", function (event) {
   $("#publicsale-div").removeClass("d-none");
   $("#publicsale-payment-history").removeClass("d-none");
   $("#publicsale-pay-now-div").addClass("d-none");
});
$("#confirm").click(function (e) {
   $("#whitelist-loader").removeClass("d-none");
   $("#confirm").prop("disabled", true);
   $("#whitelist-form")
      .ajaxForm(function (res) {
         if (res.flag == 1) {
            Toast(res.msg, 3000, res.flag);
            $("#whitelist-loader").addClass("d-none");
            $("#confirm").prop("disabled", false);
         } else {
            Toast(res.msg, 3000, res.flag);
         }
      })
      .submit();
});

// Hide show whitelist div
async function isEligibleForClaim(contract) {
   let response;
   await contract.methods
      .isEligibleForClaim()
      .call({ from: selectedAccount }, function (error, res) {
         if (error) {
            console.log("---error---");
         }
         response = res;
      });
   return response;
}
async function getTokenBalance(contract, address) {
   await contract.methods.balanceOf(address).call(function (error, res) {
      if (error) {
         console.log("---error---");
         console.log(error);
         return 0;
      }
      res = web3.utils.fromWei(res, "ether");
      res = number_format(res);

      // res = parseFloat(res).toFixed(8).toLocaleString();
      $("#token-balance").html(res);
      return res;
   });
}
async function getTokenUsdPrice(contract, address) {
   await contract.methods.getTokenPrice().call(function (error, res) {
      if (error) {
         console.log("---error---");
         console.log(error);
         return 0;
      }
      res = number_format(res / 1000);
      usdPrice = res;
      console.log('USD PRICE : ', usdPrice);
      // res = parseFloat(res).toFixed(8).toLocaleString();
      $(".token_usd_price").html(res);
      return res;
   });
}
async function getInvestorDetail(contract, address) {
   let response;
   await contract.methods.investors(address).call(function (error, res) {
      if (error) {
         console.log("---error---");
         console.log(error);
      }
      console.log("Investor Detail>>>>>>>>>>>>>>>>>>>>>>>>");
      console.log(res);
      console.log(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>");
      response = res;
   });
   return response;
}
async function getVestingTime(contract) {
   let response;
   await contract.methods.getVestingTime().call(function (error, res) {
      if (error) {
         console.log("---error---");
      }
      response = res;
      console.log("Vesting Time>>>>>>>>>>>>>>>>>>>>>>>>");
      console.log(res);
      console.log(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>");
   });
   response = parseInt(response);
   return response * 1000;
}
async function isVestingTimeStarted(contract) {
   var response;
   await contract.methods.isVestingTimeStarted().call(function (error, res) {
      if (error) {
         console.log("---error---");
      }
      console.log("Check Vesting Time Started>>>>>>>>>>>>>>>>>>>>>>>>");
      console.log(res);
      console.log(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>");
      response = res;
   });
   return response;
}
async function getTokenGenerateTime(contract) {
   let response;
   console.log(contract);
   await contract.methods.tokenGenerateTime().call(function (error, res) {
      if (error) {
         console.log("---error---");
      }
      console.log("TokenGenerate Time>>>>>>>>>>>>>>>>>>>>>>>>");
      console.log(res);
      console.log(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>");
      response = res;
   });
   response = parseInt(response);
   return response * 1000;
}
async function isTokenGenerateStarted(contract) {
   var response;
   console.log(contract);
   await contract.methods.isTokenGenerateEventStarted().call(function (error, res) {
      if (error) {
         console.log("---error---");
      }
      console.log(
         "Check TokenGenerate Time Started>>>>>>>>>>>>>>>>>>>>>>>>"
      );
      console.log(res);
      console.log(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>");
      response = res;
   });
   return response;
}
function getUsd(obj) {
   var value = Number(obj.value) * Number(usdPrice);
   if (isNaN(value)) {
      $("#usd_amount").val(0);
   } else {
      $("#usd_amount").val(number_usd(value));
   }
}
function number_usd(value) {
   var vall = value;
   value = value.toString();
   if (value.indexOf(".") > -1) {
      var vlaues = parseFloat(value).toFixed(2).split(".");
      var floatValue = parseFloat(vlaues[1]);
      if (floatValue > 0) {
         var val = vlaues[1];
         if (val.length > 2) {
            return parseFloat(vall).toFixed(2);
         } else {
            return vlaues[0] + "." + val;
         }
      } else {
         return vlaues[0];
      }
   } else {
      return value;
   }
}
function number_token(value) {
   var vall = value;
   value = value.toString();
   if (value.indexOf(".") > -1) {
      var vlaues = parseFloat(value).toFixed(8).split(".");
      var floatValue = parseFloat(vlaues[1]);
      if (floatValue > 0) {
         var val = vlaues[1];
         if (val.length > 2) {
            return parseFloat(vall).toFixed(8);
         } else {
            return vlaues[0] + "." + val;
         }
      } else {
         return vlaues[0];
      }
   } else {
      return value;
   }
}
function clearAllInterval() {
   clearInterval(publicSaleTimer);
   clearInterval(privateATimer);
   clearInterval(seedTimer);
   clearInterval(privateBTimer);
}
async function HideAllTab(contract, address, tabName) {
   // var seriesContracts = await isTokenGenerateStarted(contract);
   // if (seriesContracts) {
   //    Investor = await getInvestorDetail(contract, address);
   //    if (parseInt(Investor["lockedAcb"]) == 0 && parseInt(Investor["releasedAcb"]) == 0) {
   //       // $("#" + tabName + "-tab").prop("disabled", true);
   //    }
   // }
}



function CountdownTracker(label, value) {

   var el = document.createElement('span');

   el.className = 'flip-clock__piece';
   el.innerHTML = '<b class="flip-clock__card card_panel"><b class="card__top"></b><b class="card__bottom"></b><b class="card__back"><b class="card__bottom"></b></b></b>' +
      '<span class="flip-clock__slot">' + label + '</span>';

   this.el = el;

   var top = el.querySelector('.card__top'),
      bottom = el.querySelector('.card__bottom'),
      back = el.querySelector('.card__back'),
      backBottom = el.querySelector('.card__back .card__bottom');

   this.update = function (val) {
      val = ('0' + val).slice(-2);
      if (val !== this.currentValue) {

         if (this.currentValue >= 0) {
            back.setAttribute('data-value', this.currentValue);
            bottom.setAttribute('data-value', this.currentValue);
         }
         this.currentValue = val;
         top.innerText = this.currentValue;
         backBottom.setAttribute('data-value', this.currentValue);

         this.el.classList.remove('flip');
         void this.el.offsetWidth;
         this.el.classList.add('flip');
      }
   }

   this.update(value);
}

function getTimeRemaining(endtime) {
   var t = Date.parse(endtime) - Date.parse(new Date());
   return {
      'Total': t,
      'Days': Math.floor(t / (1000 * 60 * 60 * 24)),
      'Hours': Math.floor((t / (1000 * 60 * 60)) % 24),
      'Minutes': Math.floor((t / 1000 / 60) % 60),
      'Seconds': Math.floor((t / 1000) % 60)
   };
}



