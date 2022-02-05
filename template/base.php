<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $templateParams["titolo"]; ?></title>
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    
    <?php
    if(isset($templateParams["js"])):
        foreach($templateParams["js"] as $script):
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
            <li><a <?php isActive("index.php");?> href="index.php">Home</a></li><li><a <?php isActive("login.php");?> href="login.php">Login</a></li><li><a <?php isActive("index.php");?> href="cart.php">Carrello</a></li><li><a href="notifiche.php">Notifiche</a></li>
        </ul>
    </nav>
    <main>
    <?php
    if(isset($templateParams["nome"])){
        require($templateParams["nome"]);
    }
    ?>
    </main>
    <aside>
        <section>
            <h2>Categorie</h2>
            <ul class="list-group">
            
            <?php 
            foreach($templateParams["categorie"] as $categoria): ?>
                <li class="list-group-item"><a href="prodotti-categoria.php?id=<?php echo $categoria["idcategoria"]; ?>"><?php echo $categoria["nomecategoria"]; ?></a></li>
            <?php endforeach; ?>
            
            </ul>
        
        </section>
    </aside>
    <footer>
        <p>Tecnologie Web - A.A. 2019/2020</p>
    </footer>
</body>
</html>