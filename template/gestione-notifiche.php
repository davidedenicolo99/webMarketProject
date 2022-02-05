

<article>
    <header>
        <h2>
            Sezione Notifiche
        </h2>
    </header>
    <?php foreach ($templateParams["notifiche"] as $key => $value):?>
    <section class="my-3">
        
            <span><span>ID notifica:</span><?php echo $value["idnotifica"]?></span>
            <span><span>ID prodotto:</span> <?php echo $value["idProdottoComprato"]?></span>
            <span><span>Compratore:</span> <?php echo $value["userCompratore"]?></span>
            <span><span>Quantita</span> <?php echo $value["quantitaComprata"]?></span>
            <span><span>Totale:</span> <?php echo $value["prezzoTotale"]?>$</span>
            <br>
        
    </section>
    <?php endforeach; ?>
    <footer>

    </footer>
</article>