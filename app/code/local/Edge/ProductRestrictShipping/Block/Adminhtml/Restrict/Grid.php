<?php

class Edge_ProductRestrictShipping_Block_Adminhtml_Restrict_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setId('productrestrictshipping_id');
        $this->setDefaultSort('increment_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('productrestrictshipping/productRestrictShipping')->getCollection();
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    protected function _prepareColumns()
    {
        $helper = Mage::helper('productrestrictshipping/data');

        $this->addColumn('productrestrictshipping_id', array(
            'header' => $helper->__('Product Restrict Shipping #'),
            'index'  => 'productrestrictshipping_id'
        ));

        $this->addColumn('country_id', array(
            'header' => $helper->__('Country'),
            'index'  => 'country_id'
        ));

        $this->addColumn('attribute_code', array(
            'header' => $helper->__('Attribute'),
            'index'  => 'attribute_code'
        ));

        $this->addColumn('attribute_value', array(
            'header' => $helper->__('Value'),
            'index'  => 'attribute_value'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('productrestrictshipping_id' => $row->getId()));
    }
}