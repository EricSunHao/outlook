<?php
namespace backend\models;

use Yii;
use yii\helpers\Url;

/**
 * 操作日志记录.
 *
 * @author      Qimi
 * @copyright   Copyright (c) 2017
 * @version     V1.0
 */
class AdminLog
{
    // 日志表名称
    const DB_TABLE_LOG = 'system_log';

    /**
     * 修改操作.
     * @param obj $event
     * @return mixed
     */
    public static function afterUpdate($event)
    {

        if(!empty($event->changedAttributes)) {
            // 内容
            $arr['changedAttributes'] = $event->changedAttributes;
            $arr['oldAttributes'] = [];
            foreach($event->sender as $key => $value) {
                $arr['oldAttributes'][$key] = $value;
            }
            $description = json_encode($arr);

            // IP转换
            $ip = Yii::$app->request->getUserIP();
            $ip = ip2long($ip);

            // 保存
            $data = [ 'route' => Url::to(), 'table' => $event->sender->tableName(), 'class' => $event->sender->className(), 'type' => 2, 'description' => $description, 'user_id' => Yii::$app->user->id, 'create_time' => time(), 'ip' => $ip];
            $model = new \common\models\AdminLog();
            $model->setAttributes($data);
            $model->save(false);
        }
    }

    /**
     * 删除操作.
     * @param obj $event
     * @return mixed
     */
    public static function afterDelete($event)
    {
        // 内容
        $arr = [];
        foreach($event->sender as $key => $value) {
            $arr[$key] = $value;
        }
        $description = json_encode($arr);

        // IP转换
        $ip = Yii::$app->request->getUserIP();
        $ip = ip2long($ip);

        // 保存
        $data = [ 'route' => Url::to(), 'table' => $event->sender->tableName(), 'class' => $event->sender->className(), 'type' => 3, 'description' => $description, 'user_id' =>Yii::$app->user->id, 'create_time' => time(), 'ip' => $ip];
        $model = new \common\models\AdminLog();
        $model->setAttributes($data);
        $model->save(false);
    }

    /**
     * 插入操作.
     * @param obj $event
     * @return mixed
     */
    public static function afterInsert($event)
    {
        if($event->sender->tableName() != self::DB_TABLE_LOG){
            // 内容
            $arr = [];
            foreach($event->sender as $key => $value) {
                $arr[$key] = $value;
            }
            $description = json_encode($arr);

            // IP转换
            $ip = Yii::$app->request->getUserIP();
            $ip = ip2long($ip);

            // 保存
            $data = [ 'route' => Url::to(), 'table' => $event->sender->tableName(), 'class' => $event->sender->className(), 'type' => 1, 'description' => $description, 'user_id' => Yii::$app->user->id, 'create_time' => time(), 'ip' => $ip];
            $model = new \common\models\AdminLog();
            $model->setAttributes($data);
            $model->save(false);
        }
    }

}