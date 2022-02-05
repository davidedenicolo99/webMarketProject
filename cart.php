<?php

require_once 'bootstrap.php';

if (isset($_POST['add'])){
    /// print_r($_POST['product_id']);
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

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}
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


//Base Template
$templateParams["titolo"] = "E-commerce - Cart";
$templateParams["nome"] = "carrello.php";
$templateParams["categorie"] = $dbh->getCategories();
require 'template/base.php';


?>