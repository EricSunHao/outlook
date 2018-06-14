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
}
