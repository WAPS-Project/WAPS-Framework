// Hier können JavaScript Functionen und Klassen definiert werden


function pageChanger(page) {

  var pageClass = document.getElementById('pageName');

  pageClass.classList.remove();

  pageClass.classList.add(page);

}
