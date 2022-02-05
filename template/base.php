<!-- Form base a cui mi aggancio per caricare le pagine avendo un url -->
<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $parameters["title"]; ?></title>
    
    <style>
  <?php include "./css/style.css" ?>
</style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <script src="http://kit.fontawesome.com/5d6516edcb.js" crossorigin="anonymous"></script>
    

    
    <?php
    if(isset($parameters["js"])):
        foreach($parameters["js"] as $script):
    ?>
        <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
</head>
<body id="gradient">
    <header>
        <h1>E-commerce di formule</h1>
    </header>
    <nav style="
    height: 30px;
                ">
        <ul >
            <li><a <?php isActive("index.php");?> href="index.php">Home</a></li><li><a <?php isActive("login.php");?> href="login.php">Login</a></li><li><a <?php isActive("carrello.php");?> href="cart.php">Carrello</a></li><li><a href="notifiche.php">Notifiche</a></li>
        </ul>
    </nav>
    <main>
    <?php
    if(isset($parameters["nome"])){
        require($parameters["nome"]);
    }
    ?>
    </main>
    <aside>
        <section>
            <h2>Categorie</h2>
            <ul class="list-group">
            
            <?php 
            foreach($parameters["categorie"] as $categoria): ?>
                <li class="list-group-item"><a href="prodotti-categoria.php?id=<?php echo $categoria["idcategoria"]; ?>"><?php echo $categoria["nomecategoria"]; ?></a></li>
            <?php endforeach; ?>
            
            </ul>
        
        </section>
    </aside>
    <footer style="height:100px;">
        <p>Web marketing</p>
    </footer>
</body>
</html>