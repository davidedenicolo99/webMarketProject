<?php
require_once 'bootstrap.php';

/**
 * Qui gestisco la mostra di un singolo prodotto nella home tramite una richiesta get.
 * La richiesta prende un id e con quell'id interrogo il database che mi ritorna il post
 * con quell'id.
 */
$parameters["titolo"] = "E-commerce - prodotto";
$parameters["nome"] = "singolo-prodotto.php";
$parameters["categorie"] = $dbh->getCategories();


$product_id = -1;
if(isset($_GET["id"])){
    $product_id = $_GET["id"];
}
$parameters["prodotto"] = $dbh->getPostById($product_id);

require 'template/base.php';
?>