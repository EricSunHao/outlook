<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "goods".
 *
 * @property int $id
 * @property string $name
 * @property string $photo
 * @property string $content
 * @property int $status
 * @property string $price
 * @property int $create_time
 * @property int $update_time
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'content'], 'required'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 65],
            [['status', 'create_time', 'update_time'], 'integer'],
            [['price'], 'number'],
//            [['photo'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'photo' => '图片',
            'content' => '内容',
            'status' => '状态',
            'price' => '价格',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
        ];
    }


    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            $upload = new UploadForm();

            if (Yii::$app->request->isPost) {
                $upload->file = UploadedFile::getInstance($this, 'photo');
                if ($upload->file && $upload->validate()) {
                    $upload->file->saveAs(Yii::getAlias('@backend') .'/web/Uploads/goods/'. $upload->file->baseName . '.' . $upload->file->extension);
                    $this->photo = '/Uploads/goods/'. $upload->file->baseName . '.' . $upload->file->extension;
                }
            }
            if($insert)
            {
                $this->create_time = time();
                $this->update_time = time();
            }else{
                $this->update_time = time();
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getBeginning($length=30)
    {
        $tmpStr = strip_tags($this->content);
        $tmpLen = mb_strlen($tmpStr);

        $tmpStr = mb_substr($tmpStr,0,$length,'utf-8');
        return $tmpStr.($tmpLen>$length?'...':'');
    }

    public function getStatusName()
    {
        if ($this->status == 1)
        {
            return '已上架';
        }else{
            return '待上架';
        }

    }
}
