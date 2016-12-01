<?php


$installer=$this;
$tableNews=$installer->getTable('new/news');
$installer->startSetup();
$installer->getConnection()->addColumn($tableNews, 'condition_serialized',Varien_Db_Ddl_Table::TYPE_TEXT, null, 
        array(
    'comment'=>'condition_serialized',
    'nullable'=>FALSE,
             ));
$installer->endSetup();

