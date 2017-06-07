<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%article_pharmvestnik}}".
 *
 * @property integer $id
 * @property string $date
 * @property string $title
 * @property string $s_content
 * @property string $url
 * @property integer $catalog_id
 * @property string $status
 * @property string $send
 */
class ArticlePharmvestnik extends \yii\db\ActiveRecord {

    public static function tableName() {
        return '{{%article_pharmvestnik}}';
    }

    public function rules() {
        return [
            [['url'], 'required'],
            [['catalog_id'], 'integer'],
            [['status', 's_content', 'send'], 'string'],
            [['date', 'url', 'title'], 'string', 'max' => 255],
            [['url'], 'unique'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => Yii::t('admin', 'ID'),
            'date' => Yii::t('admin', 'Date publication'),
            'title' => Yii::t('admin', 'Title'),
            's_content' => Yii::t('admin', 'Small content'),
            'url' => Yii::t('admin', 'URL'),
            'catalog_id' => Yii::t('admin', 'Catalog ID'),
            'status' => Yii::t('admin', 'Status'),
            'send' => Yii::t('admin', 'Send article'),
        ];
    }

    public static function find() {
        return new ArticlePharmvestnikQuery(get_called_class());
    }

}
