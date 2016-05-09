<?php

/**
 * Class MageCourse_CustomShelves_Block_Shelf_Edit
 */
class MageCourse_CustomShelves_Block_Adminhtml_Shelf_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        parent::_construct();

        $this->_blockGroup = 'magecourse_customshelves_adminhtml';

        $this->_controller = 'shelf';

        $this->_mode = 'edit';
    }

}