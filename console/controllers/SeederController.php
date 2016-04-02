<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\db\Migration;

class SeederController extends Controller
{
    // The command "yii example/create test" will call "actionCreate('test')"
    public function actionSeed() 
    {
        
        // poppuldate table 'auth item'
        $db = new Migration();
        $db->dropForeignKey('auth_assignment_ibfk_1', 'auth_assignment');
        $db->dropForeignKey('auth_item_child_ibfk_1', 'auth_item_child');
        $db->dropForeignKey('auth_item_child_ibfk_2', 'auth_item_child');
        
        $seeder = new \tebazil\yii2seeder\Seeder();
        $array =
        [
           ['admin',1,'admin can create branches and companies', null, null, null, null],
           ['create-branch',1, 'allow user to add branch', null, null, null, null],
           ['create-company', 1, 'allow user to add company', null, null, null, null]
        ];
        $columnConfig = ['name','type', 'description', null, null, null, null];

        $seeder->table('auth_item')->data($array, $columnConfig)->rowQuantity(3);
        $seeder->refill();
        
        $db->addForeignKey('auth_assignment_ibfk_1', 'auth_assignment', 'item_name', 'auth_item', 'name', 'CASCADE', 'CASCADE');
        $db->addForeignKey('auth_item_child_ibfk_1', 'auth_item_child', 'parent', 'auth_item', 'name', 'CASCADE', 'CASCADE');
        $db->addForeignKey('auth_item_child_ibfk_2', 'auth_item_child', 'child', 'auth_item', 'name', 'CASCADE', 'CASCADE');
        
        // poppuldate table 'auth_item_child'
        $array =
        [
           ['admin','create-branch'],
           ['admin', 'create-company']
        ];
        $columnConfig = ['parent','child'];

        $seeder->table('auth_item_child')->data($array, $columnConfig)->rowQuantity(2);
        $seeder->refill();
        
         // poppuldate table 'source_message'
        $db->dropForeignKey('fk_message_source_message', 'message');
        $array =
        [
           ['app','Welcome']
          
        ];
        $columnConfig = ['category','message'];

        $seeder->table('source_message')->data($array, $columnConfig)->rowQuantity(1);
        $seeder->refill();
        
        $db->addForeignKey('fk_message_source_message', 'message', 'id', 'source_message', 'id', 'CASCADE', 'RESTRICT');
        
         // poppuldate table 'message'
        $array =
        [
            [1,'en','Welcome'],
            [1, 'vn', 'Xin chào']
        ];
        $columnConfig = ['id', 'language','translation'];

        $seeder->table('message')->data($array, $columnConfig)->rowQuantity(2);
        $seeder->refill();
        return 0;
    }
}

