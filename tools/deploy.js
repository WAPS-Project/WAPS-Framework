const os = require('os');
const fs = require('fs');

let whatOs = os.platform().toString();

let wapsConfig = JSON.parse(fs.readFileSync('./waps.config.json'));

let deployTarget = wapsConfig['deploy-target'];

console.log(`Identified OS: ${whatOs}`);
console.log(`Deploying to ${deployTarget}`);

if (fs.existsSync(deployTarget)) {
	fs.rmSync(deployTarget, { recursive: true });
}

fs.mkdirSync(deployTarget);

copyFiles('./framework.src', deployTarget, ['src']);

function copyFiles(src, dest, ignoreDirs) {
	fs.readdirSync(src).forEach(file => {
		let srcPath = `${src}/${file}`;
		let destPath = `${dest}/${file}`;
		let stats = fs.statSync(srcPath);
		if (stats.isFile()) {
			fs.copyFileSync(srcPath, destPath);
		} else if (stats.isDirectory() && ignoreDirs.indexOf(file) === -1) {
			if (!fs.existsSync(destPath)) {
				fs.mkdirSync(destPath);
			}
			copyFiles(srcPath, destPath, ignoreDirs);
		}
	});
}
