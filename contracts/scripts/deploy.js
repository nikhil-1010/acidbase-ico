const {ethers, upgrades} = require('hardhat');

async function main() {
    // let Cpsd = await ethers.getContractFactory('CPSD');
    // Cpsd = await Cpsd.deploy()
    // // const proxy = await upgrades.deployProxy(Cpsd, {kind: 'uups'});

    // console.log("UUPS deployed: ", Cpsd.address);

    let  preSale = await ethers.getContractFactory('UBIPrivateA');
    preSale = await preSale.deploy();
    // await preSale.changeUbiAddress(Cpsd.address);
    // console.log(await preSale.UBI_address())
    console.log('UBIPrivateA Deployed To : ', preSale.address)

    // preSale = await ethers.getContractFactory('UBIPrivateB');
    // preSale = await preSale.deploy();
    // // await preSale.changeUbiAddress(Cpsd.address);
    // // console.log(await preSale.UBI_address())
    // console.log('UBIPrivateB Deployed To : ', preSale.address)

    // preSale = await ethers.getContractFactory('UBIPublicSale');
    // preSale = await preSale.deploy();
    // // await preSale.changeUbiAddress(Cpsd.address);
    // // console.log(await preSale.UBI_address())
    // console.log('UBIPublicSale Deployed To : ', preSale.address)

    // const PublicSale = await ethers.getContractFactory('CPSDPublicSale');
    // const public_sale = await PublicSale.deploy();

    // console.log('PublicSale Deployed To : ', public_sale.address)

}

main();