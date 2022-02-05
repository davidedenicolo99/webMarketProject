        <!-- Pagina che mostra un solo prodotto nella homepage -->
        <?php if(count($parameters["prodotto"])==0): ?>
        <article>
            <p>prodotto non presente</p>
        </article>
        <?php 
            else:
                $prodotto = $parameters["prodotto"][0];
        ?>
        <article>
            <header>
                <div>
                    <img alt="" src="<?php echo UPLOAD_DIR.$prodotto["product_image"]; ?>" />
                </div>
                <h2><?php echo $prodotto["product_name"]; ?></h2>
                <p><?php echo $prodotto["nome"]; ?></p>
            </header>
            <section>
                <p><?php echo $prodotto["desccompletaformula"]; ?></p>
                <h3>Prezzo: <?php echo $prodotto["product_price"]; ?>$</h3>
                
            </section>
        </article>
        <?php endif; ?>