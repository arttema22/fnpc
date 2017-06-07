<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%article_catalog}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $s_desc
 * @property string $keywords
 * @property string $description
 * @property string $active
 * @property integer $col
 */
class ArticleCatalog extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%article_catalog}}';
    }

    public function rules()
    {
        return [
            [['parent_id', 'name'], 'required'],
            [['parent_id', 'col'], 'integer'],
            [['active'], 'safe'],
            [['name', 's_desc', 'keywords', 'description'], 'string', 'max' => 255],
        ];
    }

    public function getCategory() {
        return $this->hasOne(ArticleCatalog::className(), ['id' => 'parent_id']);
    }
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'parent_id' => Yii::t('admin', 'Parent ID'),
            'name' => Yii::t('admin', 'Name'),
            's_desc' => Yii::t('admin', 'short description'),
            'keywords' => Yii::t('admin', 'Keywords'),
            'description' => Yii::t('admin', 'Description'),
            'active' => Yii::t('admin', 'Active'),
            'col' => Yii::t('admin', 'Column'),
        ];
    }
}
