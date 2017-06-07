<?php

namespace app\components;

use yii\base\Widget;
use app\modules\admin\models\Product;

class Top5productWidget extends Widget {

    public function run() {

        $products = Product::find()->orderBy('id')->limit(5)->all();

        // error
        if (empty($products))
            return;

        return $this->render('top5product', compact('products'));
    }

}
