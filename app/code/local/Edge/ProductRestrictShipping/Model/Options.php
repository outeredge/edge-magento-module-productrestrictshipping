<?php

class Edge_ProductRestrictShipping_Model_Options
{
    public function toOptionArray()
    {
        $attributes = Mage::getResourceModel('catalog/product_attribute_collection')->getItems();
        $allCodeAttributes = [''];
        foreach ($attributes as $attribute) {
             $allCodeAttributes[$attribute->getAttributeCode()] = $attribute->getAttributeCode();
        }
        return $allCodeAttributes;
    }
}