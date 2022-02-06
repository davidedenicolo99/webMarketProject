
<!-- Qui mostro il form per inserire i dati ed effettuare il pagamento. -->
<div class="container">
    <div class="row">
        
        <div class="col-12 mt-4">
            <div class="card p-3">
                <p class="mb-0 fw-bold h4">Payment Methods</p>
            </div>
        </div>
        <div class="col-12">
            <div class="card p-3">
                
                <div class="card-body  p-0">
                    <p> <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample"> <span class="fw-bold">Credit Card</span> <span class=""> <span class="fab fa-cc-amex"></span> <span class="fab fa-cc-mastercard"></span> <span class="fab fa-cc-discover"></span> </span> </a> </p>
                    <div class="collapse show p-3 pt-0" id="collapseExample">
                        <div class="row">
                            <div class="col-lg-5 mb-lg-0 mb-3">
                                <p class="h4 mb-0">Summary</p>
                                <p class="mb-0"> <span class="fw-bold">Price:</span> <span class="c-green">:$<?php echo $_GET['total']?></span> </p>
                                <p class="mb-0">Paga</p>
                                <p>
                                <?php 
                                    foreach ($_SESSION['cart'] as $key => $value){
                                        if(isset($value["product_id"])){
                                            echo "Prodotto: ".$_SESSION['cart'][$key]["product_id"]."\n"."Quantita: ".$_SESSION['cart'][$key]["quantity"]."<br>";
                                        }
                                    }
                                ?>
                                </p>
                            </div>
                            <div class="col-lg-7">
                                <form action="" class="form">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form__div"> <input type="text" class="form-control" placeholder=" "> <label for="" class="form__label">Card Number</label> </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form__div"> <input type="text" class="form-control" placeholder=" "> <label for="" class="form__label">MM / yy</label> </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form__div"> <input type="password" class="form-control" placeholder=" "> <label for="" class="form__label">cvv code</label> </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form__div"> <input type="text" class="form-control" placeholder=" "> <label for="" class="form__label">name on the card</label> </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="btn btn-primary w-100">Sumbit</div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class=""> <button type="submit" class="btn btn-primary payment my-2"> <a href="./do-pay.php?total=<?php echo $_GET["total"] ?>" class="nav-link text-white">Make Payment</a> </button> </div>
        </div>
    </div>
</div>