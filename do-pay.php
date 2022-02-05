<?php

require_once 'bootstrap.php';


foreach ($_SESSION['cart'] as $key => $value){
    if(isset($value["product_id"])){ 
        $quantityInStock = $dbh->getQuantityById($value["product_id"]);

        
        if($quantityInStock[0]["quantity"] > $value["quantity"]){
            $dbh->removeQnt($value["product_id"], $value["quantity"]);
            if(isset($_SESSION["username"])){
                $username = $_SESSION["username"];
            } else{
                $username = "";
            }
            
            $dbh->creaNotifica($value["product_id"], $value["quantity"],$_GET["total"] ,"Comprato", $username);

            unset($_SESSION['cart'][$key]);
            $templateParams["titolo"] = "E-commerce - Home";
            $templateParams["nome"] = "home.php";
        } else{
            $templateParams["titolo"] = "E-commerce - Cart";
            $templateParams["nome"] = "carrello.php";
        }
    }
}


   
    $templateParams["categorie"] = $dbh->getCategories();

    //Home Template
    $templateParams["prodotti"] = $dbh->getPosts(5);

    require 'template/base.php';

?>