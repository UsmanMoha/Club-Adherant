<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="styles.css"/>
            <title>Connexion Admin</title>
        </head>
        <body>
            <div class="container">
                <div class="content">
                    <form action="connexion.php" method="post">
                        <div class="form-title">
                            <h1>Connexion Admin</h1>
                        </div>
                        <div class="form-group">
                            <label for="email"></label>
                            <input type="text" name="email" id="email" class="input" placeholder="Email" required />
                            <br />
                            <label for="mdp"></label>
                            <input type="password" name="mdp" id="mdp" class="input" placeholder="Mot de passe" required />
                            <br />
                            <div class="form-btn">
                                <button class="btn fill">Valider</button></br></br>
                                <a class="btn" href="../index.php">Menu</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </body>
</html>