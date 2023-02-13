<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "action".
 *
 * @property int $id
 * @property string $controller_id
 * @property string $action_id
 * @property string $name
 */
class Action extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'action';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['controller_id', 'action_id', 'name'], 'required'],
            [['controller_id', 'action_id', 'name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'controller_id' => 'Controller ID',
            'action_id' => 'Action ID',
            'name' => 'Name',
        ];
    }
}
