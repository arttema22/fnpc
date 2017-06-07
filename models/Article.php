<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use app\models\ArticleCatalog;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $id
 * @property integer $catalog_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 * @property string $title
 * @property string $content
 * @property string $source
 * @property string $keywords
 * @property string $description
 */
class Article extends \yii\db\ActiveRecord {

    public static function tableName() {
        return '{{%article}}';
    }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules() {
        return [
            [['title', 'content'], 'required'],
            [['catalog_id', 'status', 'created_at', 'updated_at'], 'safe'],
            [['content'], 'string'],
            [['title', 'keywords', 'description', 'source'], 'string', 'max' => 255],
        ];
    }

    public function getCatalog() {
        return $this->hasOne(ArticleCatalog::className(), ['id' => 'catalog_id']);
    }

    public function attributeLabels() {
        return [
            'id' => Yii::t('admin', 'ID'),
            'catalog_id' => Yii::t('admin', 'Catalog ID'),
            'created_at' => Yii::t('admin', 'Date create'),
            'updated_at' => Yii::t('admin', 'Date update'),
            'status' => Yii::t('admin', 'Article status'),
            'title' => Yii::t('admin', 'Article title'),
            'content' => Yii::t('admin', 'Article content'),
            'source' => Yii::t('admin', 'Article source'),
            'keywords' => Yii::t('admin', 'Keywords'),
            'description' => Yii::t('admin', 'Description'),
        ];
    }

}
