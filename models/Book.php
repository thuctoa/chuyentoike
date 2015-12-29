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
            [['body'], 'string'],
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
            'title' => Yii::t('app', 'Tìm kiếm bài viết'),
            'description' => Yii::t('app', 'Tóm tắt'),
            'body' => Yii::t('app', 'Nội dung'),
            'user_id' => Yii::t('app', 'Người dùng'),
            'isbn' => Yii::t('app', 'Loại'),
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
    public function getimageurl()
    {
       // return your image url here
       return \Yii::$app->request->BaseUrl.'/uploads/'.$this->img;
    }
    public function getlinkurl()
    {
        //thuc hien chon bai viet hien thi
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $query=[];
        $parts = parse_url($actual_link);
        if(isset($parts['query'])){
            parse_str($parts['query'], $query);
        }
        $query['baiviet']=  $this->id;//gan lai link bai viet
        //lay lai duong dan khong co request
        $vitricat=  strpos($actual_link, "?");
        while ($vitricat){
            $actual_link=substr($actual_link, 0, -1);
            $vitricat=  strpos($actual_link, "?");
        }
        $actual_link=$actual_link."?";
        foreach ($query as $key=>$val){
            if(!is_array($val)){
                $actual_link=$actual_link.$key."=".$val."&";
            }else{
                foreach ($val as $k=>$v){
                    $actual_link=$actual_link.$key."%5B".$k."%5D=".$v."&";
                }
                
            }
        }
        //xoa ky tu & cuoi chuoi
        $actual_link=substr($actual_link, 0, -1);
        // return your image url here
        return $actual_link;
    }
}
