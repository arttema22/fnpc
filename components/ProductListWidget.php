<?php

namespace app\components;

use yii\base\Widget;
use app\models\Product;

class ProductListWidget extends Widget {

    public function run() {

        $products = Product::find()->orderBy('id')->asArray()->all();

        // error
        if (empty($products))
            return;

        return $this->render('productlist', compact('products'));
    }

}
