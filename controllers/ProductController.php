<?php

namespace app\controllers;

use Yii;
use app\controllers\AppController;
use app\models\Product;
use yii\web\HttpException;

class ProductController extends AppController {

    public function actionView($id) {

        $product = Product::findOne($id);

        // error
        if (empty($product))
            throw new HttpException(404, 'Такого товара нет');

        //set metatags
        $this->setMetatag($product->name, $product->keywords, $product->description);

        return $this->render('view', compact('product'));
    }

    public function actionDownload($name) {
        $file = Yii::getAlias('@webroot/images/products/certificate/' . $name);

        return Yii::$app->response->sendFile($file);
    }

}
