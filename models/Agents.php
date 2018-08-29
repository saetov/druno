<?php

namespace app\models;
use app\models\User;
use Yii;

/**
 * This is the model class for table "agents".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property double $xloc
 * @property double $yloc
 * @property integer $options
 * @property string $phone
 * @property User $user0
 * @property Orders[] $orders
 */
class Agents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $distance;
	 
    public static function tableName()
    {
        return 'agents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['xloc', 'yloc'], 'number'],
			[['type'],'integer'],
            [['name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
			[['o1','o2','o3','o4','o5','o6','o7','o8','o9','o10','o11','o12','distance'],'safe'],
			[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название контрагента',
			'type' => 'Тип',
            'xloc' => 'Широта',
            'yloc' => 'Долгота',
            'options' => 'Услуги',
            'phone' => 'Телефон',
			'distance'=>'Расстояние',
        ];
    }
	/**
     * @return \yii\db\ActiveQuery
     */
	public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
	
	public function afterFind()
	{
		/* if((Yii::$app->request->get('order')) and (Orders::findone(Yii::$app->request->get('order'))->xloc) and (Orders::findone(Yii::$app->request->get('order'))->yloc)){
			$x=Orders::findone(Yii::$app->request->get('order'))->xloc;
			$y=Orders::findone(Yii::$app->request->get('order'))->yloc;
			$this->distance=sqrt(($this->xloc-$x)*($this->xloc-$x)+($this->yloc-$y)*($this->yloc-$y));
		} else {
			$this->distance=NULL;
		} */
	}
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['agents' => 'id']);
    }
	
	//public function getDistance($x,$y)
    //{
    //    return sqrt(($this->xloc-$x)*($this->xloc-$x)+($this->yloc-$y)*($this->yloc-$y));
    //}
}
