<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Agents;
use app\models\Orders;
use app\models\Options;
use app\models\AgentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;

/**
 * AgentsController implements the CRUD actions for Agents model.
 */
class AgentsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Agents models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AgentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$order=Yii::$app->request->get('order') ? : $order=0;
		$opt=Yii::$app->request->get('opt') ? : $opt=0;
        return $this->render('/agents/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'order' => $order,
			'opt' => $opt,
        ]);
    }
	
	public function actionOptions($id){
		
		if(Yii::$app->request->post()){
			if ($model=Agents::findone($id)){
				$model->load(Yii::$app->request->post());
				$model->save();
				return $this->render('check_form',[
					'model'=>$model,
					'items'=>$model->o6,
				]);
			} else {
				throw new HttpException(404,'Не найден контрагент');
			}
		} else {
			if ($model=Agents::findone($id)){
				return $this->render('check_form', [
					'model' => $model,
					'items'=>$model->o6,
				]);
			} else {
				throw new HttpException(404,'Не найден контрагент');
			}
		}
		
	}
	
	public function actionMap()
    {
		$searchModel = new AgentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$agents=$dataProvider->getModels();
		$orders=Orders::findAll([
			'confirm'=>0,
		]);
			
		$map = new Map([
			'center' => new latlng(['lat'=>55.753215,'lng'=>37.622504]),
			'zoom' => 10,
			'width'=>'800',
			'height'=>'800',
		]);
		
		foreach ($orders as $k){
			$marker=new Marker([
				'position'=> new latlng(['lat'=>$k->xloc,'lng'=>$k->yloc]),
				'title'=>'Заказ №'.$k->id,
			]);
			$marker->attachInfoWindow(
			new InfoWindow([
				'content' => 'Заказ №'.$k->id,
			]));
			$map->addOverlay($marker);			
		}
		
		
		$test=$agents;
		foreach ($agents as $k){
			$marker=new Marker([
				'position'=> new latlng(['lat'=>$k->xloc,'lng'=>$k->yloc]),
				'title'=>$k->name,
				'icon'=>'/web/images/vaz_97_64.png',
			]);
			$marker->attachInfoWindow(
			new InfoWindow([
				'content' => $k->name,
			]));
			$map->addOverlay($marker);			
		}
		
		
		
		$order=Yii::$app->request->get('order') ? : $order=0;
		return $this->render('map', [
			'map' => $map,
			'test'=>$test,
        ]);
    }	
	
	public function actionList()
	{
		$searchModel = new AgentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$order=Yii::$app->request->get('order') ? : $order=0;
        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'order' => $order,
        ]);	
	}

    /**
     * Displays a single Agents model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $id==-1 ? -1 : $this->findModel($id),
        ]);
    }

	public function actionProfile()
	{
		$user_id=Yii::$app->user->identity->id;
		$query=(new \yii\db\Query())
			->select('id')
			->from('agents')
			->where('user_id=:user_id',[':user_id'=>$user_id])
			->scalar();
			$id=$query;
		if($query)
		{
			return $this->redirect(['view', 'id' => $id]);
		}else{
			$model = new Agents();
			$model->user_id=$user_id;
			if ($model->load(Yii::$app->request->post()) && $model->save())
			{
				return $this->redirect(['view', 'id' => $user_id]);
			} else {
				return $this->render('create', [
					'model' => $model,
				]);
				
			}			
		} 
	}
    /**
     * Creates a new Agents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Agents();
		$model->user_id=(Yii::$app->user->identity->role>1) ? NULL : Yii::$app->user->identity->role;
		if (Yii::$app->user->identity->role==1){
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->user_id]);
			} else {
				return $this->render('create', [
					'model' => $model,
            ]);				
			}
		} else {
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('create', [
					'model' => $model,
            ]);				
			}
		}
    }

    /**
     * Updates an existing Agents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Agents model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['list']);
    }

    /**
     * Finds the Agents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Agents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Agents::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
