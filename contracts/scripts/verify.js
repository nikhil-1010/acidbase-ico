const hre =  require('hardhat');

async function main() {
    await hre.run("verify:verify", {
        address: "0x85201091F3f87bb4b1Eb40D76c57C205263273Ee"
    });
}

main();