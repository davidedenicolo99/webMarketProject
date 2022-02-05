<?php
require_once 'bootstrap.php';


if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if(count($login_result)==0){
        //Login fallito
        $templateParams["errorelogin"] = "Errore! Controllare username o password!";
    }
    else{
        registerLoggedUser($login_result[0]);
    }
}
if(isUserLoggedIn()){
    if($_SESSION["privilege"] == 1){
        $templateParams["titolo"] = "E-commerce - Admin";
        $templateParams["nome"] = "login-home.php";
        $templateParams["prodotti"] = $dbh->getPostByAuthorId($_SESSION["idautore"]);
        if(isset($_GET["formmsg"])){
            $templateParams["formmsg"] = $_GET["formmsg"];
        }
    }else{
        if(isset($_POST["username"]) && isset($_POST["password"]) && $_POST["username"] == $_SESSION["username"]){
            $templateParams["titolo"] = "E-commerce - User";
            $templateParams["nome"] = "user-home.php";
            $templateParams["login"] = $dbh->checkLogin($_POST["username"],$_POST["password"]);
            
        } else{
            if(isUserLoggedIn()){
                $templateParams["titolo"] = "E-commerce - User";
                $templateParams["nome"] = "user-home.php";
                $templateParams["login"] = $dbh->checkLogin($_SESSION["username"],$_SESSION["password"]);
            }else{
                $templateParams["titolo"] = "E-commerce - Login";
                $templateParams["nome"] = "login-form.php";
            }
            
        }
    }
}
else{
    
    $templateParams["titolo"] = "E-commerce - Login";
    $templateParams["nome"] = "login-form.php";
}
$templateParams["categorie"] = $dbh->getCategories();

require 'template/base.php';
?>