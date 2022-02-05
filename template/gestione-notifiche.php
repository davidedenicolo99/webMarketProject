<script language="JavaScript" type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>

<script language="JavaScript" type="text/javascript" src="./js/delete-notifiche.js"></script>



<!-- Stampo la lista delle notifiche precedentemente prese dal db. -->


<article>
    <header>
        <h2>
            Sezione Notifiche
        </h2>
    </header>
    <?php 
        if(isset($parameters["notifiche"])):
            foreach ($parameters["notifiche"] as $key => $value):
    ?>
    <section class="my-3">
            <?php 
                if(isset($parameters["soldout"])):
                    foreach ($parameters["soldout"] as $key1 => $value1):?>
                    <span><span>SoldOut:</span> <?php echo $value1["product_name"]?>$</span>
                    <br> <br>
            <?php unset($parameters["soldout"]); endforeach; endif; ?>

            <span><span>ID notifica:</span><?php echo $value["idnotifica"]?></span>
            <span><span>ID prodotto:</span> <?php echo $value["idProdottoComprato"]?></span>
            <span><span>Compratore:</span> <?php echo $value["userCompratore"]?></span>
            <span><span>Quantita</span> <?php echo $value["quantitaComprata"]?></span>
            <span><span>Totale:</span> <?php echo $value["prezzoTotale"]?>$</span>
            <a href="./notifiche.php" class="btn p-2 delete" id="<?php echo $value["idnotifica"]?>">X</a>
            <br>
            
    </section>
    <?php endforeach; ?>
    <?php endif; ?>

    
    <footer>
        <a href="./notifiche.php?del=del" class="btn">Cancella Notifiche</span>
    </footer>
</article>