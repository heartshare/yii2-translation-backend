<?php
/**
 * @link https://github.com/pjacquemin
 * @author Patrick Jacquemin
 */

/**
 * Module for editing translation in backend
 *
 * @author patrick
 */
namespace backend\modules\TranslationBackend;

use Yii;
use backend\modules\TranslationBackend\models\Message;
use yii\helpers\Html;

class TranslationBackend extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\TranslationBackend\controllers';
	public $languages, $columns;

    public function init()
    {
        parent::init();
		
		if(!isset($this->languages)){
			if(isset(Yii::$app->params['languages'])){
				$this->languages = Yii::$app->params['languages'];
			}else{
				$this->languages = array();
			}
		}
		
		$this->_createGridColumns();
    }
	
	protected function _createGridColumns() {
		$this->columns[] = 'category';
		$this->columns[] = 'message';
		
		foreach($this->languages as $language){
			$this->columns[] = [
				'label' => $language,
				'content' => function ($model, $key, $index, $gridView){
					$query = Message::findOne(['id' => $key, 'language' => $gridView->label]);
					return empty($query->translation)?'(Not set)':Html::a($query->translation);
				},
				'contentOptions' => function ($model, $key, $index, $gridView){
					$query = Message::findOne(['id' => $model->id, 'language' => $gridView->label]);
					$value = empty($query->translation)?'':$query->translation;
					return [
						'id' => $gridView->label.$model->id,
						'onClick' =>"$('#modal').modal('show');
							($('#messageId').val('".$key."'));
							($('#messageLanguage').val('".$gridView->label."'));
							($('#translationText').val('".$value."'));"
					];
				}
			];
		}

		$this->_createGridActionsColumns();
	}

	protected function _createGridActionsColumns() {
		$this->columns[] = [
			'class' => 'yii\grid\ActionColumn',
			'header' => 'Actions',
			'buttons' => [
				'reset' => function($url, $model) {
					return Html::a(
							'<span class="glyphicon glyphicon-repeat"></span>', '', [
							'onClick' => "
									if (confirm('Are you sure you want to reset this?')) {
										$.ajax({
											cache    : false,
											url  : '" . $url . "',
											success  : function(response) {
												$.pjax.reload({container:'#translationGrid'});
											},
										});
									}
								",
							'title' => Yii::t('translation_backend', 'Reset')
						]
					);
				}
			],
			'template' => '{delete} {reset}'
		];
	}
}
