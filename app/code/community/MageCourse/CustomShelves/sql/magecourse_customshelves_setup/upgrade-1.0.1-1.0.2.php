<?php
/** @var Mage_Catalog_Model_Resource_Setup $installer */
$installer = $this;

$installer->startSetup();

/**
 * Create Catalog Product Attribute custom_shelf
 */
$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'custom_shelf', array(
    'type' => 'int',
    'label' => 'Custom shelf',
    'input' => 'select',
    'global'=> Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible' => true,
    'required' => false,
    'user_defined' => true,
    'source' => 'magecourse_customshelves/product_attribute_source_shelf'
));

$installer->endSetup();