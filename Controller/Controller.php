<?php
declare(strict_types = 1);

class Controller
{
    private Connection $db;

    public function __construct() {
        $this->db = new Connection();
    }

    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        $customers = CustomerLoader::getAllCustomers($this->db);
        $products = ProductLoader::getAllProducts($this->db);
        //load the view
        require 'View/view.php';
    }
}