<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Agents;

/**
 * AgentsSearch represents the model behind the search form about `app\models\Agents`.
 */
class AgentsSearch extends Agents
{
    /**
     * @inheritdoc
     */
	
	
    public function rules()
    {
        return [
            [['id', 'type', 'options'], 'integer'],
            [['name', 'last_time', 'phone', 'distance'], 'safe'],
            [['xloc', 'yloc'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
	 

    public function search($params)
    {
		
        $query = Agents::find();
		
        // add conditions that should always apply here
		if((Yii::$app->request->get('order')) and (Orders::findone(Yii::$app->request->get('order'))->xloc) and (Orders::findone(Yii::$app->request->get('order'))->yloc)){
			$x=Orders::findone(Yii::$app->request->get('order'))->xloc;
			$y=Orders::findone(Yii::$app->request->get('order'))->yloc;
			$query->addselect(["*","sqrt((`xloc`-:x)*(`xloc`-:x)+(`yloc`-:y)*(`yloc`-:y)) as  distance"]);
			$query->addParams([':x'=>$x, ':y'=>$y]);
		} 
		$opt=Yii::$app->request->get('opt');
		$z=($opt>=1 and $opt<=12) ? "o{$opt}" : 1;
		$query->where("$z=1");
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		$dataProvider->setSort([
			'attributes' => [
				
				'distance' => [
					'label' => 'Distance',
					'default' => SORT_ASC
				],
			]
		]);
		
		
        $this->load($params);
		

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
		
	
        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'xloc' => $this->xloc,
            'yloc' => $this->yloc,
            'last_time' => $this->last_time,
            'options' => $this->options,
			'distance'=>$this->distance,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone]);
        return $dataProvider;
    }
}
