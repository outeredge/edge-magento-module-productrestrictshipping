<?php

class Edge_ProductRestrictShipping_Model_Observer
{

    public function saveShippingActionPredispatch($observer)
    {

        $billing = Mage::app()->getRequest()->getPost('billing');
        if (!empty($billing) && $billing['use_for_shipping'] != 1) {
            return;
        }

        $shipping = Mage::app()->getRequest()->getPost('shipping');

        if (empty($shipping) && empty($billing)) {
            return;
        } else if (empty($shipping)) {
            $data = $billing;
        } else {
            $data = $shipping;
        }

        $restrictions = Mage::getModel('productrestrictshipping/productRestrictShipping')->getAllByCountry($data['country_id']);
        if ($restrictions == false) {
            return;
        }

        $storeId = Mage::app()->getStore();

        foreach (Mage::getSingleton('checkout/session')->getQuote()->getAllItems() as $item) {

            foreach ($restrictions as $restriction) {

                $attribute_option_id = Mage::getResourceModel('catalog/product')
                    ->getAttributeRawValue($item->getProduct()->getId(), $restriction['attribute_code'], $storeId);

                $product = Mage::getModel('catalog/product')
                    ->setStoreId($storeId)
                    ->setData($restriction['attribute_code'], $attribute_option_id);

                $text = $product->getAttributeText($restriction['attribute_code']);

                if ($text == $restriction['attribute_value']) {
                    if(Mage::getStoreConfig('prshipping/prshipping/message')) {
                        $msg = Mage::getStoreConfig('prshipping/prshipping/message');
                    }
                    else {
                        $msg = $item->getProduct()->getName(). " is not available in your country.";
                    }
                    http_response_code(500);
                    die();
                }

            }

        }

    }

}