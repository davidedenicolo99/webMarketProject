        <!-- Stampo la home page con tutti i prodotti -->
        <?php if(isset($parameters["title"])): ?>
        <h2><?php echo $parameters["title"]; ?></h2>
        <?php endif;?>
        
        
        <div class="container-fluid">
            <div class="row">
        <?php foreach($parameters["prodotti"] as $prodotto): ?>
            <div class="col-md-6 col-12">
                <article>
                    <header>
                        <div>
                            <img alt="" src="<?php echo UPLOAD_DIR.$prodotto["product_image"]; ?>" />
                        </div>
                        <h2><?php echo $prodotto["product_name"].": ".$prodotto["product_price"]."$"; ?>  </h2>
                        <p><?php echo $prodotto["nome"]; ?></p>
                    </header>
                    <section>
                        <p><?php echo $prodotto["descformula"]; ?></p>
                    </section>
                    <footer>

                    
                    <form action="cart.php" method="POST">
                    
                        <button type="submit" class="btn btn-warning my-3" name="add">Aggiungi al carrello</button>
                        
                        <label for="product_id"></label>
                        <input type='hidden' name='product_id' value='<?php echo $prodotto["product_id"]; ?>'><p>
                        
                        <label for="quantity">Quantita: </label>
                        <input type='number' class="btn  p-0" name='quantity' max='$maxQnt' value="$productQnt" min="1" max="20"></p>
                    
                        <div><a href="prodotto.php?id=<?php echo $prodotto["product_id"]; ?>" class="btn ">Leggi tutto</a></div>
                    </form>
                    

                    
                    </footer>
                </article>
            </div>
        <?php endforeach; ?>
            </div>
        </div>