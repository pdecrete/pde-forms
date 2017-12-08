<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FormDigitalSignatureSearch represents the model behind the search form about `app\models\FormDigitalSignature`.
 */
class FormDigitalSignatureSearch extends FormDigitalSignature
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'published', 'employees_sign', 'employees_sign_digital', 'employees_trained', 'procedures_digital', 'created_at', 'updated_at'], 'integer'],
            [['organisation_type', 'organisation', 'period', 'period_in', 'fullname', 'email', 'phone', 'substitute_fullname', 'substitute_email', 'substitute_phone', 'training_action', 'training_action_other', 'procedures_titles'], 'safe'],
            [['period_in'], 'date', 'format' => 'php:m-Y'],
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
        $query = FormDigitalSignature::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['period' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (!empty($this->period_in)) {
            $this->period = date('Y-m-d', strtotime("01-{$this->period_in}"));
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'period' => $this->period,
            'published' => $this->published,
            'employees_sign' => $this->employees_sign,
            'employees_sign_digital' => $this->employees_sign_digital,
            'employees_trained' => $this->employees_trained,
            'procedures_digital' => $this->procedures_digital,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'organisation_type', $this->organisation_type])
            ->andFilterWhere(['like', 'organisation', $this->organisation])
            ->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'substitute_fullname', $this->substitute_fullname])
            ->andFilterWhere(['like', 'substitute_email', $this->substitute_email])
            ->andFilterWhere(['like', 'substitute_phone', $this->substitute_phone])
            ->andFilterWhere(['like', 'training_action', $this->training_action])
            ->andFilterWhere(['like', 'training_action_other', $this->training_action_other])
            ->andFilterWhere(['like', 'procedures_titles', $this->procedures_titles]);

        return $dataProvider;
    }
}
