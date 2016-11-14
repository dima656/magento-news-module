<?php

$installer=$this;
$tableNews=$installer->getTable('new/news');
$installer->startSetup();
$installer->getConnection()->addColumn($tableNews, 'content',Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
    'comment'=>'News content',
    'nullable'=>FALSE,
));
$installer->endSetup();

