const { time, loadFixture } = require("@nomicfoundation/hardhat-network-helpers");
const { expect } = require("chai");
const { ethers } = require("hardhat");

async function deployOneFixture() {

    const [admin, address1, address2] = await ethers.getSigners();

    let UBN = await ethers.getContractFactory("UBiOnline");
    let UBISeed = await ethers.getContractFactory("UBISeed");
    let UBIPublicSale = await ethers.getContractFactory("UBIPublicSale");
    let UBIPrivateA = await ethers.getContractFactory("UBIPrivateA");
    let UBIPrivateB = await ethers.getContractFactory("UBIPrivateB");

    UBN = await UBN.deploy();
    await UBN.transfer(address1.address, ethers.utils.parseUnits("1000", 18));
    await UBN.transfer(address2.address, ethers.utils.parseUnits("1000", 18));

    UBISeed = await UBISeed.deploy();
    await UBISeed.changeUbiAddress(UBN.address);
    await UBISeed.addWhiteTokenAddress(UBN.address, 1);
    await UBN.setExcludedAddress(UBISeed.address, true);
    await UBN.transfer(UBISeed.address, ethers.utils.parseUnits("2000", 18));
    await UBN.connect(address1).approve(UBISeed.address, ethers.utils.parseUnits("1000", 18));

    UBIPublicSale = await UBIPublicSale.deploy();
    await UBIPublicSale.changeUbiAddress(UBN.address);
    await UBIPublicSale.addWhiteTokenAddress(UBN.address, 1);
    await UBN.setExcludedAddress(UBIPublicSale.address, true);
    await UBN.transfer(UBIPublicSale.address, ethers.utils.parseUnits("1000", 18));
    await UBN.connect(address1).approve(UBIPublicSale.address, ethers.utils.parseUnits("1000", 18));

    UBIPrivateA = await UBIPrivateA.deploy();
    await UBIPrivateA.changeUbiAddress(UBN.address);
    await UBIPrivateA.addWhiteTokenAddress(UBN.address, 1);
    await UBN.setExcludedAddress(UBIPrivateA.address, true);
    await UBN.transfer(UBIPrivateA.address, ethers.utils.parseUnits("1000", 18));
    await UBN.connect(address2).approve(UBIPrivateA.address, ethers.utils.parseUnits("1000", 18));

    UBIPrivateB = await UBIPrivateB.deploy();
    await UBIPrivateB.changeUbiAddress(UBN.address);
    await UBIPrivateB.addWhiteTokenAddress(UBN.address, 1);
    await UBN.setExcludedAddress(UBIPrivateB.address, true);
    await UBN.transfer(UBIPrivateB.address, ethers.utils.parseUnits("1000", 18));
    await UBN.connect(address2).approve(UBIPrivateB.address, ethers.utils.parseUnits("1000", 18));

    let block = await ethers.provider.getBlock();
    let timestamp = Number(block.timestamp);

    return { admin, address1, address2, address2, UBN, UBISeed, UBIPublicSale, UBIPrivateA, UBIPrivateB, timestamp };
}


describe("UBISeed", function() {

    it("Should withdraw", async function() {
        const { address1, UBISeed, UBN, timestamp } = await loadFixture(deployOneFixture);

        await UBISeed.connect(address1).addInvestor(UBN.address, ethers.utils.parseUnits("100", 18));
        await expect(UBISeed.connect(address1).withdrawUbi(UBN.address, address1.address,ethers.utils.parseUnits("50", 18))).to.be.revertedWith("Only owner access");

    });
    it("Should work accordingly", async function() {
        const { address1, UBISeed, UBN, timestamp } = await loadFixture(deployOneFixture);

        await UBISeed.connect(address1).addInvestor(UBN.address, ethers.utils.parseUnits("100", 18));
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("900", 18));
        
        await time.increaseTo(timestamp + 5*60);
        await UBISeed.connect(address1).generateToken();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("908", 18));
        
        await expect( UBISeed.claimUbi()).to.be.revertedWith(" Invalid investor. ");

        await time.increaseTo(timestamp + 30*24*60*60);
        await UBISeed.connect(address1).claimUbi();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("912", 18));
        
        await time.increaseTo(timestamp + 30*24*60*60*15);
        await UBISeed.connect(address1).claimUbi();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("968", 18));

        await expect( UBISeed.connect(address1).claimUbi()).to.be.revertedWith("Not eligible for claim.");
    })

    it("Should transfer all tokens", async function() {
        const { address1, UBISeed, UBN, timestamp } = await loadFixture(deployOneFixture);

        expect(await UBISeed.connect(address1).addInvestor(UBN.address, ethers.utils.parseUnits("100", 18)))
        .to.emit(UBISeed, "AddInvestor").withArgs(UBN.address, address1.address, 100, 100);

        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("900", 18));

        await time.increaseTo(timestamp + 5*60);
        await UBISeed.connect(address1).generateToken();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("908", 18));
        
        await expect( UBISeed.claimUbi()).to.be.revertedWith(" Invalid investor. ");
        
        await time.increaseTo(timestamp + 10*60);
        await UBISeed.connect(address1).claimUbi();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("912", 18));
        
        await time.increaseTo(timestamp + 30*24*60*60*2 + 10);
        await UBISeed.connect(address1).claimUbi();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("916", 18));
        
        await time.increaseTo(timestamp + 30*24*60*60*30);
        await UBISeed.connect(address1).claimUbi();
        await expect( UBISeed.connect(address1).claimUbi()).to.be.revertedWith("Not eligible for claim.");
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("1000", 18));
    })
})

