<?php
require_once("./bootstrap.php");

$GLOBAL["price"] = 0;
$parameters["nome"] = "home.php";

?>


<!-- Qui carico dinamicamente gli elementi del carrello che sono contenuti in $_SESSION["cart"]
tramite un ciclo. All'interno del ciclo eseguo una funzione che stampa tutto html relativo agli elementi
nel carrello. -->


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    

    <p class="text-white text-uppercase font-weight-bold" ><?php 
        if(isset($parameters["msg"])){
            echo $parameters["msg"];
            unset($parameters["msg"]);
            unset($_SESSION["cart"]);
        }
        ?></p>
    <div class="border rounded mb-5 mt-5 bg-white">
                <?php

                $total = 0;
                    if (isset($_SESSION['cart'])){
                        $product_id = array_column($_SESSION['cart'], 'product_id');

                        $result = $dbh->getData();
                        while ($row = mysqli_fetch_assoc($result)){
                            foreach ($product_id as $id){
                                if ($row['product_id'] == $id){
                                    foreach ($_SESSION['cart'] as $key => $value){
                                        if(isset($value["product_id"]) && strval($value["product_id"]) == strval($id)){
                                            
                                            cartElement("upload/".$row['product_image'], $row['product_name'],$row['product_price']*intval($value["quantity"]), $row['product_id'], intval($value["quantity"]));

                                            $total = $total + (int)$row['product_price']*intval($value["quantity"]);
                                        }
                                    }
                                    
                                }
                            }
                        }
                    }else{
                        echo "<h5>Cart is Empty</h5>";
                    }

                ?>

        </div>
        
        
        <div class="col-md-4 offset-md-7 border rounded mb-5 mt-5 bg-white">

            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6>$<?php
                            echo $total;
                            ?></h6>
                    </div>
                    <div class="col-md-6">
                    <hr>    
                    <a href="payments.php?total=<?php echo $total ?>" class="mb-2 btn">BUY</a></h6>
                    </div>
                </div>
            </div>
        </div>




