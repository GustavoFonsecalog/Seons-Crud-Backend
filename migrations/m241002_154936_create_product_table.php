<?php

use yii\db\Migration;

class m241002_154936_create_product_table extends Migration
{
    public function up()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        // Crie a chave estrangeira
        $this->addForeignKey(
            'fk-product-category_id',
            'products',
            'category_id',
            'categories',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-product-category_id', 'products');
        $this->dropTable('products');
    }
}

