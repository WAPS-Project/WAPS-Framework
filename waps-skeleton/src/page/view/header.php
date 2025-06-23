<?php
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <img src="<?php echo LOGO ?>" alt="logo" class="logo me-2" style="height: 30px;">
        <a class="navbar-brand" href="/Home"><?php echo PAGE_TITLE ?> | [<?php echo $pageName; ?>]</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php /* Main::navigation($pageMap, $pageName); */ ?>
        </div>
    </div>
</nav>
