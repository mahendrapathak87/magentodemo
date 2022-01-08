<?php
namespace Mspm2\Extattr\Plugin;

use Mspm2\Extattr\Model\ResourceModel\Mspm2Shippingclass\CollectionFactory;

class ProductShippingClass
{
    public $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory){
        $this->collectionFactory =$collectionFactory;
    }

    public function afterGet(
        \Magento\Catalog\Api\ProductRepositoryInterface $subject,
        \Magento\Catalog\Api\Data\ProductInterface $productResult
    ){
        if($productResult->getExtensionAttributes() && $productResult->getExtensionAttributes()->getMspm2ShippingClss()){
            return $productResult;
        }

        $mspm2ShippingClass= $this->getIsShippingClass($productResult->getId());
        $extensionAttributes = $productResult->getExtensionAttributes()->setMspm2ShippingClss($mspm2ShippingClass);
        $productResult->setExtensionAttributes($extensionAttributes);
        return $productResult;

    }

    public function afterGetById(
        \Magento\Catalog\Api\ProductRepositoryInterface $subject,
        \Magento\Catalog\Api\Data\ProductInterface $productResult
    ){
        if($productResult->getExtensionAttributes() && $productResult->getExtensionAttributes()->getMspm2ShippingClss()){
            return $productResult;
        }

        $mspm2ShippingClass= $this->getIsShippingClass($productResult->getId());
        $extensionAttributes = $productResult->getExtensionAttributes()->setMspm2ShippingClss($mspm2ShippingClass);
        $productResult->setExtensionAttributes($extensionAttributes);
        return $productResult;

    }

    /*
     * @param $productId
     * @return array|mixed|null
     */
    public function getIsShippingClass($productId){
        $collection =$this->collectionFactory->create();
        $collection->getSelect()->where('product_id=?',$productId);
        return $collection->getFirstItem()->getShippingClass();
    }


}
