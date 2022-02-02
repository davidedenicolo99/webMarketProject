<?php
require_once 'bootstrap.php';

/**
 * Questo file mi permette di mostrare tutti e soli gli articoli con una determinata
 * categoria.
 * L'associazione post-categoria è nel db.
 */

$parameters["titolo"] = "E-commerce - prodotti Categoria";
$parameters["nome"] = "home.php";
$parameters["categorie"] = $dbh->getCategories();


$idcategoria = -1;
if(isset($_GET["id"])){
    $idcategoria = $_GET["id"];
}
$nomecategoria = $dbh->getCategoryById($idcategoria);
if(count($nomecategoria)>0){
    $parameters["titolo_pagina"] = "Categoria: ".$nomecategoria[0]["nomecategoria"];
    $parameters["prodotti"] = $dbh->getPostByCategory($idcategoria);
}
else{
    $parameters["titolo_pagina"] = "Categoria non trovata"; 
    $parameters["prodotti"] = array();   
}

require 'template/base.php';
?>