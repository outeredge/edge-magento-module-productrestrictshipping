<?php

class Edge_ProductRestrictShipping_Block_Adminhtml_Restrict_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     */
    public function __construct()
    {
        $this->_objectId = 'productrestrictshipping_id';
        $this->_blockGroup = 'productrestrictshipping';
        $this->_controller = 'adminhtml_restrict';

        parent::__construct();

        $this->_updateButton('save', 'label', $this->__('Save Restriction'));
        $this->_updateButton('delete', 'label', $this->__('Delete Restriction'));
    }

    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('productrestrictshipping')->getId()) {
            return $this->__('Edit Restriction');
        }
        else {
            return $this->__('New Restriction');
        }
    }
}