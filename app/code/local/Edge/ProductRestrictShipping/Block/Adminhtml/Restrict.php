<?php

class Edge_ProductRestrictShipping_Block_Adminhtml_Restrict extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'productrestrictshipping';
        $this->_controller = 'adminhtml_restrict';
        $this->_headerText = Mage::helper('productrestrictshipping/data')->__('Product Restrict Shipping');

        parent::__construct();
    }
}