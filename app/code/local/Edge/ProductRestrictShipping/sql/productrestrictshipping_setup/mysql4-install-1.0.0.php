<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

/**
 * Create table 'productrestrictshipping/productrestrictshipping'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('productrestrictshipping/productRestrictShipping'))
    ->addColumn('productrestrictshipping_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'ProductRestrictShipping ID')
    ->addColumn('country_id', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        ), 'Country Id')
    ->addColumn('attribute_code', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        ), 'Attribute Code')
    ->addColumn('attribute_value', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        ), 'Attribute Product Value')
    ->addColumn('added_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Add date and time')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Last updated date')
    ->setComment('ProductRestrictShipping main Table');

$installer->getConnection()->createTable($table);

$installer->endSetup();
