<?php
require_once 'bootstrap.php';

/**
 * 
 */
if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if(count($login_result)==0){
        //Login fallito
        $parameters["errorelogin"] = "Errore! Controllare username o password!";
    }
    else{
        registerLoggedUser($login_result[0]);
    }
}
/**
 * In caso l'utente sia loggato ho due opzioni. O è admin o no.
 * Se è admin mostro la pagina di amministrazione admin, altrimenti mostro 
 * la gestione delle credenziali @see ./template/user-home.php .
 * 
 * Gli altri controlli servono per gestire in uno stesso file le richieste POST e 
 * la variabile SESSION in caso sia già istanziata.
 */
if(isUserLoggedIn()){
    if($_SESSION["privilege"] == 1){
        $parameters["titolo"] = "E-commerce - Admin";
        $parameters["nome"] = "login-home.php";
        $parameters["prodotti"] = $dbh->getPostByAuthorId($_SESSION["idautore"]);
        if(isset($_GET["formmsg"])){
            $parameters["formmsg"] = $_GET["formmsg"];
        }
    }else{
        if(isset($_POST["username"]) && isset($_POST["password"]) && $_POST["username"] == $_SESSION["username"]){
            $parameters["titolo"] = "E-commerce - User";
            $parameters["nome"] = "user-home.php";
            $parameters["login"] = $dbh->checkLogin($_POST["username"],$_POST["password"]);
            
        } else{
            if(isUserLoggedIn()){
                $parameters["titolo"] = "E-commerce - User";
                $parameters["nome"] = "user-home.php";
                $parameters["login"] = $dbh->checkLogin($_SESSION["username"],$_SESSION["password"]);
            }else{
                $parameters["titolo"] = "E-commerce - Login";
                $parameters["nome"] = "login-form.php";
            }
            
        }
    }
}
else{
    
    $parameters["titolo"] = "E-commerce - Login";
    $parameters["nome"] = "login-form.php";
}
$parameters["categorie"] = $dbh->getCategories();

require 'template/base.php';
?>