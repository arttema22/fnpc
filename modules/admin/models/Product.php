<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\admin\models\ProductCatalog;
use yii\web\UploadedFile;

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
 * @property string $name_en
 * @property string $appointment_en
 * @property string $contraind_en
 * @property string $keywords_en
 * @property string $description_en
 */
class Product extends \yii\db\ActiveRecord {

    public $image; // Изображение
    public $file;
    public $del_cert;

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
            [['appointment', 'contraind', 'appointment_en', 'contraind_en'], 'string'],
            [['price'], 'number'],
            [['size', 'name', 'name_en', 'url', 'quantity', 'keywords', 'description', 'keywords_en', 'description_en'], 'string', 'max' => 255],
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
            'url' => Yii::t('admin', 'URL'),
            'price' => Yii::t('admin', 'Price'),
            'image' => Yii::t('admin', 'Photo'),
            'cert' => Yii::t('admin', 'Certificate'),
            'quantity' => Yii::t('admin', 'Quantity'),
            'keywords' => Yii::t('admin', 'Keywords'),
            'description' => Yii::t('admin', 'Description'),
            'name_en' => 'Name',
            'appointment_en' => 'Appointment',
            'contraind_en' => 'Contra-indications',
            'keywords_en' => 'Keywords',
            'description_en' => 'Description',
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

    public function uploadsert() {
        if ($this->validate()) {
            $path = 'images/products/certificate/' . $this->cert->baseName . '.' . $this->cert->extension;
            $this->cert->saveAs($path); // сохраняем файл с изображением
            return true;
        } else {
            return false;
        }
    }

}
