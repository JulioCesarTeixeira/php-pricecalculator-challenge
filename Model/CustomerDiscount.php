<?php


class CustomerDiscount
{
    private ?int $customerFixDis = null;
    private ?int $customerVarDis = null;

    public function __construct(PDO $PDO, $id)
    {
        $this->calcCustomerDiscounts($PDO, $id);
    }

    private function calcCustomerDiscounts(PDO $PDO, $id): void
    {
        $query = $PDO->prepare('SELECT fixed_discount, variable_discount FROM customer_group.customer WHERE id = :id');
        $query->bindValue('id', $id);
        $query->execute();
        $rawDiscount = $query->fetch();

        $this->customerFixDis = $rawDiscount['fixed_discount'];
        $this->customerVarDis = $rawDiscount['variable_discount'];
    }

    /**
     * @return int|null
     */
    public function getCustomerFixDis(): ?int
    {
        return $this->customerFixDis;
    }

    /**
     * @return int|null
     */
    public function getCustomerVarDis(): ?int
    {
        return $this->customerVarDis;
    }




}