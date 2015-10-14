<?php

class Edge_ProductRestrictShipping_Model_ProductRestrictShipping extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        $this->_init('productrestrictshipping/productRestrictShipping');
    }

    public function getAllByCountry($country)
    {
        $result = $this->getCollection()
            ->addFilter('country_id', $country);

        if ($result->getData()) {
            return $result->getData();
        }

        return false;
    }

}

