<?php
namespace Mspm2\Extattr\Plugin;

use Mspm2\Extattr\Model\ResourceModel\Mspm2Shippingclass\CollectionFactory;
use Magento\Catalog\Api\Data\ProductInterface;
use Mspm2\Extattr\Model\Mspm2ShippingclassFactory;

class ProductShippingClass
{
    public $collectionFactory;
    public $shipingModelFactory;
    public function __construct(
        CollectionFactory $collectionFactory,
        Mspm2ShippingclassFactory $shippingclassFactory
    ){
        $this->collectionFactory =$collectionFactory;
        $this->shipingModelFactory= $shippingclassFactory;
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

    /**
     * @param $productId
     * @return array|mixed|null
     */
    public function getIsShippingClass($productId){
        $collection =$this->collectionFactory->create();
        $collection->getSelect()->where('product_id=?',$productId);
        return $collection->getFirstItem()->getShippingClass();
    }

    public function aroundSave(
        \Magento\Catalog\Api\ProductRepositoryInterface $subject,
        callable $proceed,
        \Magento\Catalog\Api\Data\ProductInterface $product,
        $saveOptions =false
    ): ProductInterface {
        $this->saveProductShippingClass($product);
        $productResult = $proceed($product,$saveOptions);
        $mspm2ShippingClass= $this->getIsShippingClass($product->getId());
        $extensionAttributes = $productResult->getExtensionAttributes()->setMspm2ShippingClss($mspm2ShippingClass);
        $productResult->setExtensionAttributes($extensionAttributes);
        return $productResult;
    }

    public function saveProductShippingClass(ProductInterface $product){

        if($product->getExtensionAttributes() && $product->getExtensionAttributes()->getMspm2ShippingClss()){
            $shippingModel = $this->shipingModelFactory->create();
            $shippingModel->load($product->getId());
            if($shippingModel->getId()){
                $shippingModel->setShippingClass($product->getExtensionAttributes()->getMspm2ShippingClss());
                $shippingModel->save();
            }else{
                echo "no id found";
            }

        }else{

        }


    }


}
