<?php

use yii\db\Migration;

class m160401_164645_create_po extends Migration
{
    public function up()
    {
        $this->createTable('po', [
            'id' => $this->primaryKey(),
            'po_no' => $this->string(10)->notNull(),
            'description' => $this->text()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('po');
    }
}
