<?php

use yii\db\Migration;

class m160401_174849_create_auth_rule extends Migration
{
    public function up()
    {
        $this->createTable('auth_rule', [
            'name' => $this->string(64),
            'data' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        
        $this->addPrimaryKey('PK1', 'auth_rule', 'name');
    }

    public function down()
    {
        $this->dropTable('auth_rule');
    }
}
