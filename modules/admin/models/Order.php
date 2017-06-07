<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $qty
 * @property double $sum
 * @property string $status
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 */
class Order extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['created_at', 'updated_at', 'qty', 'sum', 'name', 'email', 'phone', 'address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['qty'], 'integer'],
            [['sum'], 'number'],
            [['status'], 'string'],
            [['name', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    public function getOrderItems() {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('admin', 'ID'),
            'created_at' => Yii::t('admin', 'Date create'),
            'updated_at' => Yii::t('admin', 'Date update'),
            'qty' => Yii::t('admin', 'Quantity'),
            'sum' => Yii::t('admin', 'Sum'),
            'status' => Yii::t('admin', 'Order status'),
            'name' => Yii::t('admin', 'User name'),
            'email' => Yii::t('admin', 'User email'),
            'phone' => Yii::t('admin', 'User phone'),
            'address' => Yii::t('admin', 'User address'),
        ];
    }

}
