<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('admin', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('admin', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('admin', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?php $img = $model->getImage(); ?>
    <div class="row">
        <div class="col-md-6">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'appointment:html',
                    'contraind:html',
                    'size',
                    [
                        'attribute' => 'category_id',
                        'value' => $model->category->name,
                    ],
                    'url',
                ],
            ])
            ?>
        </div>
        <div class="col-md-6">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'image',
                        'value' => "<img src='{$img->getUrl('200x')}'>",
                        'format' => 'html',
                    ],
                    'keywords',
                    'description',
                    'cert',
                ],
            ])
            ?>
        </div>
    </div>
</div>
