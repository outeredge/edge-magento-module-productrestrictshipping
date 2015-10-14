<?php

class Edge_ProductRestrictShipping_Block_Adminhtml_Restrict_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init class
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('productrestrictshipping_id_form');
        $this->setTitle($this->__('Product Restiction Shipping Information'));
    }

    /**
     * Setup form fields for inserts/updates
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::registry('productrestrictshipping');

        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method'    => 'post'
        ));

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('productrestrictshipping/data')->__('Restriction Information'),
            'class'     => 'fieldset-wide',
        ));

        if ($model->getId()) {
            $fieldset->addField('productrestrictshipping_id', 'hidden', array(
                'name' => 'productrestrictshipping_id',
            ));
        }

        $fieldset->addField('country_id', 'text', array(
            'name'      => 'country_id',
            'label'     => Mage::helper('productrestrictshipping/data')->__('Country'),
            'title'     => Mage::helper('productrestrictshipping/data')->__('Country'),
            'required'  => true,
        ));

         $fieldset->addField('attribute_code', 'text', array(
            'name'      => 'attribute_code',
            'label'     => Mage::helper('productrestrictshipping/data')->__('Attribute Code'),
            'title'     => Mage::helper('productrestrictshipping/data')->__('Attribute Code'),
            'required'  => true,
        ));

          $fieldset->addField('attribute_value', 'text', array(
            'name'      => 'attribute_value',
            'label'     => Mage::helper('productrestrictshipping/data')->__('Attribute Value'),
            'title'     => Mage::helper('productrestrictshipping/data')->__('Attribute Value'),
            'required'  => true,
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}