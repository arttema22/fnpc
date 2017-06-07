<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;

class DefaultController extends Controller {

    public function actionIndex() {

        return $this->render('index');
    }

    public function actionTruncate() {

        Yii::$app->db->createCommand()->truncateTable('fnpc_article')->execute();

        Yii::$app->db->createCommand()->truncateTable('fnpc_article_pharmvestnik')->execute();

        return $this->render('index');
    }

}
