<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "E-commerce - Home";
$templateParams["nome"] = "home.php";
$templateParams["categorie"] = $dbh->getCategories();

//Home Template
$templateParams["prodotti"] = $dbh->getPosts(5);

require 'template/base.php';
?>