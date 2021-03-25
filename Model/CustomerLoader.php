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

    public static function updateCustomer(PDO $PDO)
    {
        $password = '1234';
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $handle = $PDO->query("UPDATE customer_group.customer c
        SET c.password = '$passwordHash', c.email = ''
        WHERE id = 2");
    }

    public static function CostumerLogin(PDO $PDO, $email, $password)
    {

        $handle = $PDO->query("SELECT * FROM customer_group.customer 
                                WHERE email = '$email'");
        $rawData = $handle->fetch();
        return password_verify($password, $rawData['password']);

    }
}