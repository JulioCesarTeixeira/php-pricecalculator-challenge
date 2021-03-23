<?php
declare(strict_types=1);

//$customer = Customer::LoadCustomer();

class Customer
{
    private string $firstname;
    private string $lastname;
    private int $groupID;
    private ?int $fixedDiscount;
    private ?int $variableDiscount;
    private ?int $id = null;


    public function __construct(string $firstname, string $lastname, int $groupID, ?int $fixedDiscount, ?int $variableDiscount)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->groupID = $groupID;
        $this->fixedDiscount = $fixedDiscount;
        $this->variableDiscount = $variableDiscount;
    }

    public static function LoadCustomer(int $id, string $firstname, string $lastname, int $groupID, ?int $fixedDiscount, ?int $variableDiscount) : customer
    {
        $customer = new Customer ($firstname, $lastname, $groupID, $fixedDiscount, $variableDiscount);
        $customer->id = $id;
        return $customer;
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
    public function getFixedDiscount(): int
    {
        return $this->fixedDiscount;
    }

    /**
     * @return int
     */
    public function getVariableDiscount(): int
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