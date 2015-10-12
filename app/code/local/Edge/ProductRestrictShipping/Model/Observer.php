<?php

class Edge_ProductRestrictShipping_Model_Observer
{

      public function saveShippingActionPredispatch($observer)
      {

        $billing = $observer->getEvent()->getController()->getRequest()->getPost('billing');

        foreach(Mage::getSingleton('checkout/session')->getQuote()->getAllItems() as $item){
            if(!$billing['city']==$item->getProduct()->getCity()){
                Mage::throwException("You can't buy this product because you're shipping to the wrong place!");
            }
        }

    }

}