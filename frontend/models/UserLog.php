<?php
namespace frontend\models;

use Yii;
use yii\helpers\Url;
use common\models\User;

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
        //强制注册用户
        if (Yii::$app->user->isGuest){
            $mark = self::getPhoneType().uniqid();
            User::autoSignUp($mark);
        }

        // IP转换
        $ip = Yii::$app->request->getUserIP();
        $ip = ip2long($ip);

        // 保存
        $data = [ 'route' => Url::to(), 'user_id' => Yii::$app->user->id, 'create_time' => time(), 'ip' => $ip];
        $model = new \common\models\UserLog();
        $model->setAttributes($data);
        $model->save(false);


    }

    /**
     * 函数名称: getUA
     * 函数功能: 取UA
     * 输入参数: none
     * 函数返回值: 成功返回号码，失败返回false
     * 其它说明: 说明
     */
    static public function getUA(){
        if (isset($_SERVER['HTTP_USER_AGENT'])){
            Return $_SERVER['HTTP_USER_AGENT'];
        }else{
            Return false;
        }
    }
    /**
     * 函数名称: getPhoneType
     * 函数功能: 取得手机类型
     * 输入参数: none
     * 函数返回值: 成功返回string，失败返回false
     * 其它说明: 说明
     */
    static public function getPhoneType(){
        $ua = self::getUA();
        if($ua!=false){
            preg_match("/(?:\()(.*?)(?:\))/i",$ua,$str1);
            Return $str1[1];
        }else{
            Return false;
        }
    }
}

