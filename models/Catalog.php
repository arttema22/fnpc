<?php

namespace app\models;

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
class Catalog extends \yii\db\ActiveRecord {

    public static function tableName() {
        return '{{%article_catalog}}';
    }

    public function rules() {
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

    public function attributeLabels() {
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

    public static function getMainMenuItems() {

        $category = self::find()->orderBy('id')->where(['active' => '1'])->all();

        $items = [];
        array_push($items, ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index'], 'params' => []]);
        array_push($items, ['label' => Yii::t('app', 'About'), 'url' => ['/site/about'], 'params' => []]);

        foreach ($category as $var) {
//            if ($var->parent_id == 0) {
//                array_push($items, [
//                    'label' => $var->name,
//                    'url' => ['/catalog/parent', 'id' => $var->id]
//                ]);
//            }

            if ($var->parent_id == null) {
                array_push($items, [
                    'label' => $var->name,
                    'url' => [$var->url, 'id' => $var->id],
                    'items' => self::getMenuChildrenItems($category, $var->id)
                ]);
            }
        }

//        array_push($items, ['label' => 'Цены', 'url' => ['/calc/index'], 'params' => [],
//            'items' => [
//                ['label' => 'Визитки', 'url' => ['/calc/bcard'],],
//                ['label' => 'Листовки', 'url' => ['/calc/flysheet'],],
//                ['label' => 'Шелкография', 'url' => ['/calc/silkscreen'],],
//                ['label' => 'Пластиковые карты', 'url' => ['/calc/plastic-card'],],
//            ]
//        ]);

        return $items;
    }

    public static function getMenuItems() {

        $category = self::find()->orderBy('id')->where(['active' => '1'])->all();

        $items = [];
        array_push($items, ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index'], 'params' => []]);
        array_push($items, ['label' => Yii::t('app', 'About'), 'url' => ['/site/about'], 'params' => []]);

        foreach ($category as $var) {
            if ($var->parent_id == 0) {
                array_push($items, [
                    'label' => $var->name,
                    'url' => [$var->url, 'id' => $var->id]
                ]);
            }
        }
        return $items;
    }

    private static function getMenuChildrenItems($category, $id) {
        $items = [];
        foreach ($category as $var) {
            if ($var->parent_id == $id) {
                array_push($items, [
                    'label' => $var->name,
                    'url' => [$var->url, 'id' => $var->id],
                    'items' => self::getMenuChildrenItems($category, $var->id)
                ]);
            }
        }
        return $items;
    }

}
