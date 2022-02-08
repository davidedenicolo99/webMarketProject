        <!-- Remote style sheet -->
        <section>
            <h2>prodotti</h2>
            <?php if(isset($parameters["formmsg"])):?>
            <p><?php echo $parameters["formmsg"]; ?></p>
            <?php endif; ?>
            <?php if($_SESSION["privilege"] == 1){
                echo "<a href=\"gestisci-prodotti.php?action=1\" class=\"nav-link btn btn-info\">Inserisci prodotto</a>";
            } ?>
            <table>
                <tr>
                    <th>Titolo</th><th>Immagine</th><th>Azione</th>
                </tr>
                <?php foreach($parameters["prodotti"] as $prodotto): ?>
                <tr>
                    <td><?php echo $prodotto["product_name"]; ?></td>
                    <td><img alt="<?php echo $prodotto["product_name"]; ?>" src="<?php echo UPLOAD_DIR.$prodotto["product_image"]; ?>" /></td>
                    <td>
                        <a href="gestisci-prodotti.php?action=2&id=<?php echo $prodotto["product_id"]; ?>" class="btn">Modifica</a>
                        <a href="gestisci-prodotti.php?action=3&id=<?php echo $prodotto["product_id"]; ?>" class="btn">Cancella</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>

            <form action="./processa-utente.php" method="post">
            <fieldset>
                <label for="logout"></label>
                <input value="Logout" type="submit" name="logout" class="btn btn-danger my-4">
                <label for="change"></label>
                <input value="Change" type="submit" name="change" class="btn my-4 btn-primary">
            </fieldset>
            </form>
            

        </section>