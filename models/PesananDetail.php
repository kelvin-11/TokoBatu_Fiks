<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pesanan_detail".
 *
 * @property int $id
 * @property int $products_id
 * @property int $pesanan_id
 * @property int $jml
 * @property int $total
 *
 * @property Pesanan $pesanan
 * @property Products $products
 */
class PesananDetail extends \yii\db\ActiveRecord
{
    public function fields()
    {
        $parent = parent::fields();

        unset($parent['pesanan_id']);
        if (isset($parent['products_id'])) {
            unset($parent['products_id']);
            $parent['product'] = function ($model) {
                return $model->products->name;
            };
        }
        if (!isset($parent['img'])) {
            $parent['img'] = function ($model) {
                return $this->getImageUrl($model->img);
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
        return 'pesanan_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['products_id', 'pesanan_id', 'jml', 'total'], 'required'],
            [['products_id', 'pesanan_id', 'jml', 'total'], 'integer'],
            [['products_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['products_id' => 'id']],
            [['pesanan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pesanan::class, 'targetAttribute' => ['pesanan_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'products_id' => 'Products ID',
            'pesanan_id' => 'Pesanan ID',
            'jml' => 'Jml',
            'total' => 'Total',
        ];
    }

    /**
     * Gets query for [[Pesanan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPesanan()
    {
        return $this->hasOne(Pesanan::class, ['id' => 'pesanan_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Products::class, ['id' => 'products_id']);
    }
}
