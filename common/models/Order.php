<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $goods_id
 * @property int $user_id
 * @property string $price
 * @property int $pay_time
 * @property int $create_time
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['goods_id', 'user_id', 'pay_time', 'create_time'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => '商品ID',
            'user_id' => '用户ID',
            'price' => '价格',
            'pay_time' => '支付时间',
            'create_time' => '下单时间',
        ];
    }
}
