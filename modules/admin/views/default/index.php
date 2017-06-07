<?php
/* @var $this yii\web\View */

use app\modules\admin\components\ChartArticleWidget;
use app\modules\admin\components\ChartOrderWidget;
use app\modules\admin\components\ChartCatWidget;
use app\modules\admin\components\ChartProductWidget;

$this->title = Yii::t('admin', 'Dashboard');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row text-center">
        <div class="col-md-4">
            <h4><?= Yii::t('admin', 'Articles'); ?></h4>
            <?= ChartArticleWidget::widget() ?>
        </div>
<!--        <div class="col-md-4">
            <h4><?= Yii::t('admin', 'Orders'); ?></h4>
            <?= ChartOrderWidget::widget() ?>
        </div>
        <div class="col-md-4">
            <h4><?= Yii::t('admin', 'Categories'); ?></h4>
            <?= ChartCatWidget::widget() ?>
        </div>
        <div class="col-md-4">
            <h4><?= Yii::t('admin', 'Products'); ?></h4>
            <?= ChartProductWidget::widget() ?>
        </div>-->
    </div>
</div>