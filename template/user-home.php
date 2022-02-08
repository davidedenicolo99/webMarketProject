<?php 
    /**
     * Questo form gestisce il cambio di credenziali una volta che l'utente è loggato.
     * Nota: viene mostrato solo da un utente normale, non all'admin.
     */

            $prodotto = $parameters["login"]; 
        ?>
        <form action="processa-utente.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <h2>Gestisci Credenziali</h2>
            <?php 
                if(isset($parameters["error"])):?>
                <h3><?php echo $parameters["error"]?></h3>
            <?php unset($parameters["error"]); endif; ?>
            <ul>
                <li>
                    <label for="username">Username:</label><input type="text" id="username" name="username" value="<?php echo $prodotto[0]["username"]; ?>" />
                </li>
                <li>
                    <label for="password">Password:</label><input type="text" id="password" name="password" value="<?php echo $prodotto[0]["password"]; ?>"></input>
                </li>
                <li>
                    <label for="nome">Nome:</label><input type="text" id="nome" name="nome" value="<?php echo $prodotto[0]["nome"]; ?>"></input>
                </li>
                <li>
                    <input type="submit" name="submit" value="Modifica"/>
                    <a href="index.php" >Annulla</a>

                    <label for="logout"><input type="submit" name="logout" value="Logout"></label>
                </li>
            </ul> 
            </fieldset>       
        </form>