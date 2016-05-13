<?php

/**
 * Class MageCourse_CustomShelves_Model_Shelf
 */
class MageCourse_CustomShelves_Model_Shelf extends Mage_Core_Model_Abstract
{

    protected $products;

    protected function _construct()
    {
        /**
         * Call init passing resource model name
         */
        $this->_init('magecourse_customshelves/shelf');
    }

    protected function _afterSave()
    {
        $this->saveAddedProducts();
        return parent::_afterSave();
    }

    public function getProducts()
    {
        if (null === $this->products) {
            $products = Mage::getModel('magecourse_customshelves/shelf_product')->getCollection()
                ->addFieldToFilter('shelf_id', array('eq' => $this->getId()));

            $this->products = $products->getItems();
        }

        return $this->products;
    }

    public function getProductCollection()
    {
        /** @var Mage_Catalog_Model_Resource_Product_Collection $products */
        $products = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('*')
        ;

        $products->joinTable(
            array('shelf_product' => 'magecourse_customshelves/shelf_product'),
            'product_id = entity_id',
            array(
                'shelf_order' => 'order'
            ),
            '{{table}}.shelf_id = ' . $this->getId()
        );
        $products->addOrder('shelf_order', Mage_Core_Model_Resource_Db_Collection_Abstract::SORT_ORDER_ASC);

        return $products;
    }

    protected function saveAddedProducts()
    {
        if ($this->getData('add_product_data')) {
            $addedProducts = $this->getData('add_product_data');

            foreach ($addedProducts as $productId => $options) {
                $shelfProduct = Mage::getModel('magecourse_customshelves/shelf_product');

                if ($existingShelfProductId = $this->hasProduct($productId)) {
                    $shelfProduct->load($existingShelfProductId);
                }

                $shelfProduct
                    ->setProductId($productId)
                    ->setShelfId($this->getId())
                    ->setOrder($options['order'] ?: null)
                    ->save()
                ;
            }

            foreach ($this->getProducts() as $product) {
                if (is_array($addedProducts) && !in_array($product->getProductId(), array_keys($addedProducts))) {
                    $shelfProduct = Mage::getModel('magecourse_customshelves/shelf_product')->load($product->getId());

                    $shelfProduct->delete();
                }
            }
        } else {
            if ($currentProducts = $this->getProducts()) {
                foreach ($currentProducts as $currentProduct) {
                    $shelfProduct = Mage::getModel('magecourse_customshelves/shelf_product')->load($currentProduct->getId());
                    $shelfProduct->delete();
                }
            }
        }
    }

    protected function hasProduct($productId)
    {
        $products = $this->getProducts();

        foreach ($products as $product) {
            if ($product->getProductId() == $productId) {
                return $product->getId();
            }
        }

        return false;
    }
}