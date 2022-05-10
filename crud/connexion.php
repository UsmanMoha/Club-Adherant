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
                        <div class="form-title">
                            <h1>Erreur</h1>
                        </div>
                        <div class="form-group">
                            <div class="form-btn">
                                <a class="btn" href="login.php">Connexion</a>
                            </div>
                        </div>
                        <div class="form-title">
                            <h1>
                        <?php 

// On démarre la session PHP

// On vérifie si lle formulaire a été envoyé

if (!empty($_POST))
{
    // Le formulaire a été envoyé
    // On vérifie que Tous les champs requis sont remplis
    if(isset($_POST["email"], $_POST["mdp"])&& !empty($_POST["email"] && !empty($_POST["mdp"])))
    {
        // On vérifie que l'email en est un
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        {
            die ("Ce n'est pas un email");
        }

        require_once "connect.php";

        $sql = "SELECT * FROM `admin` WHERE `email` = :email";

        $query = $db->prepare($sql);

        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

        $query->execute();

        $admin = $query->fetch();

        if(!$admin)
        {
            die("L'utilisateur n'existe pas");
        }
        // Ici on a un user existant, on peut vérifier le mot de passe
        if ($_POST["mdp"] != $admin["mdp"])
        {
            die("L'utilisateur et/ou le mot de passe est incorrect");
        }
        
        //Ici l'utilisateur et le :ot de passe sont correct 
        // On va pouvoir "connecter" l'utilisateur
        session_start();


        // On stocke dans $_SESSION les informations de l'utilisateur
        $_SESSION["admin"] = [
            "id" => $admin["id"],
            "nom" =>$admin["nom"],
            "prenom" =>$admin["prenom"],
            "email" =>$admin["email"],
            "mdp" =>$admin["mdp"]
        ];
        // On redirige vers la page de profil (par exemple)
        header("Location: indexadmin.php");

    } 

}

?>
</div>
                </div>
            </div>
        </body>
</html>

