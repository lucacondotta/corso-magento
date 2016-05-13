<?php

/**
 * Class MageCourse_CustomShelves_Model_Product_Attribute_Source_Shelf
 */
class MageCourse_CustomShelves_Model_Product_Attribute_Source_Shelf
    extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        /** @var MageCourse_CustomShelves_Model_Resource_Shelf_Collection $collection */
        $collection = Mage::getResourceModel('magecourse_customshelves/shelf_collection');
        $options = $collection->toOptionArray();
        array_unshift($options, array(
            'label' => Mage::helper('magecourse_customshelves')->__('None')
        ));
        return $options;
    }
}