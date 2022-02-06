<?php
require_once 'bootstrap.php';

/**
 * Carico la homepage e requiro base.php.
 */

$parameters["title"] = "E-commerce - Home";
$parameters["nome"] = "home.php";
$parameters["categorie"] = $dbh->getCategories();


$parameters["prodotti"] = $dbh->getProducts();

require 'template/base.php';
?>