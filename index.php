<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

//include all your model files here
require 'config.php';
require 'Model/Connection.php';
require 'Model/Customer.php';
require 'Model/GroupDiscount.php';
require 'Model/Product.php';
require 'Model/BestPrice.php';
require 'Model/CustomerLoader.php';
require 'Model/ProductLoader.php';

//include all your controllers here
require 'Controller/Controller.php';

//you could write a simple IF here based on some $_GET or $_POST vars, to choose your controller
//this file should never be more than 20 lines of code!

if (!empty($_POST['customer']) && !empty($_POST['product']) ){
    $_SESSION['customer'] = $_POST['customer'];
    $_SESSION['product'] = $_POST['product'];

    header("Location:index.php");
    exit;
}


$controller = new Controller();



$controller->render($_GET, $_POST);