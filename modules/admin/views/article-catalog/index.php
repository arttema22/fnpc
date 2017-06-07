<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = Yii::t('admin', 'Articles catalog');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-catalog-index">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid) {
            if (!$model->active) {
                return ['style' => 'background-color:#EEE;'];
            }
        },
                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],
                    //'id',
                    //'parent_id',
                    'name',
                    's_desc',
                    //'keywords',
                    // 'description',
                    //'active',
                    [
                        'attribute' => 'parent_id',
                        'value' => function($data) {
                            return $data->parent_id ? $data->category->name : Yii::t('admin', 'Root category');
                        },
                    ],
                    [
                        'attribute' => 'active',
                        'class' => '\kartik\grid\BooleanColumn',
                        'trueLabel' => 'Yes',
                        'falseLabel' => 'No',
                    ],
                    // 'col',
                    ['class' => 'kartik\grid\ActionColumn',
                        'deleteOptions' => ['hidden' => true],],
                ],
                'responsive' => true,
                'hover' => true,
                'panel' => [
                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i>&nbsp;&nbsp;' . Html::encode($this->title) . '</h3>',
                    'type' => 'default',
                    'before' => '',
                    'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i>&nbsp;' . Yii::t('admin', 'Reset Grid'), ['index'], ['class' => 'btn btn-info']),
                    'footer' => false,
                ],
            ]);
            ?>
</div>
