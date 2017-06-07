<?php

namespace app\controllers;

use app\controllers\AppController;
use app\models\Article;
use yii\web\HttpException;

class ArticleController extends AppController {

    public function actionView($id) {

        $article = Article::findOne($id);

        // error
        if (empty($article)) throw new HttpException(404, 'Такого товара нет');

        //set metatags
        $this->setMetatag($article->title, $article->keywords, $article->description);

        return $this->render('view', compact('article'));
    }

}
