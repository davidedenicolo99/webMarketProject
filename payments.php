<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php 
    require_once 'bootstrap.php';
    
    
    if(isset($_SESSION["cart"]) && $_GET["total"] != 0){
            $templateParams["titolo"] = "E-commerce - Pay";
            $templateParams["nome"] = "pay-home.php";
    }else{
            $templateParams["titolo"] = "E-commerce - Cart";
            $templateParams["nome"] = "cart.php";
        }
    
    
    
    $templateParams["categorie"] = $dbh->getCategories();
    require 'template/base.php';

?>
