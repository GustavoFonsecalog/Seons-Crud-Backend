<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'products';
    }

    public function rules()
    {
        return [
            [['name', 'quantity', 'category_id'], 'required'],  // Campos obrigatórios
            ['name', 'string', 'max' => 255],
            ['quantity', 'integer'],
            ['category_id', 'integer'],
        ];
    }

}
