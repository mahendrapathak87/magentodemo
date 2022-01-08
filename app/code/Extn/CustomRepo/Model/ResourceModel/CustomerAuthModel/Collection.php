<?php

namespace Extn\CustomRepo\Model\ResourceModel\CustomerAuthModel;

use Extn\CustomRepo\Model\ResourceModel\CustomerAuthModel;
use Extn\CustomRepo\Model\ResourceModel\CustomerAuth;
/**
 * Class Collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(CustomerAuthModel::class, CustomerAuth::class);
    }
}
