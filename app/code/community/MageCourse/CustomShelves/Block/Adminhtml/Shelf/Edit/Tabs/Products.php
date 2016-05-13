<?php

/**
 * Class MageCourse_CustomShelves_Block_Adminhtml_Shelf_Edit_Tabs_Products
 */
class MageCourse_CustomShelves_Block_Adminhtml_Shelf_Edit_Tabs_Products extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setId('customshelf_products_grid');
        $this->setUseAjax(true);
        if ($this->getShelf()->getId()) {
            $this->setDefaultFilter(array('in_products' => 1));
        }
    }

    /**
     * @return MageCourse_CustomShelves_Model_Shelf|null
     */
    protected function getShelf()
    {
        return Mage::registry('current_custom_shelf');
    }

    /**
     * Add filter
     *
     * @param object $column
     * @return Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Upsell
     */
    protected function _addColumnFilterToCollection($column)
    {
        // Set custom filter for in product flag
        if ($column->getId() == 'in_products') {
            $productIds = $this->_getSelectedProducts();
            if (empty($productIds)) {
                $productIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('entity_id', array('in'=>$productIds));
            } else {
                if($productIds) {
                    $this->getCollection()->addFieldToFilter('entity_id', array('nin'=>$productIds));
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }

    protected function _prepareCollection()
    {
        /** @var Mage_Catalog_Model_Resource_Product_Collection $collection */
        $collection = Mage::getModel('catalog/product')->getCollection();

        $collection
            ->addAttributeToSelect('sku')
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('status')
            ->addAttributeToSelect('visibility')
        ;

        if (Mage::getStoreConfig('magecourse_customshelves/general/use_specific_attribute_sets')) {
            $attributeSetsIds = Mage::getStoreConfig('magecourse_customshelves/general/attribute_sets');
            $attributeSetsIds = explode(',', $attributeSetsIds);
            $collection->addFieldToFilter('attribute_set_id', array('in' => $attributeSetsIds));
        }

        $collection
            ->joinField('stock', 'cataloginventory/stock_item', 'qty', 'product_id=entity_id', null, 'left')
        ;

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('in_products', array(
            'header_css_class' => 'a-center',
            'type' => 'checkbox',
            'name' => 'in_products',
            'values' => $this->_getSelectedProducts(),
            'align' => 'center',
            'index' => 'entity_id'
        ));

        $this->addColumn('sku', array(
            'header' => Mage::helper('magecourse_customshelves')->__('Sku'),
            'index' => 'sku'
        ));

        $this->addColumn('product_name', array(
            'header' => Mage::helper('magecourse_customshelves')->__('Name'),
            'index' => 'name'
        ));

        $this->addColumn('product_status', array(
            'header' => Mage::helper('magecourse_customshelves')->__('Status'),
            'index' => 'status',
            'type'  => 'options',
            'options' => Mage::getSingleton('catalog/product_status')->getOptionArray()
        ));

        $this->addColumn('product_visibility', array(
            'header'=> Mage::helper('magecourse_customshelves')->__('Visibility'),
            'width' => '120px',
            'index' => 'visibility',
            'type'  => 'options',
            'options' => Mage::getModel('catalog/product_visibility')->getOptionArray()
        ));

        $this->addColumn('qty', array(
            'header' => Mage::helper('magecourse_customshelves')->__('Qty'),
            'index' => 'stock',
            'type' => 'number'
        ));

        $this->addColumn('order', array(
            'header'            => Mage::helper('magecourse_customshelves')->__('Position'),
            'name'              => 'order',
            'type'              => 'number',
            'width'             => 60,
            'validate_class'    => 'validate-number',
            'index'             => 'order',
            'editable'          => true,
            'edit_only'         => !$this->getShelf()->getId()
        ));
    }

    /**
     * Rerieve grid URL
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->_getData('grid_url') ? $this->_getData('grid_url') : $this->getUrl('*/*/products_grid', array('_current'=>true));
    }

    protected function _getSelectedProducts()
    {
        $products = $this->getProductsSelected();

        if (!is_array($products)) {
            $products = array_keys($this->getSelectedProducts());
        }
        return $products;
    }

    /**
     * Retrieve shelf products
     *
     * @return array
     */
    public function getSelectedProducts()
    {
        $products = array();
        foreach ($this->getShelf()->getProducts() as $product) {
            $products[$product->getProductId()] = array('order' => $product->getOrder());
        }
        return $products;
    }

}
