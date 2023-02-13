<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $alamat
 * @property int|null $no_hp
 * @property int $status
 * @property int $role_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Products[] $products
 * @property Role $role
 * @property Toko[] $tokos
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }
    
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        // return $this->authKey === $authKey;
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'status'], 'required'],
            [['status', 'role_id','codepos'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email', 'password', 'alamat','kota','provinsi','type'], 'string', 'max' => 255],
            [['no_hp'], 'string', 'min' => 11, 'max' => 13],
            [['email','name'],'unique'],
            [['img'], 'file', 'extensions' => ['jpg', 'png', 'jpeg']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
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
            'email' => 'Email',
            'password' => 'Password',
            'alamat' => 'Alamat',
            'no_hp' => 'No Hp',
            'status' => 'Status',
            'role_id' => 'Role ID',
            'img' => 'Image',
            'kota' => 'Kota',
            'codepos' => 'Codepos',
            'upload' => 'Item Preview',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    /**
     * Gets query for [[Tokos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTokos()
    {
        return $this->hasMany(Toko::class, ['id_user' => 'id']);
    }

    public function getImage()
    {
        return Yii::$app->request->hostInfo.'/'.'TokoBatu/app/web/'.$this->img;
    }
}
