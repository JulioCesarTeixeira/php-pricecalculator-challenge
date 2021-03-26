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

        $customerName = '';
        $productName = '';
        $productPrice = '';
        $finalPrice = '';
        $bulkDiscount = '';


        if (!empty($_SESSION['customer']) && !empty($_SESSION['product'])) {
            $customer = Customer::LoadCustomer($this->db, (int)$_SESSION['customer']);
            $product = Product::LoadProduct($this->db, (int)$_SESSION['product']);

            $groupDiscount = new GroupDiscount($this->db, $customer->getGroupID());

            $customerName = $customer->getFullName();
            $productName = $product->getName();
            $productPrice = $product->getPrice();
            $finalPrice = BestPrice::CalcFinalPrice($customer, $product, $groupDiscount);
            $bulkDiscount = number_format(BestPrice::CalcFinalPrice($customer, $product, $groupDiscount) * (0.9), 2);

//            unset($_SESSION['customer'], $_SESSION['product']);
        }



        $customers = CustomerLoader::getAllCustomers($this->db);
        $products = ProductLoader::getAllProducts($this->db);
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
        header("Location:index.php");
        exit;
    }


}
