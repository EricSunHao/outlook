<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "system_log".
 *
 * @property int $id
 * @property int $type 操作类型：1添加，2修改，3删除
 * @property string $class 操作class
 * @property string $route 路由
 * @property string $table 操作表
 * @property string $description 操作信息
 * @property int $create_time 操作时间
 * @property int $user_id 用户ID
 * @property int $ip 操作人ip
 */
class AdminLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'create_time', 'user_id', 'ip'], 'integer'],
            [['description'], 'string'],
            [['class', 'route'], 'string', 'max' => 255],
            [['table'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'class' => 'Class',
            'route' => 'Route',
            'table' => 'Table',
            'description' => 'Description',
            'create_time' => 'Create Time',
            'user_id' => 'User ID',
            'ip' => 'Ip',
        ];
    }
}
