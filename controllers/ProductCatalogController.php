<?php

namespace app\controllers;

use Yii;
use app\controllers\AppController;
use app\models\ProductCatalog;
use app\models\Product;
use yii\web\HttpException;

class ProductCatalogController extends AppController {

    public function actionView($id) {

        $cat = ProductCatalog::findOne($id);

        $col = $cat['col']; // количество столбцов

        // error
        if (empty($cat)) throw new HttpException(404, 'Такой категории нет');

        //set metatags
        $this->setMetatag($cat->name, $cat->keywords, $cat->description);

        $cat_list = ProductCatalog::find()->asArray()->where(['parent_id' => $id])->all();
        
        $products = Product::find()->asArray()->where(['category_id' => $id])->all();

        return $this->render('view', compact('cat', 'cat_list', 'products', 'col'));
    }

    public function actionSearch() {

        $q = trim(Yii::$app->request->get('q'));

        //set metatags
        $this->setMetatag('Поиск: ', $q);

        if (!$q)
            return $this->render('search', compact('q'));

        $query = Product::find()->where(['like', 'name', $q]);
        $products = $query->all();

        return $this->render('search', compact('products', 'q'));
    }

}
