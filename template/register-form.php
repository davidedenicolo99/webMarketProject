<!-- Form che permette la registrazione di un utente -->
<form action="register.php" method="POST">
            <h2>Register</h2>
            <?php
                if(isset($parameters["msg"])){
                    echo $parameters["msg"];
                    unset($parameters["msg"]);
                }
            ?>
            <?php if(isset($parameters["errorelogin"])): ?>
            <p><?php echo $parameters["errorelogin"]; ?></p>
            <?php endif; ?>
            <ul>
                <li>
                    <label for="username">Username:</label><input type="text" id="username" name="username" required />
                </li>
                <li>
                    <label for="password">Password:</label><input type="password" id="password" name="password" required />
                </li>
                <li>
                    <label for="name">Nome:</label><input type="text" id="name" name="name" required />
                </li>
                <li>
                <label for="choice">Utente venditore?</label>
                    <select name="choice" >
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                    </select>
                </li>
                <li>
                    <input type="submit" name="submit" value="Invia"/>
                </li>
            </ul>
</form>
           