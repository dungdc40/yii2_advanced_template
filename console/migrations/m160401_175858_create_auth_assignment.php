<?php

use yii\db\Migration;

class m160401_175858_create_auth_assignment extends Migration
{
    public function up()
    {
        $this->createTable('auth_assignment', [
            'item_name' => $this->string(64),
            'user_id' => $this->integer(64),
            'created_at' => $this->integer()
        ]);
        
        $this->addPrimaryKey('PK', 'auth_assignment', ['item_name', 'user_id']);
        
        $this->addForeignKey('auth_assignment_ibfk_1', 'auth_assignment', 'item_name', 'auth_item', 'name', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('auth_assignment');
    }
}
