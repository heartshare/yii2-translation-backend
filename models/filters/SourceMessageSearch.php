<?php

/**
 * @link https://github.com/pjacquemin
 * @author Patrick Jacquemin
 */

/**
<<<<<<< HEAD
 * Model used to filtering the translation gridview
=======
>>>>>>> 40cccd3923d5a87e20f307c28c25a67fde260721
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
