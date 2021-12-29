const fs = require('fs');
const path = require('path');
const src = './framework.src/';

const waps = JSON.parse(fs.readFileSync('./waps.config.json', 'utf8'));
const package = JSON.parse(fs.readFileSync('./package.json', 'utf8'));
const composer = JSON.parse(fs.readFileSync('./composer.json', 'utf8'));
const config = JSON.parse(fs.readFileSync(src + '/config/config.json', 'utf8'));

package.version = waps.version;
composer.version = waps.version;
config.head.framework_info.framework_version = waps.version;

package.authors = waps.authors;
composer.authors = waps.authors;

package.description = waps.description;
composer.description = waps.description;
config.head.framework_info.framework_description = waps.description;

package.homepage = waps.homepage;
composer.homepage = waps.homepage;
config.head.framework_info.framework_wiki = waps.homepage;

package.bugs.url = waps.bugs.url;

package.repository.url = waps.repository.url;
package.repository.type = waps.repository.type;
config.head.framework_info.framework_repository = waps.repository.url;

package.license = waps.license;
composer.license = waps.license;
config.head.framework_info.framework_license = waps.license;

fs.writeFileSync('./package.json', JSON.stringify(package, null, 2));
fs.writeFileSync('./composer.json', JSON.stringify(composer, null, 2));
fs.writeFileSync(src + '/config/config.json', JSON.stringify(config, null, 2));
