<?php

use yii\db\Migration;

class m160401_170121_create_companies extends Migration
{
    public function up()
    {
        $this->createTable('companies', [
            'company_id' => $this->primaryKey(),
            'company_name' => $this->string(100)->notNull(),
            'company_email' => $this->string(100)->notNull(),
            'company_address' => $this->string(250)->notNull(),
            'logo' => $this->string(200)->notNull(),
            'company_email' => $this->string(100)->notNull(),
            'company_start_date' => $this->date()->notNull(),
            'company_created_date' => $this->dateTime()->notNull(),
            'company_status' => "ENUM('active', 'inactive') NOT NULL",
        ]);
    }

    public function down()
    {
        $this->dropTable('companies');
    }
}
