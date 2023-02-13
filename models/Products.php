<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property int|null $user_id
 * @property int $category_id
 * @property int|null $toko_id
 * @property string|null $img
 * @property string|null $upload
 * @property int $harga
 * @property int $stok
 * @property string $deskripsi_singkat
 * @property string $deskripsi_lengkap
 *
 * @property Category $category
 * @property Toko $toko
 * @property User $user
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'harga', 'stok', 'deskripsi_produk','berat'], 'required'],
            [['user_id', 'category_id', 'toko_id', 'harga', 'stok',], 'integer'],
            [['deskripsi_produk','berat'], 'string'],
            [['name',], 'string', 'max' => 255],
            [['berat',], 'string', 'max' => 50],
            [['img'], 'file', 'extensions' => ['jpg', 'png', 'jpeg']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
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
            'name' => 'Name',
            'user_id' => 'User ID',
            'category_id' => 'Category',
            'toko_id' => 'Toko ID',
            'img' => 'Image',
            'upload' => 'Item Preview',
            'harga' => 'Harga',
            'stok' => 'Stok',
            'deskripsi_produk' => 'Deskripsi Produk',
            'berat' => 'Berat'
            
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Toko]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToko()
    {
        return $this->hasOne(Toko::class, ['id' => 'toko_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getRupiah()
    {
        return 'Rp'.number_format($this->price,2,',','.');
    }

    public function getImage()
    {
        return Yii::$app->request->hostInfo.'/'.'TokoBatu/app/web/'.$this->img;
    }
}
