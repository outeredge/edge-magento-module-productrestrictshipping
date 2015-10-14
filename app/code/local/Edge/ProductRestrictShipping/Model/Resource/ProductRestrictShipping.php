<?php

class Edge_ProductRestrictShipping_Model_Resource_ProductRestrictShipping extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize productrestrictshipping model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('productrestrictshipping/productRestrictShipping', 'productrestrictshipping_id');
    }

}

