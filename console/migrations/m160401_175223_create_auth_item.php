<?php

use yii\db\Migration;

class m160401_175223_create_auth_item extends Migration
{
    public function up()
    {
        $this->createTable('auth_item', [
            'name' => $this->string(64),
            'type' => $this->integer(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        
        $this->addPrimaryKey('PK1', 'auth_item', 'name');
        
        $this->createIndex('rule_name', 'auth_item', 'rule_name');
        $this->createIndex('type', 'auth_item', 'type');
        
        $this->addForeignKey('auth_item_ibfk_1', 'auth_item', 'rule_name', 'auth_rule', 'name', null, 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('auth_item');
    }
}
