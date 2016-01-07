<?php

/* @var $usersQuantity */
/* @var $categoriesQuantity */


$this->title = 'Dashboard';
?>

<?= 'Quantity of users: '. $usersQuantity ?>
<ul>
    <?php foreach($categoriesQuantity as $categoryQuant): ?>
        <li><?= $categoryQuant[0], ' ' ,$categoryQuant[1] ?></li>
    <?php endforeach; ?>
</ul>