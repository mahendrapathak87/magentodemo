<?php
namespace Extn\CustomRepo\Api;
use Extn\CustomRepo\Api\Data\CustomerAuthInterface;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;
/**
 * Interface CustomerAuthRepositoryInterface
 *
 * @api
 */
interface CustomerAuthRepositoryInterface
{

    /**
     * Create or update a customerauth.
     *
     * @param CustomerAuthInterface $car
     * @return CustomerAuthInterface
     */
    public function save(CustomerAuthInterface $car);

    /**
     * Get a customerauth by Id
     *
     * @param int $id
     * @return CustomerAuthInterface
     * @throws NoSuchEntityException If customerauth with the specified ID does not exist.
     * @throws LocalizedException
     */
    public function getById($id);

    /**
     * Retrieve customerauth which match a specified criteria.
     *
     * @param SearchCriteriaInterface $criteria
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * Delete a customerauth
     *
     * @param CustomerAuthInterface $customerAuth
     * @return CustomerAuthInterface
     * @throws NoSuchEntityException If customerauth with the specified ID does not exist.
     * @throws LocalizedException
     */
    public function delete(CustomerAuthInterface $customerAuth);

    /**
     * Delete a customerauth by Id
     *
     * @param int $id
     * @return CustomerAuthInterface
     * @throws NoSuchEntityException If customerauth with the specified ID does not exist.
     * @throws LocalizedException
     */
    public function deleteById($id);

}
