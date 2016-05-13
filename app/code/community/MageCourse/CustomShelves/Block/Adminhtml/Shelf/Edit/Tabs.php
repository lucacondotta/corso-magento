<?php

/**
 * Class MageCourse_CustomShelves_Block_Adminhtml_Shelf_Edit_Tabs
 */
class MageCourse_CustomShelves_Block_Adminhtml_Shelf_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    protected function _construct()
    {
        parent::_construct();

        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
    }

    protected function _beforeToHtml()
    {
        $this->addTab('general', array(
            'label' => Mage::helper('magecourse_customshelves')->__('General'),
            'title' => Mage::helper('magecourse_customshelves')->__('General'),
            'content' => $this->getLayout()->createBlock('magecourse_customshelves_adminhtml/shelf_edit_tabs_general')->toHtml()
        ));
        
        $this->addTab('add_products', array(
            'label' => Mage::helper('magecourse_customshelves')->__('Products'),
            'title' => Mage::helper('magecourse_customshelves')->__('Products'),
            'url' => $this->getUrl('*/customshelves/products', array('_current' => true)),
            'class' => 'ajax'
        ));

        return parent::_beforeToHtml();
    }

}