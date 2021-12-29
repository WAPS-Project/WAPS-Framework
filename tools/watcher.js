const fs = require('fs');
const path = require('path');
const src = './framework.src/';
const commandStr = 'npm run deploy';
const child = require('child_process');

async function watch(file) {

	// get file type
	const ext = path.extname(file);
	// get file name
	const name = path.basename(file, ext);

	fs.watch(file, (event, filename) => {
		if (filename) {
			if (ext === '.js' || ext === '.sass' || ext === '.scss' || ext === '.ts') {
				console.log(`${filename} changed`);
				command(commandStr)();
			} else {
				console.log(`${filename} changed`);
				command("php ./tools/deploy.php")();
			}
		}

	});
}

// generate a function that runs 'npm run deploy'
watchDir(src)();


function command(cmd) {
	return () => {
		console.log(`Running: ${cmd}`);
		let result = child.execSync(cmd);
		console.log(result.toString());
	};
}

function watchDir(dir) {
	return () => {
		fs.readdirSync(dir).forEach(file => {
			const fullPath = path.resolve(dir, file);
			if (fs.statSync(fullPath).isDirectory()) {
				watchDir(fullPath)();
			} else {
				watch(fullPath);
			}
		});
	};
}

watchDir(src)();

console.log(`Node version: ${process.version}\n \n`);

console.log('Watching...\n');
console.log('Press Ctrl+C to exit.\n');
