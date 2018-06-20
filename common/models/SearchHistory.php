<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "search_history".
 *
 * @property int $uid
 * @property string $keyword
 * @property int $add_time
 */
class SearchHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'search_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'add_time'], 'integer'],
            [['keyword'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uid' => '用户id',
            'keyword' => '关键词',
            'add_time' => '搜索时间',
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

    /**
     * @param $limit int 获取的关键词数量
     * @return array
     */
    public static function findSearchHistory($limit=10)
    {
        $uid = Yii::$app->user->id;
        $models=SearchHistory::find()->where("uid=$uid")->groupBy('keyword')->orderBy('add_time desc')->limit($limit)->all();
        $keywords=array();
        foreach ($models as $model)
        {
            $keywords[]=$model->keyword;
        }
        return $keywords;
    }

    /**
     * @param $param string 获取相近的搜索关键词
     * @return string
     */
    public static function findSameKeyword($param='')
    {
        $models=SearchHistory::find()->where(['like', 'keyword',$param])->groupBy('keyword')->orderBy('add_time desc')->limit(3)->all();
        $keywords=array();
        foreach ($models as $model)
        {
            $keywords[]=$model->keyword;
        }
        foreach ($keywords as $k=>$v){
            if ($param == $v) unset($keywords[$k]);
        }

        if (empty($keywords)){
            $models=SearchHistory::find()->groupBy('keyword')->orderBy('add_time desc')->limit(2)->all();
            $keywords=array();
            foreach ($models as $model)
            {
                $keywords[]=$model->keyword;
            }
            foreach ($keywords as $k=>$v){
                if ($param == $v) unset($keywords[$k]);
            }
        }

        $String='';

        foreach ($keywords as $keyword)
        {
            $url = Yii::$app->urlManager->createUrl(['/search/detail','keywords'=>$keyword]);
            $String.=' "<a href="'.$url.'" style="color:#ff5501">'.$keyword.'</a>"';
        }
        return $String;
    }
}
