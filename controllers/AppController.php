<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class AppController extends Controller {

    protected function setMetatag($title = null, $keywords = null, $description = null) {

//        $this->view->title = Yii::$app->params['siteName'] . ' ' . $title;
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }

}
