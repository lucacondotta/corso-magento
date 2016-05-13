<?php

/**
 * Class MageCourse_CustomShelves_Model_Resource_Shelf_Product_Collection
 */
class MageCourse_CustomShelves_Model_Resource_Shelf_Product_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();

        $this->_init('magecourse_customshelves/shelf_product', 'magecourse_customshelves/shelf_product');
    }

}