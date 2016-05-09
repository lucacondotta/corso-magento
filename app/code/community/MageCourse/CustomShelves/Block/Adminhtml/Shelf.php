<?php

/**
 * Class MageCourse_CustomShelves_Block_Adminhtml_Shelf
 */
class MageCourse_CustomShelves_Block_Adminhtml_Shelf extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();

        $this->_blockGroup = 'magecourse_customshelves_adminhtml';

        $this->_controller = 'shelf';

        $this->_headerText = Mage::helper('magecourse_customshelves')->__('Custom shelves');
    }

    public function getCreateUrl()
    {
        return $this->getUrl('adminhtml/customshelves/edit');
    }
}