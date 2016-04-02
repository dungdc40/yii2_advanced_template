<?php

use yii\db\Migration;

class m160401_180447_create_auth_item_child extends Migration
{
    public function up()
    {
        $this->createTable('auth_item_child', [
            'parent' => $this->string(64),
            'child' => $this->string(64)
        ]);
        
        $this->addPrimaryKey('PK', 'auth_item_child', ['parent', 'child']);
        $this->createIndex('child', 'auth_item_child', 'child');
         
        $this->addForeignKey('auth_item_child_ibfk_1', 'auth_item_child', 'parent', 'auth_item', 'name', 'CASCADE', 'CASCADE');
        $this->addForeignKey('auth_item_child_ibfk_2', 'auth_item_child', 'child', 'auth_item', 'name', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('auth_item_child');
    }
}
