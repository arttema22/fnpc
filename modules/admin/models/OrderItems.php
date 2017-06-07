<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%order_items}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property string $name
 * @property double $price
 * @property integer $qty_item
 * @property double $sum_item
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_items}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'name', 'price', 'qty_item', 'sum_item'], 'required'],
            [['order_id', 'product_id', 'qty_item'], 'integer'],
            [['price', 'sum_item'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

     public function getOrder() {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'order_id' => Yii::t('admin', 'Order ID'),
            'product_id' => Yii::t('admin', 'Product ID'),
            'name' => Yii::t('admin', 'Product name'),
            'price' => Yii::t('admin', 'Product price'),
            'qty_item' => Yii::t('admin', 'Product quantity'),
            'sum_item' => Yii::t('admin', 'Product sum'),
        ];
    }
}
