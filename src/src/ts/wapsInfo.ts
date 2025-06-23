class WapsInfo {

	constructor() {
		this.request()
	}

	request() {
		$.post('/API.php?apiMode=framework', function (data) {
			console.log("Hostet by WAPS-Framework " + JSON.parse(data)[0]["framework_info"]["framework_version"])
			console.log(JSON.parse(data)[0]["framework_info"]);
		})
	}

}

let d = new WapsInfo()
