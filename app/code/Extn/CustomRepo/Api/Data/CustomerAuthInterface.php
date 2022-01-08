<?php
namespace Extn\CustomRepo\Api\Data;

/*
 * Interface CustomerAuthInterface
 */
interface CustomerAuthInterface
{
    /*
     * @return int
     */
    public function getId();

    /*
     * int $id
     * return $this
     */
    public function setId($id);

    /*
     * @return string
     */
    public function getTitle();

    /*
     * String $title
     * return $this
     */
    public function setTitle($title);

    /*
     * @return string
     */
    public function getPhone();

    /*
     * String $phone
     * return $this
     */
    public function setPhone($phone);

    /*
     * @return string
     */
    public function getEmail();

    /*
     * string $email
     * return $this
     */
    public function setEmail($email);

    /*
     * @return string
     */
    public function getApprovedby();

    /*
     * string $approvedBy
     * return $this
     */
    public function setApprovedby($approvedBy);

}
