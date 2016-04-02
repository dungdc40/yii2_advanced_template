<?php

use yii\db\Migration;

class m160401_162548_create_customers extends Migration
{
    public function up()
    {
        $this->createTable('customers', [
            'customer_id' => $this->primaryKey(),
            'customer_name' => $this->string(100)->notNull(),
            'zip_code' => $this->string(20)->notNull(),
            'city' => $this->string(100)->notNull(),
            'province' => $this->string(100)->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('customers');
    }
}
