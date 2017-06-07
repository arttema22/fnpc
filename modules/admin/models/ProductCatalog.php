<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $s_desc short description
 * @property string $keywords
 * @property string $description
 * @property string $active
 * @property string $col
 */
class ProductCatalog extends \yii\db\ActiveRecord {

    public $image;

    public function behaviors() {
        return [
//            'image' => [
//                'class' => 'rico\yii2images\behaviors\ImageBehave',
//            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%product_catalog}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['parent_id', 'col'], 'integer'],
            [['name'], 'required'],
            [['name', 's_desc', 'keywords', 'description', 'active', 'col'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function getCatalog() {
        return $this->hasOne(ProductCatalog::className(), ['id' => 'parent_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('admin', 'ID'),
            'parent_id' => Yii::t('admin', 'Parent ID'),
            'name' => Yii::t('admin', 'Name'),
            's_desc' => Yii::t('admin', 'Short description'),
            'image' => Yii::t('admin', 'Photo'),
            'keywords' => Yii::t('admin', 'Keywords'),
            'description' => Yii::t('admin', 'Description'),
            'active' => Yii::t('admin', 'Active'),
            'col' => Yii::t('admin', 'Columns'),
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $path = 'images/products/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path); // сохраняем файл с изображением
            $this->attachImage($path, true); // сохраняем путь к файлу в БД
            @unlink($path); // Удаляем файл оригинала         
            return true;
        } else {
            return false;
        }
    }

}
