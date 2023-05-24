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
    public function fields()
    {
        $parent = parent::fields();
        if (isset($parent['jasa_id'])) {
            unset($parent['jasa_id']);
            $parent['jasa'] = function ($model) {
                // $jasa = \app\models\JasaKirim::findOne(['id'=>$model->jasa_id]);
                // return $jasa;
                if($model->jasa_id != null){
                    return $model->jasa->name;
                }else{
                    return '';
                }
            };
        }
        if (isset($parent['user_id'])) {
            unset($parent['user_id']);
            $parent['user'] = function ($model) {
                return $model->user->name;
            };
        }
        if (isset($parent['status_pemesanan'])) {
            unset($parent['status_pemesanan']);
            $parent['status_pesanan'] = function ($model) {
                $status = $model->status_pemesanan;
                foreach ($status as $key => $value) {
                    # code...
                    if($value == "pending"){
                        return "Pending";
                    }elseif ($value == "dikonfirmasi") {
                        return "Di Konfirmasi";
                    }elseif ($value == "dalam perjalanan") {
                        return "Dalam Perjalanan";
                    }elseif ($value == "sukses") {
                        return "Sukses";
                    }elseif ($value == "gagal") {
                        return "Gagal";
                    }
                }
                
            };
        }
        if (!isset($parent['detail_pesanan'])) {
            unset($parent['detail_pesanan']);
            $parent['detail_pesanan'] = function ($model) {
                $detail = \app\models\PesananDetail::find()->where(['pesanan_id'=>$model->id])->all();
                return $detail;
            };
        }
        return $parent;
    }
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
            [['user_id', 'total_harga','kode_unik','status','status_pemesanan'], 'required'],
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
