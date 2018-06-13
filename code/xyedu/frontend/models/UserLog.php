<?php
namespace frontend\models;

use Yii;
use yii\helpers\Url;

/**
 * 用户日志记录.
 *
 * @author      Qimi
 * @copyright   Copyright (c) 2017
 * @version     V1.0
 */
class UserLog
{
    // 日志表名称
    const DB_TABLE_LOG = 'user_log';

    /**
     * 修改操作.
     * @param obj $event
     * @return mixed
     */
    public static function beforeAction($event)
    {
        // IP转换
        $ip = Yii::$app->request->getUserIP();
        $ip = ip2long($ip);

        // 保存
        $data = [ 'route' => Url::to(), 'user_id' => Yii::$app->user->id, 'create_time' => time(), 'ip' => $ip];
        $model = new \common\models\UserLog();
        $model->setAttributes($data);
        $model->save(false);
    }
}

