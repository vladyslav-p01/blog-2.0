<?php

/* @var $usersQuantity */
/* @var $categoriesQuantity */
/* @var $commentsQuantity */
/* @var $postsQuantity */

use yii\helpers\Url;
$this->title = 'Dashboard';
?>
<ul>
    <?php foreach($categoriesQuantity as $categoryQuant): ?>
        <li><?= $categoryQuant[0], ' ' ,$categoryQuant[1] ?></li>
    <?php endforeach; ?>
</ul>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?php echo $usersQuantity; ?></h3>

                <p>Users</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="<?= Url::to(['user/index']) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php echo count($categoriesQuantity); ?></h3>

                <p>Quantity of categories</p>
            </div>
            <div class="icon">
                <i class="fa fa-list-ul"></i>
            </div>
            <a href="<?= Url::to(['category/index']) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3><?= $postsQuantity ?></h3>
                <p>Quantity of posts</p>
            </div>
            <div class="icon">
                <i class="fa fa-file-text-o"></i>
            </div>
            <a href="<?= Url::to(['post/index']) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $commentsQuantity ?></h3>
                <p>Quantity of comments</p>
            </div>
            <div class="icon">
                <i class="fa fa-comments"></i>
            </div>
            <a href="<?= Url::to(['comment/index']) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        <!-- /.info-box -->
    </div>


</div>