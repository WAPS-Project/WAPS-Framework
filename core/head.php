<?php // Hier definieren wir unseren
// Page Head, wo unter anderem das Charset
// und der Titel definiert werden
?>


<head>
    <meta charset="<?php echo CHARSET ?>">
    <meta name="description" content="<?php echo DESCRIPTION ?>">
    <meta name="keywords" content="<?php echo KEYWORDS ?>">
    <meta name="author" content="<?php echo AUTHOR ?>">
    <link rel="shortcut icon" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/content/img/fav.png">
    <title>Web Application PHP <?php echo ' - ' . $pageName; ?></title>
    <?php include 'core/scripts.php'; ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Adding Font Awesome -->
    <link rel="stylesheet" href="/content/css/bootstrap.css">
    <link rel="stylesheet" href="/content/css/main.css"> <!-- Adding Main CSS -->
</head>
