<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $client
 * @property integer $manager
 * @property integer $options
 * @property Double $xloc
 * @property Double $yloc
 * @property string $type
 * @property integer $agents
 * @property double $cost
 * @property integer $confirm
 *
 * @property Clients $client0
 * @property Agents $agents0
 * @property Options $options0
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client'], 'required'],
            [['client', 'manager', 'agents', 'confirm'], 'integer'],
			[['xloc','yloc'],'number'],
            [['cost'], 'number'],
            [['type'], 'string', 'max' => 60],
            [['client'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client' => 'id']],
            [['agents'], 'exist', 'skipOnError' => true, 'targetClass' => Agents::className(), 'targetAttribute' => ['agents' => 'id']],
			[['options'], 'exist', 'skipOnError' => true, 'targetClass' => Options::className(), 'targetAttribute' => ['options' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client' => 'Клиент',
            'manager' => 'Менеджер',
            'options' => 'Проблема',
            'xloc' => 'Широта',
            'yloc' => 'Долгота',
            'type' => 'Тип авто',
            'agents' => 'Конрагент',
            'cost' => 'Стоимость',
            'confirm' => 'Подтверждение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient0()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client']);
    }
	
	 /**
     * @return \yii\db\ActiveQuery
     */
    public function getManager0()
    {
        return $this->hasOne(Managers::className(), ['id' => 'manager']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgents0()
    {
        return $this->hasOne(Agents::className(), ['id' => 'agents']);
    }
	
	/**
    * @return \yii\db\ActiveQuery
    */
	public function getOptions0()
    {
        return $this->hasOne(Options::className(), ['id' => 'options']);
    }
}
