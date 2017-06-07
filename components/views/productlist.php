<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>


<?php if (Yii::$app->language == 'ru') { ?>
    <div class="footer-product">
        <h4><?= Yii::t('app', 'Products'); ?></h4>
        <ul>
            <?php foreach ($products as $product) { ?>
                <li>
                    <a href="<?= Url::to(['/product/view', 'id' => $product['id']]) ?>"><?= $product['name']; ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } else { ?>
    <div class="footer-product">
        <h4><?= Yii::t('app', 'Products'); ?></h4>
        <ul>
            <?php foreach ($products as $product) { ?>
                <li>
                    <a href="<?= Url::to(['/product/view', 'id' => $product['id']]) ?>"><?= $product['name']; ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>
