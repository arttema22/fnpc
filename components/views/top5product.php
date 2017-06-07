<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>


<?php if (Yii::$app->language == 'ru') { ?>
    <section class="clearfix center wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
        <?php foreach ($products as $product) { ?>
            <div class="thumbnail thumbnail_box">
                <div class="thumbnail_box_img">
                    <?php $image = $product->getImage(); ?>
                    <?= Html::img($image->getUrl(), ['class' => 'img-responsive', 'alt' => $product['name']]); ?>
                    <span class="overlay"></span>
                </div>
                <div class="thumbnail_box_cnt">
                    <h3 class="ttu"><?= $product['name']; ?></h3>
                    <p><?= substr($product['appointment'], 0, strpos($product['appointment'], ' ', 160)) . '...'; ?></p>
                    <a href="<?= Url::to(['product/view', 'id' => $product['id']]) ?>" class="btn"><?= Yii::t('app', 'see all'); ?></a>
                </div>
            </div>
        <?php } ?>
    </section>
<?php } else { ?>
    <section class="clearfix center wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
        <?php foreach ($products as $product) { ?>
            <div class="thumbnail thumbnail_box">
                <div class="thumbnail_box_img">
                    <?php $image = $product->getImage(); ?>
                    <?= Html::img($image->getUrl(), ['class' => 'img-responsive', 'alt' => $product['name_en']]); ?>
                    <span class="overlay"></span>
                </div>
                <div class="thumbnail_box_cnt">
                    <h3 class="ttu"><?= $product['name_en']; ?></h3>
                    <?php if (isset($product['appointment_en'])) { ?>
                        <p><?= substr($product['appointment_en'], 0, strpos($product['appointment_en'], ' ', 160)) . '...'; ?></p>
                    <?php } ?>
                    <a href="<?= Url::to(['product/view', 'id' => $product['id']]) ?>" class="btn"><?= Yii::t('app', 'see all'); ?></a>
                </div>
            </div>
        <?php } ?>
    </section>
<?php } ?>
