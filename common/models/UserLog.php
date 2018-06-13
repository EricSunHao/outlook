<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_log".
 *
 * @property int $id
 * @property string $route 路由
 * @property int $create_time 操作时间
 * @property int $user_id 用户ID
 * @property int $ip 操作人ip
 */
class UserLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time', 'user_id', 'ip'], 'integer'],
            [['route'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'route' => 'Route',
            'create_time' => 'Create Time',
            'user_id' => 'User ID',
            'ip' => 'Ip',
        ];
    }
}
