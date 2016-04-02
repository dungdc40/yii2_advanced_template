<?php

use yii\db\Migration;

class m160401_171635_create_departments extends Migration
{
    public function up()
    {
        $this->createTable('departments', [
            'department_id' => $this->primaryKey(),
            'branches_branch_id' => $this->integer()->notNull(),
            'department_name' => $this->string(100)->notNull(),
            'companies_company_id' => $this->integer()->notNull(),
            'department_created_date' => $this->dateTime()->notNull(),
            'department_status' => "ENUM('active', 'inactive') NOT NULL"          
        ]);
    }

    public function down()
    {
        $this->dropTable('departments');
    }
}
