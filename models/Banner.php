<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property int $id
 * @property string $image
 * @property string $created_at
 */
class Banner extends \yii\db\ActiveRecord
{
    public function fields()
    {
        $parent = parent::fields();
       
        if (isset($parent['image'])) {
            $parent['image'] = function ($model) {
                return $this->getImageUrl($model->image);
            };
        }
        return $parent;
    }
    public function getImageUrl($link)
    {
        $link = Yii::getAlias("@web/upload/" . $link);

        // check file exists
        if (
            file_exists($link)
            && !is_dir($link)
        ) {
            return $link;
        }

        // default image
        return $link;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'created_at','date_start','date_end'], 'required'],
            [['created_at','date_start','date_end'], 'safe'],
            [['image'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'created_at' => 'Created At',
        ];
    }
}
