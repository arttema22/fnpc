<?php
namespace app\modules\admin\components;

use Yii;
use yii\base\Widget;
use app\modules\admin\models\ProductCatalog;
use dosamigos\chartjs\ChartJs;

class ChartCatWidget extends Widget {

    public function run() {

        $catActive = ProductCatalog::find()->where(['active' => '0'])->count();
        $catClose = ProductCatalog::find()->where(['active' => '1'])->count();

        $chart = ChartJs::widget([
                    'type' => 'pie',
                    'options' => [
                        'title' => Yii::t('admin', 'Category'),
                    ],
                    'data' => [
                        'labels' => [Yii::t('admin', 'Close'), Yii::t('admin', 'Open')],
                        'datasets' => [
                            [
                                'backgroundColor' => ["#FF6384", "#36A2EB"],
                                'data' => [$catActive, $catClose]
                            ],
                        ]
                    ]
        ]);

        return $chart;
    }

}