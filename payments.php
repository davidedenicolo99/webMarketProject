<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php 
    require_once 'bootstrap.php';
    
    $flag = 1;

    /**
     * Qui gestisco il CLICK nel pulsante BUY.
     * Se NON ho elementi nel carrello NON compro e mostro il carrello.
     * Altrimenti mi renderizza alla pagina di pagamento.
     */

    foreach ($_SESSION['cart'] as $key => $value){
        if(intval($_SESSION["cart"][$key]["quantity"]) == 0){
            $flag = 0;
        }
    }


    if(isset($_SESSION["cart"]) && $_GET["total"] != 0 && $flag){
            $parameters["titolo"] = "E-commerce - Pay";
            $parameters["nome"] = "pay-home.php";
    }else{
            $parameters["titolo"] = "E-commerce - Cart";
            $parameters["nome"] = "carrello.php";
        }
    
    
    
    $parameters["categorie"] = $dbh->getCategories();
    require 'template/base.php';

?>
