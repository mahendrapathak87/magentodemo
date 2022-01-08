<?php

namespace Extn\CustomRepo\Controller\Index;

use Extn\CustomRepo\Api\CustomerAuthRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\PageFactory;

use Extn\CustomRepo\Model\CustomerAuthRepository;
use Extn\CustomRepo\Api\Data\CustomerAuthInterface;
class Index extends Action
{
    protected $_pageFactory;

    protected $_customerAuthRepository;
    protected $_customerAuthModel;


    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CustomerAuthRepositoryInterface $customerAuthRepository,
        CustomerAuthInterface $CustomerAuthInterface
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_customerAuthRepository=$customerAuthRepository;
        $this->_customerAuthModel = $CustomerAuthInterface;
        return parent::__construct($context);
    }

    public function execute()
    {
        //Create a record.
        $this->_customerAuthModel->setTitle("Title");
        //$this->$_customerAuthModel->setDescriptions("Description");

        try {
            $this->_customerAuthRepository->save($this->_customerAuthModel);
        } catch (CouldNotSaveException $e) {
            echo $e->getMessage();
        }
        //Read a record
        try {
            $custAuth = $this->_customerAuthRepository->getById("3");
            echo "Car id = " . $custAuth->getId() . "<br>";
            echo "Car Title = " . $custAuth->getTitle();
        } catch (NoSuchEntityException $e) {
            echo "No such entity exception - " . $e->getMessage();
        } catch (LocalizedException $e) {
            echo "Localized Exception" . $e->getMessage();
        }
        //Update a record
        try {
            $custAuth = $this->_customerAuthRepository->getById("1");
            echo "Car id = " . $custAuth->getId() . "<br>";
            echo "Car Title = " . $custAuth->getTitle();
            $custAuth->setTitle("This is the updated title");

            $this->_customerAuthRepository->save($custAuth);
        } catch (NoSuchEntityException $e) {
            echo "No such entity exception - " . $e->getMessage();
        } catch (LocalizedException $e) {
            echo "Localized Exception" . $e->getMessage();
        }
        //Delete a record
        try {
            $this->_customerAuthRepository->deleteById("2");
            echo "Deleted the record with id = 20" . "<br>" . "Go to database and check.";
        } catch (NoSuchEntityException $e) {
            echo "No such entity exception - " . $e->getMessage();
        } catch (LocalizedException $e) {
            echo "Localized Exception" . $e->getMessage();
        }
        exit;
    }
}
