<?php
require_once 'bootstrap.php';

    /**
     * File che gestisce le richieste post e che registra effettivamente l'utente aggiungendolo
     * al db.
     * Errore in caso la registrazione sia riuscita.
     */

    if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["choice"]) ){
        if($_POST["choice"] == "Si"){
            $admin = 1;
       } else{
            $admin = 0;
       }
        $result = $dbh->registerUser($_POST["username"],$_POST["password"],$_POST["name"], $admin);
        $parameters["title"] = "E-commerce - Login";
        $parameters["nome"] = "login-form.php";
        if($result == 1){
            $parameters["msg"] = "Registrazione non andata a buon fine";
            $parameters["nome"] = "register-form.php";
        } else{   
            header("location: login.php");
        }
    }else{
        $parameters["title"] = "E-commerce - Register";
        $parameters["nome"] = "register-form.php";
        $parameters["msg"] = "Inserire dati";
    }

    
    $parameters["categorie"] = $dbh->getCategories();

    require 'template/base.php';
?>