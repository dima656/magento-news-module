<?php


$installer=$this;
$tableNews=$installer->getTable('new/news');
$installer->startSetup();
$installer->getConnection()->addColumn($tableNews, 'image',Varien_Db_Ddl_Table::TYPE_TEXT, null, 
        array(
    'comment'=>'image',
    'nullable'=>FALSE,
             ));
$installer->endSetup();

