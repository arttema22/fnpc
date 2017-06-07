<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class ProductController extends Controller {

    /**
     * @inheritdoc
     */
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

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider,]);
    }

    public function actionView($id) {
        return $this->render('view', ['model' => $this->findModel($id),]);
    }

    public function actionCreate() {
        $model = new Product();
        if ($model->load(Yii::$app->request->post())) {
            // загрузка изображения
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->image) {
                $model->upload();
            }
            // загрузка сертификата
            $model->cert = UploadedFile::getInstance($model, 'cert');
            if ($model->cert) {
                $model->uploadsert();
            }
            $model->cert = $model->cert->baseName . '.' . $model->cert->extension;
        }
        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('admin', "Product {$model->name} added"));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', ['model' => $model,]);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            // загрузка изображения
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->image) {
                $model->upload();
            }
            // загрузка сертификата
            $model->cert = UploadedFile::getInstance($model, 'cert');
            if ($model->cert) {
                $model->uploadsert();
            }
            $model->cert = $model->cert->baseName . '.' . $model->cert->extension;
        }
        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('admin', "Product {$model->name} updated"));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', ['model' => $model,]);
        }
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
