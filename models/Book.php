<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $user_id
 * @property string $isbn
 *
 * @property User $user
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'], 
            [['user_id'], 'integer'],
            [['time_new'], 'integer'],
            [['title'], 'string', 'max' => 64],
            [['description'], 'string'],
            [['isbn'], 'string', 'max' => 32],
            [['img'], 'file'],
            [['user_id'], 'exist', 'targetClass'=>'\app\models\User', 'targetAttribute'=>'id', 'message'=>Yii::t('app','This user doesn\'t exist')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'user_id' => Yii::t('app', 'User'),
            'isbn' => Yii::t('app', 'Isbn'),
            'time_new' => Yii::t('app', 'Thời gian cập nhật'),
            'img' => Yii::t('app', 'Ảnh minh họa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
