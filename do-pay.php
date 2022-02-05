<?php

require_once 'bootstrap.php';

/**
 * Qui viene gestito il pagamento una volta cliccato su Make payment.
 * Se la quantita in stock è minore della quantita allora lo blocco, altrimenti no.
 * Svuoto il carrello una volta effettuato il pagamento.
 */

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
            $price = $dbh->getPriceById($value["product_id"]);
            $dbh->creaNotifica($value["product_id"], $value["quantity"],$price["product_price"]*$value["quantity"] ,"Comprato", $username);

            unset($_SESSION['cart'][$key]);
            $parameters["title"] = "E-commerce - Home";
            $parameters["nome"] = "home.php";
        } else{
            $parameters["title"] = "E-commerce - Cart";
            $parameters["nome"] = "carrello.php";
        }
    }
}


   
    $parameters["categorie"] = $dbh->getCategories();

    //Home Template
    $parameters["prodotti"] = $dbh->getPosts(5);

    require 'template/base.php';

?>