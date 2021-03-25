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
require 'Model/Product.php';
require 'Model/GroupDiscount.php';
require 'Model/BestPrice.php';
require 'Model/CustomerLoader.php';
require 'Model/ProductLoader.php';

//include all your controllers here
require 'Controller/Controller.php';

//you could write a simple IF here based on some $_GET or $_POST vars, to choose your controller
//this file should never be more than 20 lines of code!

$controller = new Controller();

if (!empty($_POST['customer']) && !empty($_POST['product'])) {
    $_SESSION['customer'] = $_POST['customer'];
    $_SESSION['product'] = $_POST['product'];

    header("Location:index.php");
    exit;
}


if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    $controller->login($_GET, $_POST);
} elseif (!empty($_POST['logout'])) {
    $controller->logout($_GET, $_POST);
} else {
    $controller->render($_GET, $_POST);
}


