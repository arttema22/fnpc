<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Article;
use app\modules\admin\models\ArticleQuery;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use GuzzleHttp\Client;
use app\modules\admin\models\ContactForm;

class ArticleController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find(),
            'sort' => new \yii\data\Sort([
                'attributes' => [
                    'title',
                    'status',
                    'created_at',
                ],
                    ]),
        ]);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate() {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // загрузка изображения
//            $model->image = UploadedFile::getInstance($model, 'image');
//            if ($model->image) {
//                $model->upload();
//            }

            Yii::$app->session->setFlash('success', Yii::t('admin', "Article {$model->title} added"));
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // загрузка изображения
//            $model->image = UploadedFile::getInstance($model, 'image');
//            if ($model->image) {
//                $model->upload();
//            }

            Yii::$app->session->setFlash('success', Yii::t('admin', "Article {$model->title} updated"));
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
