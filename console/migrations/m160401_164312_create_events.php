<?php

use yii\db\Migration;

class m160401_164312_create_events extends Migration
{
    public function up()
    {
        $this->createTable('events', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'created_date' => $this->date()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('events');
    }
}
