<?php

namespace app\controllers;

use Yii;
use app\models\Orders;
use app\models\OrdersSearch;
use app\models\Clients;
use app\models\User;
use yii\web\Controller;
//use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    /**
     * @inheritdoc
     */
	public $modelClass = 'app\models\Orders';
    public function behaviors()
    {
        return [
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'actions'=>['index','error','login'],
						'roles' => ['worker'],
					],
					[
						'allow' => true,
						'roles' => ['admin','manager'],
					],
				],
			],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
		if (Yii::$app->user->identity->role>1){
			$searchModel = new OrdersSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}else{
			$searchModel = new OrdersSearch();

			if(User::getProfile()){
				$query=Orders::find()
					->where(['agents'=> User::getProfile()->id ]);
				$dataProvider = new ActiveDataProvider([
				  'query' => $query
				]);
				return $this ->render('index',[
					'searchModel'=>$searchModel,
					'dataProvider'=>$dataProvider,
				]);
			} else {
				return $this->redirect(['//agents/profile']);
			}
		}
    }
	public function actionJson()
	{
		$model = Orders::find()->select(['options'])->asArray()->all();
		return json_encode($model);

	}

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();
		$client=Yii::$app->request->get('client');
		$cl=Clients::findOne($client);
        if ($model->load(Yii::$app->request->post()) && $model->save())  {
            //return $this->redirect(['view', 'id' => $model->id]);
			return $this->redirect(['/agents/index/','order'=>$model->id,'opt'=>$model->options]);
        } else {
			$model->client=$client;
            return $this->render('create', [
				'cl' => $cl->firstname.' '.$cl->lastname,
				'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		if(Yii::$app->request->get('agents')){
			$model->agents=Yii::$app->request->get('agents');
			if($model->save()){
				return $this->redirect(['view','id'=>$model->id]);
			}
		}
		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
