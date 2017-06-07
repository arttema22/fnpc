<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = Yii::t('admin', 'View order: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

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

    <div class="row">
        <div class="col-md-6">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'created_at',
                    'updated_at',
                    'qty',
                    'sum',
                    [
                        'attribute' => 'status',
                        'value' => !$model->status ? '<span class="text-danger">' . Yii::t('admin', 'Open') . '</span>' :
                                '<span class="text-success">' . Yii::t('admin', 'Close') . '</span>',
                        'format' => 'html',
                    ],
                ],
            ])
            ?>
        </div>
        <div class="col-md-6">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'email:email',
                    'phone',
                    'address',
                ],
            ])
            ?>
        </div>
    </div>

    <?php $items = $model->orderItems; ?>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th><?= Yii::t('admin', 'Name') ?></th>
                    <th><?= Yii::t('admin', 'Quantity') ?></th>
                    <th><?= Yii::t('admin', 'Price') ?></th>
                    <th><?= Yii::t('admin', 'Sum') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['qty_item'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><?= $item['sum_item'] ?></td>
                    </tr>
                <?php endforeach; ?>               
            </tbody>
        </table>
    </div>
</div>