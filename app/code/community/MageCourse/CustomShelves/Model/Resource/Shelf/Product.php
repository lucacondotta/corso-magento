<?php

/**
 * Class MageCourse_CustomShelves_Model_Resource_Shelf_Product
 */
class MageCourse_CustomShelves_Model_Resource_Shelf_Product extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Resource initialization
     */
    protected function _construct()
    {
       $this->_init('magecourse_customshelves/shelf_product', 'id');
    }
}