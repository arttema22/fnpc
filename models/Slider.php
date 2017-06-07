<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%slider}}".
 *
 * @property integer $id
 * @property string $active
 * @property string $title
 * @property string $description
 * @property string $img
 * @property string $url
 */
class Slider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%slider}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active', 'description'], 'string'],
            [['title', 'description', 'img', 'url'], 'required'],
            [['title', 'img', 'url'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'active' => Yii::t('admin', 'Active'),
            'title' => Yii::t('admin', 'Title'),
            'description' => Yii::t('admin', 'Description'),
            'img' => Yii::t('admin', 'Image'),
            'url' => Yii::t('admin', 'URL'),
        ];
    }
}
