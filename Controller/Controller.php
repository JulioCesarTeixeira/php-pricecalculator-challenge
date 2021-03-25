<?php
declare(strict_types=1);

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
            $bulkDiscount .= number_format(BestPrice::CalcFinalPrice($customer, $product, $groupDiscount) * (0.9),2);

//            unset($_SESSION['customer'], $_SESSION['product']);
        }

        $customers = CustomerLoader::getAllCustomers($this->db);
        $products = ProductLoader::getAllProducts($this->db);
        //load the view
        require 'View/view.php';
    }
}