<?php

namespace Extn\CustomRepo\Model\ResourceModel;

class CustomerAuth extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Init
     */
    protected function _construct()
    {
        $this->_init('customerauth', 'id');
    }
}
