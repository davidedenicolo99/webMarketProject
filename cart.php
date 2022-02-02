<?php

/**
 * Gestione del carrello.
 */

require_once 'bootstrap.php';

/**
 * Se clicco aggiungi al carrello di un prodotto viene mandata una richiesta post.
 * Questa richiesta viene gestita qua.
 * Se sono loggato ALLORA posso aggiungere al carrelo, altrimenti no.
 * In caso sia GIA nel carrello lo notifico all'utente e non potra aggiungerlo.
 * In caso possa aggiungere un prodotto creo la relativa variabile Session.
 */
if (isset($_POST['add'])){
    if(isset($_SESSION["username"])){

    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id", "quantity");

        if(in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'index.php'</script>";
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id'],
                'quantity' => $_POST['quantity']
            );

            $_SESSION['cart'][$count] = $item_array;
        }
    }else{

        $item_array = array(
                'product_id' => $_POST['product_id'],
                'quantity' => $_POST['quantity']
                
        );

        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
    }else{
        $parameters["msg"] = "Devi registrarti per comprare";
    }
}
/**
 * Se clicco Remove dal carrello allora lo tolgo.
 */
if (isset($_POST['remove'])){
    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if($value["product_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }
  } 
  /**
   * In caso voglio incrementare la quantita allora aggiungo la quantita di quell'elemento
   * nella variabile session.
   * Se aggiungo piu elementi di quelli che sono disponibili nel db lo blocco.
   */
  if (isset($_POST['sum'])){
    if ($_GET['action'] == 'remove'){
        $result = $dbh->getQuantityById($_GET['id']);
        foreach ($_SESSION['cart'] as $key => $value){
            if(isset($value["product_id"]) && $value["product_id"] == $_GET['id']){
                      if($_SESSION['cart'][$key]["quantity"] < $result[0]["quantity"]) { 
                          $_SESSION['cart'][$key]["quantity"]++;
                          $qnt = $_SESSION['cart'][$key]["quantity"];
                          $_SESSION['cart'][$key]["quantity"] = $qnt;
                }
            }
        }
    }
  }
  /**
   * In caso voglio decrementare la quantita allora tolgo la quantita di quell'elemento
   * nella variabile session.
   * Se tolgo meno elementi di 0 lo blocco.
   */
  if (isset($_POST['dec'])){
      if ($_GET['action'] == 'remove'){
          foreach ($_SESSION['cart'] as $key => $value){
              if(isset($value["product_id"]) && $value["product_id"] == $_GET['id']){
                        if($_SESSION['cart'][$key]["quantity"] > 0) { 
                            $_SESSION['cart'][$key]["quantity"]--;
                            $qnt = $_SESSION['cart'][$key]["quantity"];
                            $_SESSION['cart'][$key]["quantity"] = $qnt;
                  }
              }
          }
      }
    }


$parameters["titolo"] = "E-commerce - Cart";
$parameters["nome"] = "carrello.php";
$parameters["categorie"] = $dbh->getCategories();
require 'template/base.php';


?>