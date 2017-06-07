<?php

namespace app\controllers;

use Yii;
use app\controllers\AppController;
use app\models\Catalog;
use app\models\Article;
use app\models\Product;
use yii\web\HttpException;

class CatalogController extends AppController {

    public function actionParent($id) {

        $cat = Catalog::findOne($id);

        // error
        if (empty($cat))
            throw new HttpException(404, 'Такой категории нет');

        //set metatags
        $this->setMetatag($cat->name, $cat->keywords, $cat->description);

        $cat_list = Catalog::find()->asArray()->where(['parent_id' => $id])->all();

        $articles = Article::find()->asArray()->where(['catalog_id' => $id])->all();

        return $this->render('parent', compact('cat', 'cat_list', 'articles'));
    }

    public function actionView($id) {

        $cat = Catalog::findOne($id);
        // error
        if (empty($cat))
            throw new HttpException(404, 'Такой категории нет');

        //set metatags
        $this->setMetatag($cat->name, $cat->keywords, $cat->description);

        $parent_cat = Catalog::findOne($cat['parent_id']);

        $sister_cat = Catalog::find()->asArray()
                ->where('parent_id='.$parent_cat['id'].' AND id<>'.$cat['id'])->all();

        $articles = Article::find()->asArray()->where(['catalog_id' => $id])->all();

        return $this->render('view', compact('cat', 'sister_cat', 'parent_cat', 'articles'));
    }

        public function actionProduct($id) {

        $cat = Catalog::findOne($id);
        // error
        if (empty($cat))
            throw new HttpException(404, 'Такой категории нет');

        //set metatags
        $this->setMetatag($cat->name, $cat->keywords, $cat->description);

        $products = Product::find()->all();

        return $this->render('product', compact('cat', 'products'));
        
        //return $this->render('view', compact('cat', 'sister_cat', 'parent_cat', 'articles'));
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
