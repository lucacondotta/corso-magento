<?php

/**
 * Class MageCourse_CustomShelves_Model_Shelf
 */
class MageCourse_CustomShelves_Model_Shelf extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        /**
         * Call init passing resource model name
         */
        $this->_init('magecourse_customshelves/shelf');
    }
}