<?php

namespace app\models;

use Yii;
use yii\base\Object;
use yii\helpers\ArrayHelper;
use paulzi\adjacencyList\AdjacencyListBehavior;

/**
 * This is the model class for table "options".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property int $sort
 * @property Orders[] $orders
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'options';
    }
	
	public function behaviors() {
        return [
			[
                'class' => AdjacencyListBehavior::className(),
            ],
        ];
    }
	
	public static function find(){
        return new OptionsQuery(get_called_class());
    }
	
	public static function getRootsList(){
		//return self::find()->roots()->with('children.children.children')->all();
		return self::find()->roots()->all();
	}
	
	public static function getDropDown(){
		$list=[];
		$separator='----';
		foreach(self::getRootsList() as $root){
			$list[$root->id]=$root->title;
			if($root->children){
				foreach($root->children as $one){
					$list[$one->id]=$separator.$one->title;
					if(isset($one->children)){
						foreach($one->children as $two){
							$list[$two->id]=$separator.$separator.$two->title;
						}
					}
				}
			}
		}
		return $list;
	}


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
			[['sort'], 'number'],
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Pid',
            'title' => 'Title',
            'level' => 'Level',
        ];
    }
	
	public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['options' => 'id']);
    }
}

