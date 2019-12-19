import {jsJsx} from "ts-loader/dist/constants";

class ConfigMapLoader {

    async main() {
        while (true) {
            await this.wait(50000);
            this.request("pageList");
            this.request("pluginList");
            await this.wait(50000);
        }
    }

    wait(time) {
        return new Promise(resolve => {
            setTimeout(() => {
                resolve();
            }, time);
        });
    }

    request(command) {
        $.post('/API.php?apiMode=service', { svmode:command },function ( data ) {
            console.log('Event: ' + data);
        })
    }
}

let c = new ConfigMapLoader();

c.main();