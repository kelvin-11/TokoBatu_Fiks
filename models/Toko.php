<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "toko".
 *
 * @property int $id
 * @property int $id_user
 * @property string $name
 * @property string $deskripsi
 * @property string $alamat
 * @property string $no_whatsapp
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $flag
 *
 * @property Products[] $products
 * @property User $user
 */
class Toko extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'toko';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'name', 'deskripsi', 'alamat', 'no_whatsapp'], 'required'],
            [['id_user',], 'integer'],
            [['deskripsi', 'alamat'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['no_whatsapp'], 'string', 'min' => 11, 'max' => 13],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'name' => 'Name',
            'deskripsi' => 'Deskripsi',
            'alamat' => 'Alamat',
            'no_whatsapp' => 'No Whatsapp',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'flag' => 'Flag',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::class, ['toko_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}
