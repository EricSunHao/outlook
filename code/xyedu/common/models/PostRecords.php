<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_records".
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property int $post_id 文章ID
 * @property int $create_time 操作时间
 */
class PostRecords extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_records';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'post_id', 'create_time'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'post_id' => 'Post ID',
            'create_time' => 'Create Time',
        ];
    }

    public function addRecord($post_id = 0)
    {
        $uid = Yii::$app->user->id;
        $uid = empty($uid)?0:$uid;
        $this->user_id=$uid;
        $this->post_id=$post_id;
        $this->create_time=time();
        $this->save();
    }
}
