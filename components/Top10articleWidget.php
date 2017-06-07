<?php

namespace app\components;

use yii\base\Widget;
use app\models\Article;

class Top10articleWidget extends Widget {

    public function run() {

        $articles = Article::find()->orderBy('created_at DESC')->where(['status' => '1'])->limit(10)->asArray()->all();
        
        // error
        if (empty($articles))
            return;

        return $this->render('top10article', compact('articles'));
    }

}
