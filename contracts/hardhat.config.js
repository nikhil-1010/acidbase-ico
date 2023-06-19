require("@nomicfoundation/hardhat-toolbox");
/** @type import('hardhat/config').HardhatUserConfig */
module.exports = {
  networks: {
    mumbai: {
      url: "https://polygon-mumbai.infura.io/v3/4458cf4d1689497b9a38b1d6bbf05e78",
      accounts: ["a8e7db34d53d3ebc289e296def6d09290043ce979dba92742f6c5660dec5b2f3"]
    },
    sepolia: {
      url: "https://sepolia.infura.io/v3/e75719c8910f4fc98f3e5357c4212e30",
      accounts: ["a8e7db34d53d3ebc289e296def6d09290043ce979dba92742f6c5660dec5b2f3"]
    },
    bsc: {
      url: "https://data-seed-prebsc-1-s1.binance.org:8545",
      accounts: ["a8e7db34d53d3ebc289e296def6d09290043ce979dba92742f6c5660dec5b2f3"]
    },
  },
  solidity: {
    version: "0.8.17",
    settings: {
      optimizer: {
        enabled: true,
        runs: 200
      }
    }
  },
  etherscan: {
    apiKey: "9G1BR83X44G7U2RNIU729SVCD6R6NT7K4X"
  },
};

// const sepolia = "9G1BR83X44G7U2RNIU729SVCD6R6NT7K4X";
// const mumbai = "ACENXKYYXWZ44I99KXBFCZ5MUUE5KB2DGU";
// const bsctest = "G56QWG131V9RIF4DQE6S7I2SWTPTI258GV";



// // require("@nomiclabs/hardhat-waffle");
// // require("@nomiclabs/hardhat-ethers");
// // require('@openzeppelin/hardhat-upgrades');
// // require("@nomiclabs/hardhat-etherscan");
// // require("@nomiclabs/hardhat-ganache");
// require("@nomicfoundation/hardhat-toolbox");


// etherscanApiKey = "9G1BR83X44G7U2RNIU729SVCD6R6NT7K4X";

// // This is a sample Hardhat task. To learn how to create your own go to
// // https://hardhat.org/guides/create-task.html
// task("accounts", "Prints the list of accounts", async (taskArgs, hre) => {
//   const accounts = await hre.ethers.getSigners();

//   for (const account of accounts) {
//     console.log(account.address);
//   }
// });

// // You need to export an object to set up your config
// // Go to https://hardhat.org/config/ to learn more

// /**
//  * @type import('hardhat/config').HardhatUserConfig
//  */

// module.exports = {
//   defaultNetwork: "local",
//   networks: {
//     hardhat: {
//       chainId: 11155111
//     },
//     rinkeby: {
//       url: "https://rinkeby.infura.io/v3/3f83f8e981094005ab2840760cfb41d9",
//       accounts: ["12d191067cef03ce4a94e9a9355e550fa7fe5d01f8fc2381c113505a3851e61d","be7db37e07e8717c49d3a5f1d850c0d8d521296c968823924fd2b812fa5fcd5e","e8157bf90f80e92327deb4b80ad8aefd9490ce2e1a12f46b4fe88c94e3bec16a"],
//       gas: 2100000,
//       gasPrice: 8000000000
//     },
//     ropsten: {
//       url: "https://rinkeby.infura.io/v3/3f83f8e981094005ab2840760cfb41d9",
//       accounts:  ["12d191067cef03ce4a94e9a9355e550fa7fe5d01f8fc2381c113505a3851e61d","be7db37e07e8717c49d3a5f1d850c0d8d521296c968823924fd2b812fa5fcd5e","e8157bf90f80e92327deb4b80ad8aefd9490ce2e1a12f46b4fe88c94e3bec16a"],
//     },
//     sepolia: {
//       url: "https://sepolia.infura.io/v3/e75719c8910f4fc98f3e5357c4212e30",
//       accounts: ["a8e7db34d53d3ebc289e296def6d09290043ce979dba92742f6c5660dec5b2f3"]
//     },
//     local: {
//       url: "http://127.0.0.1:8545",
//       // url: "HTTP://192.168.0.104:7545",
//       chainId: 1337,
//       accounts: ["1a71febda34aca7b50e4384365df110a820b6dbe224269e36a298771c6c68462", "bcf813e9cfc19c405056710e42194e99260ad83c843b568885834e505dcbaf1f","29bca481dcb73bb07bb780cd986bda58b812806adb8efe07831d60efd781608b"],
//       gas: 2100000,
//       gasPrice: 8000000000
//     }
//   },
//   mocha: {
//     timeout: 10000000
//   },
//   solidity: "0.8.9",
//   // solidity: {
//   //   version: "0.8.2",
//   //   // version: "0.8.2",
//   //   settings: {
//   //     optimizer: {
//   //       enabled: true,
//   //       runs: 200
//   //     }
//   //   }
//   // },
//   etherscan: {
//     apiKey: etherscanApiKey
//   },
// };

// // import('hardhat/config').HardhatUserConfig;

// // const config: HardhatUserConfig = {
// //   solidity: "0.8.9",
// // };

// // export default config;