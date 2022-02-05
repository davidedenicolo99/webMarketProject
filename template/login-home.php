        <section>
            <h2>prodotti</h2>
            <?php if(isset($templateParams["formmsg"])):?>
            <p><?php echo $templateParams["formmsg"]; ?></p>
            <?php endif; ?>
            <?php if($_SESSION["privilege"] == 1){
                echo "<a href=\"gestisci-prodotti.php?action=1\" class=\"nav-link btn\">Inserisci prodotto</a> ?>";
            } ?>
            <table>
                <tr>
                    <th>Titolo</th><th>Immagine</th><th>Azione</th>
                </tr>
                <?php foreach($templateParams["prodotti"] as $prodotto): ?>
                <tr>
                    <td><?php echo $prodotto["product_name"]; ?></td>
                    <td><img alt="" src="<?php echo UPLOAD_DIR.$prodotto["product_image"]; ?>" /></td>
                    <td>
                        <a href="gestisci-prodotti.php?action=2&id=<?php echo $prodotto["product_id"]; ?>">Modifica</a>
                        <a href="gestisci-prodotti.php?action=3&id=<?php echo $prodotto["product_id"]; ?>">Cancella</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>

            <form action="./processa-utente.php" method="post">
                <label for="logout"></label>
                <input value="Logout" type="submit" name="logout" class="btn-warning my-4">
            </form>

        </section>