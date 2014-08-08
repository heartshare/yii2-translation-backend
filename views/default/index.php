<?php
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('irip', 'Translation');
$this->params['breadcrumbs'][] = $this->title;

\yii\widgets\Pjax::begin(); 

echo GridView::widget([
	'id' => 'translationGrid',
    'dataProvider' => $sourceMessageDataProvider,
	'columns' => Yii::$app->controller->module->columns,
    'filterModel' => $sourceMessageSearchModel,
]);

\yii\widgets\Pjax::end();
?>
<?= $this->render('_modal_update_translation', [
]) ?>
