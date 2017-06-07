<?php

namespace app\models;

use Yii;
use app\models\ProductCatalog;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $size
 * @property string $appointment
 * @property string $contraind
 * @property string $cert
 * @property string $url
 * @property string $price
 * @property string $quantity
 * @property string $keywords
 * @property string $description
 */
class Product extends \yii\db\ActiveRecord {

    public $image;

    public function behaviors() {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['category_id', 'name'], 'required'],
            [['category_id'], 'integer'],
            [['appointment', 'contraind'], 'string'],
            [['price'], 'number'],
            [['size', 'name', 'url', 'quantity', 'keywords', 'description'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg'],
            [['cert'], 'file', 'extensions' => 'pdf'],
        ];
    }

    public function getCategory() {
        return $this->hasOne(ProductCatalog::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('admin', 'ID'),
            'category_id' => Yii::t('admin', 'Category ID'),
            'name' => Yii::t('admin', 'Name'),
            'size' => Yii::t('admin', 'Size'),
            'appointment' => Yii::t('admin', 'Appointment'),
            'contraind' => Yii::t('admin', 'Contra-indications'),
            'cert' => Yii::t('admin', 'Certificate'),
            'url' => Yii::t('admin', 'URL'),
            'price' => Yii::t('admin', 'Price'),
            'image' => Yii::t('admin', 'Photo'),
            'quantity' => Yii::t('admin', 'Quantity'),
            'keywords' => Yii::t('admin', 'Keywords'),
            'description' => Yii::t('admin', 'Description'),
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
