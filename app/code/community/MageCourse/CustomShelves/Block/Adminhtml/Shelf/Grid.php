<?php

/**
 * Class MageCourse_CustomShelves_Block_Adminhtml_Shelf_Grid
 */
class MageCourse_CustomShelves_Block_Adminhtml_Shelf_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->setId('customshelves_grid');
    }

    protected function _getHelper()
    {
        return Mage::helper('magecourse_customshelves');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('magecourse_customshelves/shelf_collection');

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => $this->_getHelper()->__('ID'),
            'type' => 'number',
            'index' => 'id',
            'filter' => false
        ));

        $this->addColumn('name', array(
            'header' => $this->_getHelper()->__('Name'),
            'index' => 'name'
        ));

        $this->addColumn('created_at', array(
            'header' => $this->_getHelper()->__('Created'),
            'type' => 'datetime',
            'index' => 'created_at',
            'filter' => false
        ));

        $this->addColumn('updated_at', array(
            'header' => $this->_getHelper()->__('Updated'),
            'type' => 'datetime',
            'index' => 'updated_at',
            'filter' => false
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($item)
    {
        return $this->getUrl('*/customshelves/edit', array('id' => $item->getId()));
    }


}