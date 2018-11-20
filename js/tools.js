function pageChanger(page) {

  var pageClass = document.getElementById('pageName');

  pageClass.classList.remove();

  $('pageName').classList.add(page);

}
