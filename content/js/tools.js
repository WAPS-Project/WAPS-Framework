// Hier können JavaScript Functionen und Klassen definiert werden



//getting the user IP

function getUserIP(onNewIP) { //  onNewIp - your listener function for new IPs
    //compatibility for firefox and chrome
    var myPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
    var pc = new myPeerConnection({
        iceServers: []
    }),
    noop = function() {},
    localIPs = {},
    ipRegex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g,
    key;

    function iterateIP(ip) {
        if (!localIPs[ip]) onNewIP(ip);
        localIPs[ip] = true;
    }

     //create a bogus data channel
    pc.createDataChannel("");

    // create offer and set local description
    pc.createOffer().then(function(sdp) {
        sdp.sdp.split('\n').forEach(function(line) {
            if (line.indexOf('candidate') < 0) return;
            line.match(ipRegex).forEach(iterateIP);
        });

        pc.setLocalDescription(sdp, noop, noop);
    }).catch(function(reason) {
        // An error occurred, so handle the failure to connect
    });

    //listen for candidate events
    pc.onicecandidate = function(ice) {
        if (!ice || !ice.candidate || !ice.candidate.candidate || !ice.candidate.candidate.match(ipRegex)) return;
        ice.candidate.candidate.match(ipRegex).forEach(iterateIP);
    };
}










function anfrage_abschicken(ip)
{
	// Browserkompatibles Request-Objekt erzeugen:
	r = null;

	if(window.XMLHttpRequest)
	{
		r = new XMLHttpRequest();
	}
	else if(window.ActiveXObject)
	{
		try
		{
			r = new ActiveXObject('Msxml2.XMLHTTP');
		}
		catch(e1)
		{
			try
			{
				r = new ActiveXObject('Microsoft.XMLHTTP');
			}
			catch(e2)
			{
				document.getElementsByClassName('status').innerHTML =
				"Request nicht möglich.";
			}
		}
	}

	// Wenn Request-Objekt vorhanden, dann Anfrage senden:
	if(r != null)
	{

		// HTTP-POST
		r.open('POST', 'index.php', true);
		r.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		r.send('ip='+ip);

		window.document.getElementsByClassName('status').innerHTML = 'Request gesendet.';
	}
}



getUserIP(function(ip) {
  anfrage_abschicken(ip);
})
