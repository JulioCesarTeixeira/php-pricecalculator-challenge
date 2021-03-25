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
        $customerName = 'Buyer: ';
        $productName = 'Buying: ';
        $productPrice = 'Full Price: ';
        $finalPrice = 'Discount Price: ';


        if (!empty($_SESSION['customer']) && !empty($_SESSION['product'])) {
            $customer = Customer::LoadCustomer($this->db, (int)$_SESSION['customer']);
            $product = Product::LoadProduct($this->db, (int)$_SESSION['product']);

            $groupDiscount = new GroupDiscount($this->db, $customer->getGroupID());

            $customerName .= $customer->getFullName();
            $productName .= $product->getName();
            $productPrice .= $product->getPrice();
            $finalPrice .= BestPrice::CalcFinalPrice($customer, $product, $groupDiscount);

            unset($_SESSION['customer'], $_SESSION['product']);
        }

        $customers = CustomerLoader::getAllCustomers($this->db);
        $products = ProductLoader::getAllProducts($this->db);
        //load the view
        require 'View/view.php';
    }
}