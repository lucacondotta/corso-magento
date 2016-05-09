<?php

/**
 * Class MageCourse_CustomShelves_Block_Adminhtml_Shelf_Edit_Tabs_General
 */
class MageCourse_CustomShelves_Block_Adminhtml_Shelf_Edit_Tabs_General extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();

        /** @var MageCourse_CustomShelves_Model_Shelf $shelf */
        $shelf = Mage::registry('current_custom_shelf');

        $form->setDataObject($shelf);

        $general = $form->addFieldset('general', array('legend' => $this->__('General')));

        if ($shelf->getId()) {
            $general->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $general
            ->addField('name', 'text', array(
                'label' => $this->__('Name'),
                'name' => 'name',
                'required' => true
            ))
        ;

        $form->setValues($shelf->getData());

        $this->setForm($form);
    }

}