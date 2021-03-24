<?php
declare(strict_types=1);

//$customer = Customer::LoadCustomer();

use JetBrains\PhpStorm\Pure;

class Customer
{
    private string $firstname;
    private string $lastname;
    private int $groupID;
    private ?int $fixedDiscount = null;
    private ?int $variableDiscount = null;
    private ?int $id = null;


    public function __construct(string $firstname, string $lastname, int $groupID, ?int $fixedDiscount, ?int $variableDiscount)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->groupID = $groupID;
        $this->fixedDiscount = $fixedDiscount;
        $this->variableDiscount = $variableDiscount;
    }

    public static function LoadCustomer(PDO $PDO, int $id) : customer
    {
        $handle = $PDO->prepare('SELECT * FROM customer_group.customer WHERE id = :id');
        $handle->bindValue('id', $id);
        $handle->execute();
        $rawData = $handle->fetch();
        return new Customer (
            $rawData['firstname'],
            $rawData['lastname'],
            (int)$rawData['group_id'],
            (int)$rawData['fixed_discount'],
            (int)$rawData['variable_discount']);
    }


    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return int
     */
    public function getGroupID(): int
    {
        return $this->groupID;
    }

    /**
     * @return int
     */
    public function getFixedDiscount(): ?int
    {
        return $this->fixedDiscount;
    }

    /**
     * @return int
     */
    public function getVariableDiscount(): ?int
    {
        return $this->variableDiscount;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }



}