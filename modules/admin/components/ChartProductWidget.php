<?php
namespace app\modules\admin\components;

use Yii;
use yii\base\Widget;
use app\modules\admin\models\Product;
use dosamigos\chartjs\ChartJs;

class ChartProductWidget extends Widget {

    public function run() {

        $prodQty0 = Product::find()->where(['quantity' => '0'])->count();
        $prodQty = Product::find()->where(['!=', 'quantity', '0'])->count();

        $chart = ChartJs::widget([
                    'type' => 'pie',
                    'options' => [
                        'title' => Yii::t('admin', 'Products'),
                    ],
                    'data' => [
                        'labels' => [Yii::t('admin', 'Not available'), Yii::t('admin', 'Available')],
                        'datasets' => [
                            [
                                'backgroundColor' => ["#FF6384", "#36A2EB"],
                                'data' => [$prodQty0, $prodQty]
                            ],
                        ]
                    ]
        ]);

        return $chart;
    }

}