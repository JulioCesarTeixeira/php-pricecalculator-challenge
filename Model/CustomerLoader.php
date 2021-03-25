<?php


class CustomerLoader
{
    public static function getAllCustomers(PDO $PDO) : array
    {
        $handle = $PDO->query('SELECT * FROM customer c ORDER BY c.firstname');
        $arrayCustomers = $handle->fetchAll();

        $customers = [];
        foreach ($arrayCustomers AS ['id' => $id, 'firstname' => $firstname,'lastname' => $lastname, 'group_id' => $groupID, 'fixed_discount' => $fixedDiscount, 'variable_discount' => $variableDiscount]) {
            $customers[] = Customer::LoadCustomer(
                $PDO,
                $id
            );
        }
        return $customers;
    }
}