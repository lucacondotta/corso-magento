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
}