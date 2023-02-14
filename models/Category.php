<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $name
 *
 * @property Products[] $products
 */
class Category extends \yii\db\ActiveRecord
{

    public function fields()
    {
        $parent = parent::fields();

       
        if (isset($parent['img'])) {
            $parent['img'] = function ($model) {
                return $this->getImageUrl($model->img);
            };
        }
        return $parent;
    }
    public function getImageUrl($link)
    {
        $link = Yii::getAlias("@web/" . $link);

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
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name',], 'required'],
            [['img'], 'file', 'extensions' => ['jpg', 'png', 'jpeg']],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::class, ['category_id' => 'id']);
    }

    public function getImage()
    {
        return Yii::$app->request->hostInfo.'/'.'TokoBatu/app/web/'.$this->img;
    }
}
