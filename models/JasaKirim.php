<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jasa_kirim".
 *
 * @property int $id
 * @property string $Name
 * @property int|null $Harga
 */
class JasaKirim extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jasa_kirim';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','slug'], 'required'],
            [['name','slug',], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'Harga' => 'Harga',
        ];
    }
}
