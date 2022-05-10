<?php
// On démarre une session
session_start();

if($_POST){
    if(isset($_POST['nom']) && !empty($_POST['nom'])){
        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
        $nomclasse = strip_tags($_POST['nom']);

        $sql = 'INSERT INTO `nomposte`(`nom`) VALUES (:nom)';

        $query = $db->prepare($sql);

        $query->bindValue(':nom', $nomclasse, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = "Poste ajouté";
        require_once('close.php');

        header('Location: index.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un poste</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="content">
        <div class="row">
            <section class="col-12">
                <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <h1>Ajouter un poste</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="nom"></label>
                        <input type="text" id="nom" name="nom" class="input" placeholder="Poste" required />
                        </br>
                    </div>
                    <button class="btn btn-primary">Envoyer</button> <a href="index.php" class="btn btn-primary">Retour</a>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
