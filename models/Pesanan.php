<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pesanan".
 *
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property int $total_harga
 * @property int $kode_unik
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class Pesanan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pesanan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'total_harga', 'created_at', 'updated_at','kode_unik','status','status_pemesanan'], 'required'],
            [['user_id', 'status', 'total_harga'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['jasa_id'], 'exist', 'skipOnError' => true, 'targetClass' => JasaKirim::class, 'targetAttribute' => ['jasa_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'total_harga' => 'Total Harga',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    protected $status_pemesanan = ['pending','dikonfirmasi','dalam perjalanan','sukses','gagal'];

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJasa()
    {
        return $this->hasOne(JasaKirim::class, ['id' => 'jasa_id']);
    }
}
