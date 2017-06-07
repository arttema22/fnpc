<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //= Html::a(Yii::t('admin', 'Create Order'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid) {
            if (!$model->status) {
                return ['style' => 'background-color:#fcf8e3;'];
            } else {
                return ['style' => 'background-color:#dff0d8;'];
            }
        },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'created_at',
                    'updated_at',
                    'qty',
                    'sum',
                    [
                        'attribute' => 'status',
                        'value' => function($data) {
                            return !$data->status ? '<span class="text-danger">' . Yii::t('admin', 'Open') . '</span>' :
                                    '<span class="text-success">' . Yii::t('admin', 'Close') . '</span>';
                        },
                        'format' => 'html',
                    ],
                    //'status',
                    // 'name',
                    // 'email:email',
                    // 'phone',
                    // 'address',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
</div>
