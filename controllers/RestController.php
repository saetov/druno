<?php
namespace app\controllers;
use Yii;
use yii\rest\ActiveController;
use app\models\Orders;
use app\models\Agents;
use yii\data\ActiveDataProvider;
class RestController extends ActiveController {
 
  public $modelClass = 'app\models\Orders';
  
  public function behaviors(){
    $behaviors = parent::behaviors();
    $behaviors['authenticator']['class'] = \yii\filters\auth\HttpBasicAuth::className();
		$behaviors['authenticator']['auth'] = function ($email, $password) {
	  	$user= \app\models\User::findByEmail($email);
			if(Yii::$app->security->validatePassword($password, $user->password_hash)){
				return $user;
			}
		};
    //$behaviors['authenticator']['only'] = ['update'];
    return $behaviors;
  }
  
  public function actionList($id){
    $orders=Orders::find()->where(['agents'=>$id])->all();
    foreach($orders as $k){
      $k->options=$k->options0->title;
    }
    return $orders;
  }
  
  public function actionGetid(){
    $user_id=\Yii::$app->user->identity->id;
	$agents_id=Agents::find('id')->where(['user_id'=>$user_id])->one();
    return $agents_id;
  }

}
?>