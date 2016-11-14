<?php
/*
 * @var Mage_Core_Model_Resource_Setup $this
 */

$installer=$this;
$tableNews = $installer->getTable('new/news');
$installer->startSetup();
$table=$installer->getConnection()
        ->newTable($tableNews)
        ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER,NULL,array(
            'identity'=>true,
            'unsigned'=>true,
            'nullable'=>FALSE,
            'primary'=>TRUE,
        ))
        ->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR,NULL,array(
          
            'nullable'=>FALSE,
            
        ))
        ->addColumn('news_status', Varien_Db_Ddl_Table::TYPE_TINYINT,NULL,array(
            
            'nullable'=>FALSE,
          
        ))
        ->addColumn('date_created', Varien_Db_Ddl_Table::TYPE_DATETIME,NULL,array(
           
            'nullable'=>FALSE,
            
        ))
        ->addColumn('date_modified', Varien_Db_Ddl_Table::TYPE_DATETIME,NULL,array(
            
            'nullable'=>FALSE,
           
        ));
$installer->getConnection()->createTable($table);
$installer->endSetup();

