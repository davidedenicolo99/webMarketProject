<?php
require_once 'bootstrap.php';

    /**
     * File che gestisce le richieste post e che registra effettivamente l'utente aggiungendolo
     * al db.
     * Errore in caso la registrazione sia riuscita.
     */

    if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"]) ){
       
        $result = $dbh->registerUser($_POST["username"],$_POST["password"],$_POST["name"]);
        $parameters["titolo"] = "E-commerce - Login";
        $parameters["nome"] = "login-form.php";
        if($result == 1){
            $parameters["msg"] = "Registrazione non andata buon fine";
        } else{
            $parameters["msg"] = "Registrazione andata buon fine";
        }
        
        
    }else{
        $parameters["titolo"] = "E-commerce - Register";
        $parameters["nome"] = "register-form.php";
        $parameters["msg"] = "Inserire dati";
    }

    
    $parameters["categorie"] = $dbh->getCategories();

    require 'template/base.php';
?>