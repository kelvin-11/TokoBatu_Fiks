<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promo".
 *
 * @property int $id
 * @property int $products_id
 * @property int|null $nilai
 * @property string $created_at
 * @property string $updated_at
 */
class Promo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['products_id', 'created_at', 'updated_at'], 'required'],
            [['products_id', 'toko_id', 'nilai'], 'integer'],
            [['created_at', 'updated_at','date_start','date_end'], 'safe'],
            [['products_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['products_id' => 'id']],
            [['toko_id'], 'exist', 'skipOnError' => true, 'targetClass' => Toko::class, 'targetAttribute' => ['toko_id' => 'id']],
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
            'toko_id' => 'Toko ID',
            'nilai' => 'Nilai',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getProducts()
    {
        return $this->hasOne(Products::class, ['id' => 'products_id']);
    }
    
    public function getTokos()
    {
        return $this->hasMany(Toko::class, ['id' => 'toko_id']);
    }
}
