<?php
/**
 * @var $points
 */
?>

<section class="game">
    <p class="number"><?= $points ?></p>
    <form class="button-group" action="/index.php" method="post">
        <input class="btn" type="submit" name="addOne" value="+1">
        <input class="btn" type="submit" name="exit" value="Выход">
    </form>
</section>
