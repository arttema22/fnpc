<?php

namespace app\components;

use yii\base\Widget;
use app\models\ArticleCatalog;
use app\models\Article;

class Top5articleFromCatWidget extends Widget {

    public function run() {
        // ->where("user_id IN(1,5,8) AND (status = 1 OR verified = 1) OR (social_account = 1 AND enable_social = 1)")
        // статьи в разделе Пациентам
        $articles6 = Article::find()
                        ->where(['status' => '1', 'catalog_id' => '6'])
                        ->orWhere(['status' => '1', 'catalog_id' => '7'])
                        ->orWhere(['status' => '1', 'catalog_id' => '8'])
                        ->orWhere(['status' => '1', 'catalog_id' => '9'])
                        ->orderBy('created_at DESC')
                        ->limit(5)->asArray()->all();

        // статьи в разделе Специалистам
        $articles2 = Article::find()
                        ->where(['status' => '1', 'catalog_id' => '2'])
                        ->orWhere(['status' => '1', 'catalog_id' => '3'])
                        ->orWhere(['status' => '1', 'catalog_id' => '4'])
                        ->orWhere(['status' => '1', 'catalog_id' => '5'])
                        ->orderBy('created_at DESC')
                        ->limit(5)->asArray()->all();

        // статьи в разделе Исследования
        $articles10 = Article::find()
                        ->where(['status' => '1', 'catalog_id' => '10'])
                        ->orWhere(['status' => '1', 'catalog_id' => '11'])
                        ->orWhere(['status' => '1', 'catalog_id' => '12'])
                        ->orWhere(['status' => '1', 'catalog_id' => '13'])
                        ->orWhere(['status' => '1', 'catalog_id' => '14'])
                        ->orderBy('created_at DESC')
                        ->limit(5)->asArray()->all();

        // error
        if (empty($articles6) & empty($articles2) & empty($articles10))
            return;

        return $this->render('top5article', compact('articles6', 'articles2', 'articles10'));
    }

}
