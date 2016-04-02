<?php

use yii\db\Migration;

class m160401_164418_create_emails extends Migration
{
    public function up()
    {
        $this->createTable('emails', [
            'id' => $this->primaryKey(),
            'receiver_name' => $this->string(50)->notNull(),
            'receiver_email' => $this->string(255)->notNull(),
            'subject' => $this->string(255)->notNull(),
            'content' => $this->text()->notNull(),
            'attachment' => $this->string(255)->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('emails');
    }
}
