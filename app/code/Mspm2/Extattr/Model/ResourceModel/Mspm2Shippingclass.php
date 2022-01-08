<?php
namespace Mspm2\Extattr\Model\ResourceModel;
class Mspm2Shippingclass extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('mspm2_product_shipping_class', 'product_id');
    }


}
