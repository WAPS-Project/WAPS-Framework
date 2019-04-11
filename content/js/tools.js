// Hier können JavaScript Functionen und Klassen definiert werden

var xhr = new XMLHttpRequest();

 function pushJS(call) {

  xhr.open("POST", "core/head.php", true);

  xhr.onreadystatechange = console.log('push');

  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.send("pagename=" + escape(call.value));

}
