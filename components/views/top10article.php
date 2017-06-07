<?php

use yii\helpers\Url;
?>



<section class="well2 bg-secondary">
    <div class="container">
        <h3><?= Yii::t('app', 'New articles') ?></h3>
        <div class="row">
            <div class="col-sm-12">
                <div class="thumbnail wow fadeIn animated" data-wow-delay="0.6s" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-delay: 0.6s; animation-name: fadeIn;">
                    <ul class="marked-list">
                        <?php foreach ($articles as $article) { ?>
                            <li><a href="<?= Url::to(['article/view', 'id' => $article['id']]) ?>"><?= $article['title'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="well2 bg-primary">
    <div class="container">
        <h3><?= Yii::t('app', 'New articles') ?></h3>
        <div class="row">
            <div class="col-sm-12">
                <div class="thumbnail wow fadeIn animated" data-wow-delay="0.6s" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-delay: 0.6s; animation-name: fadeIn;">
                    <ul class="marked-list">
                        <?php foreach ($articles as $article) { ?>
                            <li><a href="<?= Url::to(['article/view', 'id' => $article['id']]) ?>"><?= $article['title'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
