<?php

/**
 * @link https://github.com/pjacquemin
 * @author Patrick Jacquemin
 */

/**
 *
 * @author patrick
 */
namespace backend\modules\TranslationBackend\models\filters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\TranslationBackend\models\SourceMessage;


class SourceMessageSearch extends SourceMessage{
	
	
	public function rules()
    {
		return [
            [['id'], 'integer'],
            [['category', 'message'], 'safe'],
        ];
	}
	
	public function scenarios()
    {
        return Model::scenarios();
    }
	
	public function search($params)
    {
        $query = SourceMessage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'category', $this->category])
              ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
