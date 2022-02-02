<?php 
    /**
     * Questo form gestisce il cambio di credenziali una volta che l'utente è loggato.
     * Nota: viene mostrato solo da un utente normale, non all'admin.
     */

            $prodotto = $parameters["login"]; 
        ?>
        <form action="processa-utente.php" method="POST" enctype="multipart/form-data">
            <h2>Gestisci Credenziali</h2>
            <ul>
                <li>
                    <label for="username">Username:</label><input type="text" id="username" name="username" value="<?php echo $prodotto[0]["username"]; ?>" />
                </li>
                <li>
                    <label for="password">Password:</label><textarea id="password" name="password"><?php echo $prodotto[0]["password"]; ?></textarea>
                </li>
                <li>
                    <label for="nome">Nome:</label><textarea id="nome" name="nome"><?php echo $prodotto[0]["nome"]; ?></textarea>
                </li>
                <li>
                    <input type="submit" name="submit" value="Modifica"/>
                    <a href="index.php">Annulla</a>

                    <label for="logout"><input type="submit" name="logout" value="Logout"></label>
                </li>
            </ul>        
        </form>