<?php

/**
 * Class MageCourse_CustomShelves_Block_Product_List_Customshelf
 */
class MageCourse_CustomShelves_Block_Product_List_Customshelf extends Mage_Catalog_Block_Product_Abstract
{
    /**
     * @var MageCourse_CustomShelves_Model_Shelf
     */
    protected $_shelf;

    protected $_columnCount;

    protected $_items;

    protected $_itemCollection;

    protected $_itemLimit;

    protected $_itemCollectionLoaded = false;

    /**
     * @return null|Mage_Catalog_Model_Resource_Product_Collection
     */
    public function getItemCollection()
    {
        if (null === $this->_itemCollection && !$this->_itemCollectionLoaded) {
            $product = Mage::registry('current_product');

            if ($product && $customShelfId = $product->getData('custom_shelf')) {
                /** @var MageCourse_CustomShelves_Model_Shelf $customShelf */
                $this->setShelfId($customShelfId);
            }

            if ($this->getShelf()) {
                $collection = $this->getShelf()->getProductCollection();

                if ($product) {
                    $collection->addFieldToFilter('entity_id', array('neq' => $product->getId()));
                }

                if ($limit = $this->getItemLimit()) {
                    $collection->setPageSize($limit);
                }

                $this->_itemCollection = $collection;
            }

            $this->_itemCollectionLoaded = true;
        }

        return $this->_itemCollection;
    }

    /**
     * @return MageCourse_CustomShelves_Model_Shelf
     */
    public function getShelf()
    {
        return $this->_shelf;
    }

    /**
     * @param MageCourse_CustomShelves_Model_Shelf $shelf
     * @return MageCourse_CustomShelves_Block_Product_List_Customshelf
     */
    public function setShelf($shelf)
    {
        $this->_shelf = $shelf;
        return $this;
    }

    public function setShelfId($shelfId)
    {
        $shelf = Mage::getModel('magecourse_customshelves/shelf')->load($shelfId);

        if ($shelf->getId()) {
            $this->_shelf = $shelf;
        }
    }

    public function getItems()
    {
        if (is_null($this->_items)) {
            $this->_items = $this->getItemCollection()->getItems();
        }
        return $this->_items;
    }

    public function setColumnCount($columns)
    {
        if (intval($columns) > 0) {
            $this->_columnCount = intval($columns);
        }
        return $this;
    }

    public function getColumnCount()
    {
        return $this->_columnCount;
    }

    public function getRowCount()
    {
        return ceil(count($this->getItemCollection()->getItems())/$this->getColumnCount());
    }

    /**
     * @return mixed
     */
    public function getItemLimit()
    {
        return $this->_itemLimit;
    }

    /**
     * @param mixed $itemLimit
     * @return MageCourse_CustomShelves_Block_Product_List_Customshelf
     */
    public function setItemLimit($itemLimit)
    {
        $this->_itemLimit = $itemLimit;
        return $this;
    }

    public function resetItemsIterator()
    {
        $this->getItems();
        reset($this->_items);
    }

    public function getIterableItem()
    {
        $item = current($this->_items);
        next($this->_items);
        return $item;
    }
}