<?php

/**
 * Class MageCourse_CustomShelves_Adminhtml_CustomshelvesController
 */
class MageCourse_CustomShelves_Adminhtml_CustomshelvesController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    protected function _initShelf()
    {
        $this->_title($this->__('Manage Custom Shelves'));

        $shelfId = (int) $this->getRequest()->getParam('id');
        $shelf = Mage::getModel('magecourse_customshelves/shelf');

        if ($shelfId) {
            $shelf->load($shelfId);
        }

        Mage::register('current_custom_shelf', $shelf);
        return $this;
    }

    public function editAction()
    {
        $this->_initShelf();
        $this->loadLayout();

        $shelf = Mage::registry('current_custom_shelf');

        $this->_title($shelf->getId() ? $shelf->getName() : $this->__('New Custom Shelf'));

        $this->renderLayout();
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getPost();
        if ($data) {
            $this->_initShelf();
            try {
                /** @var MageCourse_CustomShelves_Model_Shelf $shelf */
                $shelf = Mage::registry('current_custom_shelf');

                $shelf->addData($data);

                $shelf->save();

                $this->_getSession()->addSuccess($this->__('Custom shelf has been saved'));

                return $this->_redirect('*/customshelves/edit', array('_current' => true, 'id' => $shelf->getId()));
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($this->__('Unable to save custom shelf'));
            }
        }
        return $this->_redirect('*/customshelves/edit', array('_current' => true));
    }
}