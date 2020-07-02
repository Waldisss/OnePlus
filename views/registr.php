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
    <input type="password" name="password-copy" placeholder="Повторите пароль">
    <input type="date" name="birthday" placeholder="Дата рождения">
    <div class="button-group">
        <input class="btn btn-registr" type="submit" value="Зарегистрироваться">
    </div>
</form>