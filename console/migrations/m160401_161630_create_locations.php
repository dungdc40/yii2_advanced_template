<?php

use yii\db\Migration;

class m160401_161630_create_locations extends Migration
{
    public function up()
    {
        $this->createTable('locations', [
            'location_id' => $this->primaryKey(),
            'zip_code' => $this->string(20)->notNull(),
            'city' => $this->string(100)->notNull(),
            'province' => $this->string(100)->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('locations');
    }
}
