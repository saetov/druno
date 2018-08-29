<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $parentname
 * @property string $phone
 *
 * @property Orders[] $orders
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'phone'], 'required'],
            [['firstname', 'lastname', 'parentname', 'phone'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'parentname' => 'Отчество',
            'phone' => 'Телефон',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['client' => 'id']);
    }
}
