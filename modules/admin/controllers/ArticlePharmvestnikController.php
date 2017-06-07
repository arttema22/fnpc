<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\ArticlePharmvestnik;
use app\modules\admin\models\Article;
use yii\web\Controller;
use GuzzleHttp\Client;
use yii\base\Model;

class ArticlePharmvestnikController extends Controller {

    public $news;

    public function actionIndex() {
        $settings = ArticlePharmvestnik::find()->indexBy('id')->all();

        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->save(false);
            }
            Yii::$app->session->setFlash('success', Yii::t('admin', 'Selected articles saved'));
            return $this->redirect('index');
        }

        //Yii::$app->session->setFlash('success', Yii::t('admin', "Not found new or checked article"));
        return $this->render('index', ['settings' => $settings]);
    }

    public function actionParser() {
        // создаем экземпляр класса
        $client = new Client();
        // отправляем запрос к странице
        $res = $client->request('GET', 'http://www.pharmvestnik.ru/publs/lenta/');
        // получаем данные между открывающим и закрывающим тегами body
        $body = $res->getBody();
        // подключаем phpQuery
        $document = \phpQuery::newDocumentHTML($body);
        //Смотрим html страницы, определяем внешний класс списка и считываем его командой find
        $news = $document->find(".b-indexItem");
        // выполняем проход циклом по списку
        foreach ($news as $elem) {

            $model = new ArticlePharmvestnik();

            //pq аналог $ в jQuery
            $pq = pq($elem);

            // считываем дату статьи
            $model->date = $pq->find(".idexItemDateTime")->text();

            // считываем заголовок статьи
            $model->title = trim($pq->find(".indexItemTitle")->text());

            // считываем краткое описание  статьи
            $model->s_content = $pq->find(".indexItemText")->text();

            // считываем ссылку на статью
            $url = $pq->find('a')->attr('href');
            $model->url = 'http://www.pharmvestnik.ru' . $url;

            $model->save();
        }
        Yii::$app->session->setFlash('success', Yii::t('admin', "Article list refreshed"));
        return $this->redirect(['index']);
    }

    public function actionSend() {

        $settings = ArticlePharmvestnik::find()->indexBy('id')->all();

        foreach ($settings as $setting) {
            if ($setting['status'] & !$setting['send']) {
                $setting['send'] = 1;
                $setting->save(false);

                $model = new Article();
                if ($setting['catalog_id']) {
                $model->catalog_id = $setting['catalog_id'];
            } else {
                $model->catalog_id = 1;
            }
            $model->status = 0;
            $model->title = $setting['title'];
            $this->news = $this->parser_article($setting['url']);
            $model->content = $this->news;
            $model->source = $setting['url'];
            $model->save();
        }
        }

        Yii::$app->session->setFlash('success', Yii::t('admin', "Article list refreshed"));
        return $this->redirect(['index']);
    }

    protected function parser_article($url) {
        // создаем экземпляр класса
        $client = new Client();
        // отправляем запрос к странице
        $res = $client->request('GET', $url);
        // получаем данные между открывающим и закрывающим тегами body
        $body = $res->getBody();
        // подключаем phpQuery
        $document = \phpQuery::newDocumentHTML($body);
        //Смотрим html страницы, определяем внешний класс списка и считываем его командой find
        $news = trim($document->find(".text"));
        return $news;
    }

}
