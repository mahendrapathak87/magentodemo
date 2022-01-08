<?php

namespace Extn\CustomRepo\Model;

use Extn\CustomRepo\Api\CustomerAuthRepositoryInterface;
use Extn\CustomRepo\Api\Data\CustomerAuthInterface;
use Extn\CustomRepo\Model\CustomerAuthModelFactory;
use Extn\CustomRepo\Model\ResourceModel\CustomerAuth;
use Extn\CustomRepo\Model\ResourceModel\CustomerAuthModel\CollectionFactory;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;


class CustomerAuthRepository implements CustomerAuthRepositoryInterface
{
    protected $authModelFactory;
    protected $customerAuth;
    protected $collectionFactory;
    protected $searchResultsInterfaceFactory;

    /**
     * @param CustomerAuthModelFactory $authModelFactory
     * @param CustomerAuth $customerAuth,
     * @param CollectionFactory $collectionFactory,
     * @param SearchResultsInterfaceFactory $searchResultsInterfaceFactory
     */
    public function __construct(
        CustomerAuthModelFactory $authModelFactory,
        CustomerAuth $customerAuth,
        CollectionFactory $collectionFactory,
        SearchResultsInterfaceFactory $searchResultInterfaceFactory
    ){
        $this->authModelFactory =$authModelFactory;
        $this->customerAuth =$customerAuth;
        $this->collectionFactory =$collectionFactory;
        $this->searchResultsInterfaceFactory =$searchResultInterfaceFactory;
    }

    /**
     * @inheritDoc
     * @throws CouldNotSaveException
     */
    public function save(CustomerAuthInterface $obj){
        try{
            $this->customerAuth->save($obj);
        }catch (\Exception $e){
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        $obj = $this->authModelFactory->create();
        $this->customerAuth->load($obj,$id);
        if(!$obj->getId()){
            throw new NoSuchEntityException(__('Object with id "%1" does not exist.',$id));
        }
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function delete(CustomerAuthInterface $object)
    {
        try {
            $this->customerAuth->delete($object);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $collection = $this->collectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $fields[] = $filter->getField();
                $conditions[] = [$condition => $filter->getValue()];
            }
            if ($fields) {
                $collection->addFieldToFilter($fields, $conditions);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $objects = [];
        foreach ($collection as $objectModel) {
            $objects[] = $objectModel;
        }
        $searchResults->setItems($objects);
        return $searchResults;
    }

}
