<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "E-commerce - prodotti Categoria";
$templateParams["nome"] = "home.php";
$templateParams["categorie"] = $dbh->getCategories();

//prodotti Categoria Template
$idcategoria = -1;
if(isset($_GET["id"])){
    $idcategoria = $_GET["id"];
}
$nomecategoria = $dbh->getCategoryById($idcategoria);
if(count($nomecategoria)>0){
    $templateParams["titolo_pagina"] = "Categoria: ".$nomecategoria[0]["nomecategoria"];
    $templateParams["prodotti"] = $dbh->getPostByCategory($idcategoria);
}
else{
    $templateParams["titolo_pagina"] = "Categoria non trovata"; 
    $templateParams["prodotti"] = array();   
}

require 'template/base.php';
?>