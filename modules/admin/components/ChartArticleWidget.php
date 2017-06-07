<?php
namespace app\modules\admin\components;

use Yii;
use yii\base\Widget;
use app\modules\admin\models\Article;
use dosamigos\chartjs\ChartJs;

class ChartArticleWidget extends Widget {

    public function run() {

        $artQty0 = Article::find()->where(['status' => '0'])->count();
        $artQty = Article::find()->where(['!=', 'status', '0'])->count();

        $chart = ChartJs::widget([
                    'type' => 'pie',
                    'options' => [
                        'title' => Yii::t('admin', 'Articles'),
                    ],
                    'data' => [
                        'labels' => [Yii::t('admin', 'Not public'), Yii::t('admin', 'Public')],
                        'datasets' => [
                            [
                                'backgroundColor' => ["#FF6384", "#36A2EB"],
                                'data' => [$artQty0, $artQty]
                            ],
                        ]
                    ]
        ]);

        return $chart;
    }

}