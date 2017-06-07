<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Partner;

class PartnerFormWidget extends Widget {

    public function run() {

        $model = new Partner();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', Yii::t('app', "Article added"));
            return;
        } else {
            return $this->render('partnerform', ['model' => $model,]);
        }
    }

}
