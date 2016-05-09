<?php

/**
 * Class MageCourse_CustomShelves_Model_Resource_Shelf_Collection
 */
class MageCourse_CustomShelves_Model_Resource_Shelf_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();

        /**
         * First parameter -> model name
         * Second parameter -> resource model name
         */
        $this->_init('magecourse_customshelves/shelf', 'magecourse_customshelves/shelf');
    }
}