<?php

namespace app\models\search;

use app\models\Products;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProdukSearch represents the model behind the search form about `app\models\Produk`.
 */
class ProdukSayaSearch extends Products
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'harga', 'stok', 'category_id', 'toko_id',], 'integer'],
            [['nama', 'deksripsi_produk',], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $toko = \app\models\Toko::findOne(['id_user' => Yii::$app->user->identity->id]);
        $query = Products::find()->where(['toko_id' => $toko->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'harga' => $this->harga,
            'stok' => $this->stok,
            'category_id' => $this->category_id,
            'toko_id' => $this->toko_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'deskripsi_produk', $this->deskripsi_produk]);

        return $dataProvider;
    }
}
