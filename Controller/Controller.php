<?php
declare(strict_types = 1);

class Controller
{
    private Connection $db;

    public function __construct() {
        $this->db = new Connection();
    }

    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST): void
    {

        $productName = '';
        $productPrice = '';
        $finalPrice = '';
        $customer = 'none';

        if (isset($_POST['customer']) && !empty($_POST['customer']) ){
            $customer = Customer::LoadCustomer($this->db, (int) $_POST['customer']);
            $product = Product::LoadProduct($this->db, (int) $_POST['product']);

            $groupDiscount = new GroupDiscount($this->db, $customer->getGroupID());

            $productName = $product->getName();
            $productPrice = $product->getPrice();
            $finalPrice = BestPrice::CalcFinalPrice($customer,$product,$groupDiscount);
        }

        $customers = CustomerLoader::getAllCustomers($this->db);
        $products = ProductLoader::getAllProducts($this->db);
        //load the view
        require 'View/view.php';
    }
}