<?php
/**
 * @var $errorText
 */
?>

<p class="error-notification<?= (isset($errorText) ? '' : ' hidden') ?>">
    <?= (isset($errorText) ? $errorText : '') ?></p>
<form class="default-form" method="post">
    <input type="text" name="login" placeholder="Логин">
    <input type="password" name="password" placeholder="Пароль">
    <div class="button-group">
        <input class="btn" type="submit" value="Войти">
        <a class="btn" href="registr.php">Регистрация</a>
    </div>
</form>
