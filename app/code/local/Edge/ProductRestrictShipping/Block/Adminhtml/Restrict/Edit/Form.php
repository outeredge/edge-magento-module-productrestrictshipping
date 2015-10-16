<?php

class Edge_ProductRestrictShipping_Block_Adminhtml_Restrict_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected $preSelectedAttributeSet = 'brand';
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

        $countryCollection = Mage::getModel('directory/country')->getCollection();
        $allCountry = [''];
        foreach($countryCollection as $country) {
            $allCountry[$country->getId()] = $country->getId();
        }

        $country = $fieldset->addField('country_id', 'select', array(
            'name'      => 'country_id',
            'label'     => Mage::helper('productrestrictshipping/data')->__('Country'),
            'title'     => Mage::helper('productrestrictshipping/data')->__('Country'),
            'values'    => $allCountry,
            'required' => true
        ));

        $attributes = Mage::getResourceModel('catalog/product_attribute_collection')->getItems();
        $allCodeAttributes = [''];
        foreach ($attributes as $attribute) {
             $allCodeAttributes[$attribute->getAttributeCode()] = $attribute->getAttributeCode();
        }

        $attributeCode = $fieldset->addField('attribute_code', 'select', array(
            'name'      => 'attribute_code',
            'label'     => Mage::helper('productrestrictshipping/data')->__('Attribute Code'),
            'title'     => Mage::helper('productrestrictshipping/data')->__('Attribute Code'),
            'values'    => $allCodeAttributes,
            'required'  => true
        ));

        $attributeInfo    = Mage::getResourceModel('eav/entity_attribute_collection')->setCodeFilter($this->preSelectedAttributeSet)->getFirstItem();
        $attributeId      = $attributeInfo->getAttributeId();
        $attribute        = Mage::getModel('catalog/resource_eav_attribute')->load($attributeId);
        $attributeOptions = $attribute ->getSource()->getAllOptions(false);

        $allValueAttributes = [];
        foreach ($attributeOptions as $attributeOption) {
            $allValueAttributes[$attributeOption['label']] = $attributeOption['label'];
        }

        $attributeValue = $fieldset->addField('attribute_value', 'select',array(
            'name'      => 'attribute_value',
            'label'     => Mage::helper('productrestrictshipping/data')->__('Attribute Value'),
            'title'     => Mage::helper('productrestrictshipping/data')->__('Attribute Value'),
            'required'  => true,
            'values'    => $allValueAttributes
        ));

        $this->setChild('form_after',$this->getLayout()->createBlock('adminhtml/widget_form_element_dependence')
            ->addFieldMap($attributeCode->getName(), $attributeCode->getHtmlId())
            ->addFieldMap($attributeValue->getName(), $attributeValue->getHtmlId())
            ->addFieldDependence($attributeValue->getName(), $attributeCode->getName(), $this->preSelectedAttributeSet));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}