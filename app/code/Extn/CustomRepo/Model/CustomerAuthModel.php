<?php
namespace Extn\CustomRepo\Model;

use Extn\CustomRepo\Api\Data\CustomerAuthInterface;
use Magento\Framework\Model\AbstractModel;
use Extn\CustomRepo\Model\ResourceModel\CustomerAuth;
class CustomerAuthModel extends AbstractModel implements CustomerAuthInterface
{

    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(CustomerAuth::class);
    }

    /**
     * @inheirtDoc
     */
    public function getId(){
        return $this->getData('id');
    }

    /**
     * @param $id
     * @return CustomerAuthModel|void
     */
    public function setId($id){
        return $this->setData('id', $id);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getData('title');
    }

    /**
     * @param $title
     * @return void
     */
    public function setTitle($title)
    {
        return $this->setData('title', $title);
    }

    /**
     * @return string
     */
    public function getPhone(){
        return $this->getData('phone');
    }

    /**
     * @param $phone
     * @return void
     */
    public function setPhone($phone)
    {
        return $this->setData('phone', $phone);
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->getData('email');
    }

    /**
     * @param $email
     * @return void
     */
    public function setEmail($email)
    {
        return $this->setData('email', $email);
    }

    /**
     * @return string
     */
    public function getApprovedby()
    {
        return $this->getData('title');
    }

    /**
     * @param $approvedBy
     * @return void
     */
    public function setApprovedby($approvedBy)
    {
        return $this->setData('approvedby', $approvedBy);
    }

}