describe("UBIPublicSale", function() {

    it("Should test the UBIPublicSale Contract", async function() {
        const {address1, UBN, UBIPublicSale, timestamp } = await loadFixture(deployOneFixture);

        await UBIPublicSale.connect(address1).addInvestor(UBN.address, ethers.utils.parseUnits("100", 18));

        await time.increaseTo(timestamp + 5*60);
        await UBIPublicSale.connect(address1).generateToken();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("908", 18));

        await time.increaseTo(timestamp + 30*24*60*60*2);
        await UBIPublicSale.connect(address1).claimUbi();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("915.66", 18));

        await time.increaseTo(timestamp + 30*24*60*60*8);
        await UBIPublicSale.connect(address1).claimUbi();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("961.62", 18));
    })

    it("Should test the UBIPublicSale Contract", async function() {
        const {address1, UBN, UBIPublicSale, timestamp } = await loadFixture(deployOneFixture);

        await UBIPublicSale.connect(address1).addInvestor(UBN.address, ethers.utils.parseUnits("100", 18));

        await time.increaseTo(timestamp + 5*60);
        await UBIPublicSale.connect(address1).generateToken();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("908", 18));

        await time.increaseTo(timestamp + 10*60);
        await UBIPublicSale.connect(address1).claimUbi();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("915.66", 18));
        await time.increaseTo(timestamp + 30*24*60*60*3);
        await UBIPublicSale.connect(address1).claimUbi();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("930.98", 18));
        await time.increaseTo(timestamp + 30*24*60*60*4 + 10);
        await UBIPublicSale.connect(address1).claimUbi();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("938.64", 18));
        await time.increaseTo(timestamp + 30*24*60*60*5 + 20);
        await UBIPublicSale.connect(address1).claimUbi();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("946.3", 18));
        await time.increaseTo(timestamp + 30*24*60*60*6 + 30);
        await UBIPublicSale.connect(address1).claimUbi();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("953.96", 18));
        await time.increaseTo(timestamp + 30*24*60*60*18 + 40);
        await UBIPublicSale.connect(address1).claimUbi();
        expect(await UBN.balanceOf(address1.address)).to.equal(ethers.utils.parseUnits("1000", 18));
    })
})

describe("UBIPrivateA", function() {
    it("Should Test the UBIPrivateA Contract", async function() {
        const {address2,address1, UBN, UBIPrivateA, timestamp } = await loadFixture(deployOneFixture);

        await UBIPrivateA.connect(address2).addInvestor(UBN.address, ethers.utils.parseUnits("100", 18));

        await time.increaseTo(timestamp + 5*60);
        await UBIPrivateA.connect(address2).generateToken();
        expect(await UBN.balanceOf(address2.address)).to.equal(ethers.utils.parseUnits("908"));

        await time.increaseTo(timestamp + 10*60);
        await expect( UBIPrivateA.connect(address1).claimUbi()).to.be.revertedWith(" Invalid investor. ");

        await UBIPrivateA.connect(address2).claimUbi();
        expect(await UBN.balanceOf(address2.address)).to.equal(ethers.utils.parseUnits("912"));

        await time.increaseTo(timestamp + (30*24*60*60*4)+10);
        await UBIPrivateA.connect(address2).claimUbi();
        expect(await UBN.balanceOf(address2.address)).to.equal(ethers.utils.parseUnits("920"));

        await time.increaseTo(timestamp + (30*24*60*60*10) + 20);
        await UBIPrivateA.connect(address2).claimUbi();
        expect(await UBN.balanceOf(address2.address)).to.equal(ethers.utils.parseUnits("932"));


        await time.increaseTo(timestamp + (30*24*60*60*25) + 30);
        await UBIPrivateA.connect(address2).claimUbi();
        expect(await UBN.balanceOf(address2.address)).to.equal(ethers.utils.parseUnits("964"));

        await time.increaseTo(timestamp + 30*24*60*60*38);
        await UBIPrivateA.connect(address2).claimUbi();
        expect(await UBN.balanceOf(address2.address)).to.equal(ethers.utils.parseUnits("1000"));
    })
})

describe("UBIPrivateB", function() {
    it("Should Test the UBIPrivateB Contract", async function() {
        const {address2,address1, UBN, UBIPrivateB, timestamp } = await loadFixture(deployOneFixture);

        await UBIPrivateB.connect(address2).addInvestor(UBN.address, ethers.utils.parseUnits("100", 18));

        await time.increaseTo(timestamp + 5*60);
        await UBIPrivateB.connect(address2).generateToken();
        expect(await UBN.balanceOf(address2.address)).to.equal(ethers.utils.parseUnits("908"));

        await time.increaseTo(timestamp + 10*60);
        await UBIPrivateB.connect(address2).claimUbi();
        expect(await UBN.balanceOf(address2.address)).to.equal(ethers.utils.parseUnits("912"));

        await time.increaseTo(timestamp + 30*24*60*60*3 + 10);
        await UBIPrivateB.connect(address2).claimUbi();
        expect(await UBN.balanceOf(address2.address)).to.equal(ethers.utils.parseUnits("918"));

        await expect( UBIPrivateB.connect(address1).claimUbi()).to.be.revertedWith(" Invalid investor. ");

        await time.increaseTo(timestamp + 30*24*60*60*8 + 20);
        await UBIPrivateB.connect(address2).claimUbi();
        expect(await UBN.balanceOf(address2.address)).to.equal(ethers.utils.parseUnits("928"));

        await time.increaseTo(timestamp + 30*24*60*60*40);
        await UBIPrivateB.connect(address2).claimUbi();
        expect(await UBN.balanceOf(address2.address)).to.equal(ethers.utils.parseUnits("1000"));
    })
})
