<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "favorite".
 *
 * @property int $user_id
 * @property int $post_id
 */
class Favorite extends \yii\db\ActiveRecord
{
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
            [['user_id', 'post_id'], 'integer'],
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
        ];
    }
}
