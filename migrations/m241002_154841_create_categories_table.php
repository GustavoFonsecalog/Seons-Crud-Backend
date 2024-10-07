<?php

use yii\db\Migration;

class m241002_154841_create_categories_table extends Migration
{
    public function up()
    {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        // Inserir categorias iniciais
        $this->batchInsert('categories', ['id', 'name'], [
            [1, 'Esportes'],
            [2, 'Eletrônicos'],
            [3, 'Lazer'],
        ]);
    }

    public function down()
    {
        $this->dropTable('categories');
    }
}

