<?php

use yii\db\Migration;

class m160401_171913_create_branches extends Migration
{
    public function up()
    {
        $this->createTable('branches', [
            'branch_id' => $this->primaryKey(),
            'companies_company_id' => $this->integer()->notNull(),
            'branch_name' => $this->string(100)->notNull(),
            'branch_address' => $this->string(100)->notNull(),
            'branch_created_date' => $this->dateTime()->notNull(),
            'branch_status' => "ENUM('active', 'inactive') NOT NULL"       
        ]);
        
        // reference from branches to companies
        $this->createIndex('companies_company_id', 'branches', 'companies_company_id');
        $this->addForeignKey('branches_ibfk_1', 'branches', 'companies_company_id', 'companies', 
                                    'company_id', 'RESTRICT', 'RESTRICT');
        
         // reference from  departments to branches
        $this->createIndex('branches_branch_id', 'departments', 'branches_branch_id');
        $this->addForeignKey('departments_ibfk_1', 'departments', 'branches_branch_id', 'branches', 
                                    'branch_id', 'RESTRICT', 'RESTRICT');
        
         // reference from  departments to companies
        $this->createIndex('companies_company_id', 'departments', 'companies_company_id');
        $this->addForeignKey('departments_ibfk_2', 'departments', 'companies_company_id', 'companies', 
                                    'company_id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('branches');
    }
}
