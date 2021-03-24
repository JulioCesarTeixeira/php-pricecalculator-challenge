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


        if (isset($_POST['customer'])){
            var_dump($_POST);
            $customer = Customer::LoadCustomer($this->db, (int)$_POST['customer']);
            $groupDiscount = new GroupDiscount($this->db, $customer->getGroupID());

            $customerVariable = $customer->getVariableDiscount();
            $customerFixed = $customer->getFixedDiscount();

            echo "Best variable group-discount: ".$groupDiscount->getGroupVarDis()."<br>";
            echo "Total fixed group-discount: ".$groupDiscount->getGroupFixDis()."<br>";
            echo "Total fixed customer-discount: ".$customerFixed. "<br>";
            echo "Total variable customer-discount: ".$customerVariable . "<br>";

        }




        $customers = CustomerLoader::getAllCustomers($this->db);
        $products = ProductLoader::getAllProducts($this->db);
        //load the view
        require 'View/view.php';
    }
}