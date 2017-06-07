<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\ProductCatalog;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class ProductCatalogController extends Controller {

    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductCatalog::find()->with('catalog'),
            'sort' => new \yii\data\Sort([
                'attributes' => [
                    'name',
                    'parent_id',
                    'active',
                    'col',
                ],
                    ]),
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return $this->render('view', ['model' => $this->findModel($id),
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', Yii::t('admin', 'Category {$model->name} updated'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', ['model' => $model,]);
        }
    }

    protected function findModel($id) {
        if (($model = ProductCatalog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
