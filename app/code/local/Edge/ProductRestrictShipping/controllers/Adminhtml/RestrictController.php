<?php

class Edge_ProductRestrictShipping_Adminhtml_RestrictController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/productrestrictshipping');
    }
    
    public function indexAction()
    {
        $this->_title($this->__('Catalog'))->_title($this->__('Product Restrict Shipping'));
        $this->loadLayout();
        $this->_setActiveMenu('catalog/catalog');
        $this->_addContent($this->getLayout()->createBlock('productrestrictshipping/adminhtml_restrict'));
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('productrestrictshipping/adminhtml_restrict_grid')->toHtml()
        );
    }

    public function newAction()
    {
        // We just forward the new action to a blank edit form
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id  = $this->getRequest()->getParam('productrestrictshipping_id');

        $model = Mage::getModel('productrestrictshipping/productRestrictShipping');

        if ($id) {
            $model->load($id);

            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This restriction no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        $data = Mage::getSingleton('adminhtml/session')->getRestrictionData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('productrestrictshipping', $model);

        $this->loadLayout();
        $this->_addContent(
            $this->getLayout()->createBlock('productrestrictshipping/adminhtml_restrict_edit')
            ->setData('action', $this->getUrl('*/*/save')));
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('productrestrictshipping/productRestrictShipping');
            $model->setData($postData);

            try {
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The restriction has been saved.'));
                $this->_redirect('*/*/');

                return;
            }
            catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this restriction.'));
            }

            Mage::getSingleton('adminhtml/session')->setRestrictionData($postData);
            $this->_redirectReferer();
        }
    }

    public function deleteAction()
    {
        Mage::getModel('productrestrictshipping/productRestrictShipping')->load(
            $this->getRequest()->getParam('productrestrictshipping_id'))->delete();

        Mage::getSingleton('adminhtml/session')->addSuccess(
            Mage::helper('productrestrictshipping/data')->__('Restriction has been deleted.'));

        $this->_redirect('*/*/');
        return;
    }

}

