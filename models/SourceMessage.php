<?php

namespace  backend\modules\TranslationBackend\models;

use Yii;

/**
 * This is the model class for table "source_message".
 *
 * @property integer $id
 * @property string $category
 * @property string $message
 *
 * @property Message $message
 */
class SourceMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'source_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['category'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model_sourceMessage', 'ID'),
            'category' => Yii::t('model_sourceMessage', 'Category'),
            'message' => Yii::t('model_sourceMessage', 'Message'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(Message::className(), ['id' => 'id']);
    }
}
