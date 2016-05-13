<?php
/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;

$installer->startSetup();

/**
 * Create Custom Shelves Products Table
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('magecourse_customshelves/shelf_product'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Entity ID')
    ->addColumn('shelf_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false
    ), 'Shelf ID')
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false
    ), 'Product ID')
    ->addColumn('order', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    ), 'Order')
    ->addForeignKey($installer->getFkName('magecourse_customshelves/shelf_product', 'shelf_id', 'magecourse_customshelves/shelf', 'id'),
        'shelf_id', $installer->getTable('magecourse_customshelves/shelf'), 'id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey($installer->getFkName('magecourse_customshelves/shelf_product', 'product_id', 'catalog/product', 'entity_id'),
        'product_id', $installer->getTable('catalog/product'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
;

$installer->getConnection()->createTable($table);

$installer->endSetup();