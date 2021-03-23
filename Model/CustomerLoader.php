<?php


class CustomerLoader
{
    public static function getAllCustomers(PDO $pdo) : array
    {
        $handle = $pdo->prepare('SELECT * FROM customer');
        $arrayCustomers = $handle->fetchAll();

        $customers = [];
        foreach ($arrayCustomers AS ['id' => $id, 'firstname' => $firstname,'lastname' => $lastname, 'group_id' => $groupID, 'fixed_discount' => $fixedDiscount, 'variable_discount' => $variableDiscount]) {
            $customers[] = Customer::LoadCustomer(
                $id,
                $firstname,
                $lastname,
                $groupID,
                $fixedDiscount,
                $variableDiscount
            );
        }
        return $customers;
    }
}