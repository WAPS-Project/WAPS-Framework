<?php   // Hier deffinieren wir unseren
        // Page Header, also unter anderem unser
        // Menue


 ?>



<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <img src="content/img/fav.svg" alt="logo" class="logo">
  <a class="navbar-brand" href="#">Seitentitel | [<?php echo $pagename; ?>]</a>
  <button class="navbar-toggler navbar-toggler-icon" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"></button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <?php $indexname1 = "Home"; ?>
        <a class="nav-link <?php if ($pagename == $indexname1) {echo 'active';}?>" href="index.php?pagename=Home" >Home <?php if ($pagename == $indexname1) {echo "<span class='sr-only'>(current)</span>";}?></a>
      </li>
      <li class="nav-item">
        <?php $indexname2 = "Example"; ?>
        <a class="nav-link <?php if ($pagename == $indexname2) {echo 'active';}?> " href="index.php?pagename=Example" >Example <?php if ($pagename == $indexname2) {echo "<span class='sr-only'>(current)</span>";}?></a>
      </li>
      <?php $_USR::UserWelcome(); ?>
    </ul>
    </form>
    <form class="form-inline my-2 my-lg-0 search">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" disabled>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" disabled>Search</button>
    </form>
  </div>
</nav>
