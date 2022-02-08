
        <?php 
        /**
         * Form che puo usare solo l'admin per eliminare/modificare i prodotti sul db.
         */
            $prodotto = $parameters["prodotto"]; 
            $azione = getAction($parameters["azione"])
        ?>
        <form action="./processa-prodotto.php" method="POST" enctype="multipart/form-data">
            <fieldset>
            <h2>Gestisci Prodotto</h2>
            <?php if($prodotto==null): ?>
            <p>Prodotto non trovato</p>
            <?php else: ?>
            <ul>
                <li>
                    <label for="product_name">Titolo:</label><input type="text" id="product_name" name="product_name" value="<?php echo $prodotto["product_name"]; ?>" />
                </li>
                <li>
                    <label for="desccompletaformula">Testo Prodotto:</label><textarea id="desccompletaformula" name="desccompletaformula"><?php echo $prodotto["desccompletaformula"]; ?></textarea>
                </li>
                <li>
                    <label for="descformula">Anteprima Prodotto:</label><textarea id="descformula" name="descformula"><?php echo $prodotto["descformula"]; ?></textarea>
                </li>
                <li>
                    <label for="product_price">Costo Prodotto:</label><input type="number" id="product_price" name="product_price" min="0" value="<?php echo $prodotto["product_price"]; ?>"></input>
                </li>
                <li>
                    <label for="quantity">Quantita Prodotto:</label><input type="number" id="quantity" name="quantity" min="0" value="<?php echo $prodotto["quantity"]; ?>"></input>
                </li>
                <li>
                    <?php if($parameters["azione"]!=3): ?>
                    <label for="product_image">Immagine Prodotto</label><input type="file" name="product_image" id="product_image" />
                    <?php endif; ?>
                    <?php if($parameters["azione"]!=1): ?>
                    <img src="<?php echo UPLOAD_DIR.$prodotto["product_image"]; ?>" alt="<?php echo UPLOAD_DIR.$prodotto["product_name"]; ?>" />
                    <?php endif; ?>
                </li>
                <li>
                    <?php foreach($parameters["categorie"] as $categoria): ?>
                    <input type="checkbox" id="<?php echo $categoria["idcategoria"]; ?>" name="categoria_<?php echo $categoria["idcategoria"]; ?>" <?php 
                        if(in_array($categoria["idcategoria"], $prodotto["categorie"])){ 
                            echo ' checked="checked" '; 
                        } 
                    ?> /><label for="<?php echo $categoria["idcategoria"]; ?>"><?php echo $categoria["nomecategoria"]; ?></label>
                    <?php endforeach; ?>
                </li>
                
                <li>
                    <input type="submit" name="submit" value="<?php echo $azione; ?> Prodotto" />
                    <a href="login.php">Annulla</a>
                </li>
            </ul>
                <?php if($parameters["azione"]!=1): ?>
                <input type="hidden" name="product_id" value="<?php echo $prodotto["product_id"]; ?>" />
                <input type="hidden" name="categorie" value="<?php echo implode(",", $prodotto["categorie"]); ?>" />
                <input type="hidden" name="oldimg" value="<?php echo $prodotto["product_image"]; ?>" />
                <?php endif;?>

                <input type="hidden" name="action" value="<?php echo $parameters["azione"]; ?>" />
            <?php endif;?>
            </fieldset>
        </form>