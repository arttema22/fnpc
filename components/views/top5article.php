<?php

use yii\helpers\Url;
?>

<section class="well2 bg-secondary center767">
    <div class="container">
        <h3><?= Yii::t('app', 'New articles') ?></h3>
        <div class="row">
            <div class="col-sm-4 col-xs-10 col-md-4">
                <article class="thumbnail" data-equal-group="1" style="height: 432px;">
                    <div class="box_inner">
                        <div class="caption">
                            <h4><?= Yii::t('app', 'Patients') ?></h4>
                            <?php foreach ($articles6 as $article) { ?>
                                <p><a href="<?= Url::to(['article/view', 'id' => $article['id']]) ?>"><?= $article['title'] ?></a></p>
                            <?php } ?>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-sm-4 col-xs-10 col-md-4">
                <article class="thumbnail" data-equal-group="1" style="height: 432px;">
                    <div class="box_inner">
                        <div class="caption">
                            <h4><?= Yii::t('app', 'To specialists') ?></h4>
                            <?php foreach ($articles2 as $article) { ?>
                                <p><a href="<?= Url::to(['article/view', 'id' => $article['id']]) ?>"><?= $article['title'] ?></a></p>
                            <?php } ?>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-sm-4 col-xs-10 col-md-4">
                <article class="thumbnail" data-equal-group="1" style="height: 432px;">
                    <div class="box_inner">
                        <div class="caption">
                            <h4><?= Yii::t('app', 'Research and development') ?></h4>
                            <?php foreach ($articles10 as $article) { ?>
                                <p><a href="<?= Url::to(['article/view', 'id' => $article['id']]) ?>"><?= $article['title'] ?></a></p>
                            <?php } ?>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>


<section class="well bg-primary wow fadeIn animated" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: fadeIn;">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 ins767">
                <div class="block-1">
                    <h3 class="ttu"><?= Yii::t('app', 'Patients') ?></h3>
                    <?php foreach ($articles6 as $article) { ?>
                        <p><a href="<?= Url::to(['article/view', 'id' => $article['id']]) ?>"><?= $article['title'] ?></a></p>
                    <?php } ?>
                </div>
            </div>

            <div class="col-sm-4 ins767">
                <div class="block-1">
                    <h3 class="ttu txt-clr1"><?= Yii::t('app', 'To specialists') ?></h3>
                    <?php foreach ($articles2 as $article) { ?>
                        <p><a href="<?= Url::to(['article/view', 'id' => $article['id']]) ?>"><?= $article['title'] ?></a></p>
                    <?php } ?>
                </div>
            </div>

            <div class="col-sm-4 ins767">
                <div class="block-1">
                    <h3 class="ttu"><?= Yii::t('app', 'Research and development') ?></h3>
                    <?php foreach ($articles10 as $article) { ?>
                        <p><a href="<?= Url::to(['article/view', 'id' => $article['id']]) ?>"><?= $article['title'] ?></a></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>