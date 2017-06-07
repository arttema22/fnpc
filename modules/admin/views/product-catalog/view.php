<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Products catalog'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('admin', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="row">
        <div class="col-md-6">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    [
                        'attribute' => 'parent_id',
                        'value' => $model->parent_id ? $model->catalog->name : Yii::t('admin', 'Root category'),
                    ],
                    's_desc',
                    [
                        'attribute' => 'active',
                        'value' => !$model->active ? '<span class="text-danger glyphicon glyphicon-remove"></span>' :
                                '<span class="text-success glyphicon glyphicon-ok"></span>',
                        'format' => 'html',
                    ],
                    'col',
                ],
            ])
            ?>            
        </div>
        <div class="col-md-6">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'keywords',
                    'description',
                ],
            ])
            ?> 
        </div>
    </div>
</div>