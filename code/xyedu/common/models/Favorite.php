<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "favorite".
 *
 * @property int $user_id
 * @property int $post_id
 * @property int $add_time
 * @property int $type
 */
class Favorite extends \yii\db\ActiveRecord
{
    const TYPE_LAUD=1;
    const TYPE_FAVORITE=2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'post_id', 'add_time', 'type'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => '用户ID',
            'post_id' => '文章ID',
            'add_time' => '添加时间',
            'type' => '类型',
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->add_time = time();
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    public function favoritePost()
    {
        $uid = Yii::$app->user->id;
        $type = Favorite::TYPE_FAVORITE;
        $query = Favorite::find()->where("type={$type} and user_id={$uid}");
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>5],
            'sort'=>[
                'defaultOrder'=>[
                    'add_time'=>SORT_DESC,
                ],
            ]
        ]);
        return $dataProvider;
    }
}
