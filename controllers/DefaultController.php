<?php

namespace backend\modules\TranslationBackend\controllers;

use Yii;
use yii\web\Controller;
use backend\modules\TranslationBackend\models\filters\SourceMessageSearch;
use backend\modules\TranslationBackend\models\Message;

class DefaultController extends Controller
{
    public function actionIndex()
    {
		$sourceMessageSearchModel = new SourceMessageSearch();
		$sourceMessageDataProvider = $sourceMessageSearchModel->search(Yii::$app->request->getQueryParams());
		
        return $this->render('index',[
			'sourceMessageDataProvider' => $sourceMessageDataProvider,
			'sourceMessageSearchModel' => $sourceMessageSearchModel,
		]);
    }
	
	public function actionUpdateMessage() {
		if(!isset($_POST['id']) || !isset($_POST['language']))
			throw new Exception('Message not found');
		
		$message = Message::findOne(['id' => $_POST['id'], 'language' => $_POST['language']]);
		

		if(empty($message)){
			$message = new Message;
			$message->id = $_POST['id'];
			$message->language = $_POST['language'];
		}
		
		if(isset($_POST['message'])){
			$message->translation = $_POST['message'];
			if (!$message->save(false)) {
				throw new Exception('Message not saved');
			}
		}
		
	}
}
