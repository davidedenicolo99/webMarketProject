<?php
require_once 'bootstrap.php';

/**
 * Carico la homepage e requiro base.php.
 */

$parameters["titolo"] = "E-commerce - Home";
$parameters["nome"] = "home.php";
$parameters["categorie"] = $dbh->getCategories();


$parameters["prodotti"] = $dbh->getPosts(5);

require 'template/base.php';
?>