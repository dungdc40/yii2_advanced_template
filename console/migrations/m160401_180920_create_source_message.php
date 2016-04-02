<?php

use yii\db\Migration;

class m160401_180920_create_source_message extends Migration
{
    public function up()
    {
        $this->createTable('source_message', [
            'id' => $this->primaryKey(),
            'category' => $this->string(255),
            'message' => $this->text()
        ]);
    }

    public function down()
    {
        $this->dropTable('source_message');
    }
}
