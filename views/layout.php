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
</head>
<body>
<main class="main-content">
    <h1 class="page-title"><?= $title ?></h1>
    <?= $content ?>
</main>
</body>
</html>