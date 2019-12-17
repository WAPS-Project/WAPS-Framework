import {jsJsx} from "ts-loader/dist/constants";

class ConfigMapLoader {

    main() {
        this.timeout(30000);
        this.request("pageList");
        this.request("pluginList");
    }

    timeout(ms) {
        setTimeout(() => {
            this.timeout(ms);
        }, ms);
    }

    request(command) {
        $.post('/core/service.API.php', { svmode:command },function ( data ) {
            console.log('Event: ' + data);
        })
    }
}

let c = new ConfigMapLoader();

c.main();