<?php // Hier definieren wir unseren
// Page Head, wo unter anderem das Charset
// und der Titel definiert werden
?>


<head>
    <?php require 'config/main.config.php';
    ?>
    <meta charset="<?php echo $charset ?>">
    <meta name="description" content="<?php echo $description ?>">
    <meta name="keywords" content="<?php echo $keywords ?>">
    <meta name="author" content="<?php echo $author ?>">
    <link rel="shortcut icon" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/content/img/fav.png">
    <title>Web Application PHP <?php echo ' - ' . $pageName; ?></title>
    <?php include 'core/scripts.php'; ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Adding Font Awesome -->
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/content/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/content/css/main.css"> <!-- Adding Main CSS -->
</head>
