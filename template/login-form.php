        <!-- Form di login. Posso sia loggarmi ma posso anche cliccare sul bottone registra per
    creare un nuovo account. -->
        <form action="#" method="POST">
        <fieldset>
            <h2>Login</h2>
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
                    <label for="username">Username:</label><input type="text" id="username" name="username" />
                </li>
                <li>
                    <label for="password">Password:</label><input type="password" id="password" name="password" />
                </li>
                <li>
                    <input type="submit" name="submit" value="Invia" />
                </li>
                
            </ul>
            </fieldset>
        </form>
            <div class="form-group">
                <a href="register.php" class="btn btn-info">Register</a>
            </div>