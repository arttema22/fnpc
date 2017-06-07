<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%partner}}".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $status
 * @property string $name
 * @property string $company
 * @property string $email
 * @property string $phone
 * @property string $message
 */
class Partner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%partner}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['status', 'message'], 'string'],
            [['name', 'email'], 'required'],
            [['name', 'company', 'email', 'phone'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'created_at' => Yii::t('admin', 'Data created'),
            'status' => Yii::t('admin', 'Status'),
            'name' => Yii::t('admin', 'Name'),
            'company' => Yii::t('admin', 'Company'),
            'email' => Yii::t('admin', 'E-mail'),
            'phone' => Yii::t('admin', 'Phone'),
            'message' => Yii::t('admin', 'Message'),
        ];
    }
}
