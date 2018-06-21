<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property int $type
 */
class Category extends \yii\db\ActiveRecord
{
    const TYPE_POST=1;
    const TYPE_SCHOOL=2;
    const TYPE_HOSPITAL=3;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'hot'], 'integer'],
            [['name'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名称',
            'type' => '类型',
            'hot' => '热度',
        ];
    }

    public static function findHotCategory()
    {
        return Category::find()->orderBy('hot DESC')->all();
    }

    static public function getAllType()
    {
        return [1=>'文章',2=>'大学',3=>'医院'];
    }

    public function getType0()
    {
        $all = $this->getAllType();
        return $all[$this->type];
    }
}
