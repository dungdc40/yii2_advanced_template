<?php

use yii\db\Migration;

class m160401_164750_create_po_item extends Migration
{
    public function up()
    {
        $this->createTable('po_item', [
            'id' => $this->primaryKey(),
            'po_item_no' => $this->string(10)->notNull(),
            'quantity' => $this->double()->notNull(),
            'po_id' => $this->integer()->notNull(),
        ]);
        
        $this->createIndex('po_id', 'po_item', 'po_id');
        $this->addForeignKey('po_item_ibfk_1', 'po_item', 'po_id', 'po', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('po_item');
    }
}
