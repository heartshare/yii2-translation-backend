<?php
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


Modal::begin([
    'header' => '<h2>Update translation</h2>',
	'id' => 'modal',
]);

echo 
	"<div id='modalContent'>
		".Html::textInput('translation', null, ['id' => 'translationText', 'class'=>"form-control"])."
	</div><p></p>";
	

	echo Html::hiddenInput('messageId', null, ['id' => 'messageId']);
	echo Html::hiddenInput('messageLanguage', null, ['id' => 'messageLanguage']);
	
	echo Button::widget([
		'label' => 'Update',
		'options' =>  [
			'onclick'=>"
				var messageId = $('#messageId').val();
				var messageLanguage = $('#messageLanguage').val();
				var message = $('#translationText').val();
				$.ajax({
					type     :'POST',
					cache    : false,
					data	: {id : messageId, language: messageLanguage, message: message},
					url  : '".\Yii::$app->urlManager->createAbsoluteUrl(['TranslationBackend/default/update-message'])."',
					success  : function(response) {
						$('#modal').modal('hide');
						$.pjax.reload({container:'#translationGrid'});
					},
					error : function(jqXHR, textStatus, errorThrown){
						alert('Error on saving the translation');
					}
				});return false;",	
		]
	]);

Modal::end();

