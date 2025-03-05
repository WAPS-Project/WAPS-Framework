const fs = require("fs").promises;
const fse = require("fs-extra");

const DEPLOY_TARGET = "./framework.dist";

// Check OS
const platform = process.platform;
const osName = platform === "win32" ? "windows" : platform === "darwin" ? "mac" : "linux";

// Check Node.js version
const nodeVersion = parseFloat(process.version.slice(1));
if (nodeVersion < 18) {
	console.error("Node.js 18 or higher is required!");
	process.exit(1);
}

console.log(`Identified OS: ${osName}`);
console.log(`Deploying to ${DEPLOY_TARGET}`);

async function deploy() {
	try {
		await fs.access(DEPLOY_TARGET).then(() => {
			fs.rm(DEPLOY_TARGET, { recursive: true });
		}).catch(() =>{
			fs.mkdir(DEPLOY_TARGET);
		});
		fs.unlink(`${DEPLOY_TARGET}/deploy.js`);
		await fse.copy("framework.src", DEPLOY_TARGET, { recursive: true });
	} catch (error) {
		console.error(`Error: ${error.message}`);
	}
}

deploy();
