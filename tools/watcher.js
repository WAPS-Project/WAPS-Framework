const fs = require('fs');
const path = require('path');
const src = './framework.src/';
const child = require('child_process');

/**
 *
 * @param {string} file
 */
function watch(file) {

	// get file type
	const ext = path.extname(file);
	// get file name
	const name = path.basename(file, ext);

	fs.watch(file, (event, filename) => {
		console.log(event);
		if (filename) {
			if (ext === '.sass' || ext === '.scss' || ext === '.ts') {
				console.log(`${filename} changed`);
				command("npm run deploy")();
			} else {
				console.log(`${filename} changed`);
				command("node ./tools/deploy.js")();
			}
		}
	});
}

/**
 *
 * @param {string} cmd
 * @returns void
 */
function command(cmd) {
	return () => {
		console.log(`Running: ${cmd}`);
		console.log(child.execSync(cmd).toString());
	};
}

/**
 *
 * @param {string} dir
 * @returns void
 */
function watchDir(dir) {
	return () => {
		fs.readdirSync(dir, 'utf-8').forEach(file => {
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
