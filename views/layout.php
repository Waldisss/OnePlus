<?php
/**
 * @var $content
 * @var $metaTitle
 * @var $title
 */
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $metaTitle ?></title>
    <link rel="stylesheet" href="../css/style.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<main class="main-content">
    <h1 class="page-title"><?= $title ?></h1>
    <?= $content ?>
</main>
</body>
</html>