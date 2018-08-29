<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "managers".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 *
 * @property Orders[] $orders
 */
class Managers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'managers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname'], 'required'],
            [['firstname', 'lastname'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Фамилия',
            'lastname' => 'Имя',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['manager' => 'id']);
    }
}
