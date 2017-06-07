<?php
namespace app\modules\admin\components;

use Yii;
use yii\base\Widget;
use app\modules\admin\models\Order;
use dosamigos\chartjs\ChartJs;

class ChartOrderWidget extends Widget {

    public function run() {

        $orderActive = Order::find()->where(['status' => '0'])->count();
        $orderClose = Order::find()->where(['status' => '1'])->count();

        $chart = ChartJs::widget([
                    'type' => 'pie',
                    'options' => [
                        'title' => Yii::t('admin', 'Orders'),
                    ],
                    'data' => [
                        'labels' => [Yii::t('admin','Open'), Yii::t('admin','Close')],
                        'datasets' => [
                            [
                                'backgroundColor' => ["#FF6384", "#36A2EB"],
                                'data' => [$orderActive, $orderClose]
                            ],
                        ]
                    ]
        ]);

        return $chart;
    }

}