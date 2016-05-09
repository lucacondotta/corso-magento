<?php

/**
 * Class MageCourse_CustomShelves_Block_Adminhtml_Shelf_Edit_Form
 */
class MageCourse_CustomShelves_Block_Adminhtml_Shelf_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/customshelves/save', array('_current' => true)),
            'method'    => 'post'
        ));

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}