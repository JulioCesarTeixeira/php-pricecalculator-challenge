<?php
declare(strict_types=1);

use JetBrains\PhpStorm\NoReturn;

class Controller
{
    private Connection $db;

    public function __construct()
    {
        $this->db = new Connection();
    }


    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST): void
    {

        $customerName = 'Hey there, <b>';
        $productName = 'You selected <b>';
        $productPrice = 'The normal price of your product would be: $<b> ';
        $finalPrice = 'With our Price is Right you only have to pay: $<b> ';
        $bulkDiscount = 'However, if you cannot get enough of it and wish to purchase the product in bulk, the price per unity would be: $ <b>';


        if (!empty($_SESSION['customer']) && !empty($_SESSION['product'])) {
            $customer = Customer::LoadCustomer($this->db, (int)$_SESSION['customer']);
            $product = Product::LoadProduct($this->db, (int)$_SESSION['product']);

            $groupDiscount = new GroupDiscount($this->db, $customer->getGroupID());

            $customerName .= $customer->getFullName();
            $productName .= $product->getName();
            $productPrice .= $product->getPrice();
            $finalPrice .= BestPrice::CalcFinalPrice($customer, $product, $groupDiscount);
            $bulkDiscount .= number_format(BestPrice::CalcFinalPrice($customer, $product, $groupDiscount) * (0.9), 2);

        }

        $customers = CustomerLoader::getAllCustomers($this->db);
        $products = ProductLoader::getAllProducts($this->db);

//        foreach($products as $product) {
//            $category = "Julios choice";
//            $handle = $this->db->query("UPDATE product SET category ='$category' WHERE id < 30 ");
//            $handle->execute();
//        }

        //query to add Emails and passwords to all users
//        foreach ($customers as $customer) {
//            $email = $customer->getFirstName() . '@' . $customer->getFirstName() . '.be';
//            $id = $customer->getId();
//            $password = password_hash('1234', PASSWORD_DEFAULT);
//
//            $handle = $this->db->query("UPDATE customer c SET c.email = '$email', c.password = '$password' WHERE c.id = '$id'");
//            $handle->execute();
//        }
        //load the view
        require 'View/view.php';
    }

    public function login(array $GET, array $POST): void
    {

        if (!empty($_POST['email']) && !empty($_POST['password'])) {

            $_SESSION['login'] = Customer::CheckCustomerLogin($this->db, $_POST['email'], $_POST['password']);

            header("Location:index.php");
            exit;


        }

        require 'View/login.php';
    }

    #[NoReturn] public function logout(array $GET, array $POST): void
    {

        session_destroy();
        header("location:index.php");
        exit;

    }


}
