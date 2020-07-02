<?php
/**
 * @var $points
 */
?>

<section class="game">
    <p id="counter" class="number"><?= $points ?></p>
    <form class="button-group" action="/index.php" method="post">
        <input class="btn" type="submit" name="addOne" value="+1" id="btn-add-one">
        <input class="btn" type="submit" name="exit" value="Выход">
    </form>
    <script type="text/javascript" src="/js/ajaxGame.js"></script>
</section>
