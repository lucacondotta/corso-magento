<?php

/**
 * Class MageCourse_CustomShelves_Model_Resource_Shelf
 */
class MageCourse_CustomShelves_Model_Resource_Shelf extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Resource initialization
     */
    protected function _construct()
    {
        /**
         * First parameter -> table name
         * Second parameter -> ID field name
         */
        $this->_init('magecourse_customshelves/shelf', 'id');
    }
}