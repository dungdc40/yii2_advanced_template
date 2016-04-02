<?php

use yii\db\Migration;

class m160401_181106_create_message extends Migration
{
    public function up()
    {
        $this->createTable('message', [
            'id' => $this->integer(),        
            'language' => $this->string(16)->notNull(),
            'translation' => $this->text(),
        ]);
        
        $this->addPrimaryKey('PK', 'message', ['id','language']);
        $this->createIndex('id', 'message', 'id');
         
        $this->addForeignKey('fk_message_source_message', 'message', 'id', 'source_message', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('message');
    }
}
