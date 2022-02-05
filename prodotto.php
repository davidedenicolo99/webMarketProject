<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "E-commerce - prodotto";
$templateParams["nome"] = "singolo-prodotto.php";
$templateParams["categorie"] = $dbh->getCategories();

//Home Template
$product_id = -1;
if(isset($_GET["id"])){
    $product_id = $_GET["id"];
}
$templateParams["prodotto"] = $dbh->getPostById($product_id);

require 'template/base.php';
?>