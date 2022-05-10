<?php
// On démarre une session
session_start();

if($_POST){
    if(isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['prenom']) && !empty($_POST['prenom'])
    && isset($_POST['age']) && !empty($_POST['age'])      
    && isset($_POST['poste']) && !empty($_POST['poste'])
    && isset($_POST['taille']) && !empty($_POST['taille'])){
        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
        $nom = strip_tags($_POST['nom']);
        $prenom = strip_tags($_POST['prenom']);
        $age = strip_tags($_POST['age']);
        $poste = strip_tags($_POST['poste']);
        $taille = strip_tags($_POST['taille']);

        $sql = 'UPDATE `joueur` SET `nom`=:nom, `prenom`=:prenom, `age`=:age, `poste`=:poste, `taille`=:taille WHERE `id`=:id;';

        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':age', $age, PDO::PARAM_INT);
        $query->bindValue(':poste', $adresse, PDO::PARAM_STR);
        $query->bindValue(':taille', $ville, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "Profil modifié";
        require_once('close.php');

        header('Location: index.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `joueur` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $joueur = $query->fetch();

    // On vérifie si le produit existe
    if(!$joueur){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index.php');
    }
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}

?>

<?php

require_once('connect.php');

$sql = 'SELECT nomposte.nom FROM nomposte';

$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$donnees = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('close.php');


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
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
                <h1>Modifier le profil</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="nom"></label>
                        <input type="text" id="nom" name="nom" class="input" placeholder="Nom" value="<?= $joueur['nom']?>">
                    </div>
                    <div class="form-group">
                        <label for="prenom"></label>
                        <input type="text" id="prenom" name="prenom" class="input" placeholder="Prénom" value="<?= $joueur['prenom']?>">
                    </div>
                    <div class="form-group">
                        <label for="age"></label>
                        <input type="number" id="age" name="age" class="input" placeholder="Âge" value="<?= $joueur['age']?>">
                    </div>
                     <div class="form-group">
                        <label for="poste"></label>
                        <select id="poste" name="poste" class="input" style="background-color: black;" placeholder="Poste" value="<?= $joueur['poste']?>">
                        <?php foreach ($donnees as $result ) { 
                        echo '<option value="'.$result['nom'].'">'.$result['nom'].'</option>';
                         } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="taille"></label>
                        <input type="text" id="talle" name="taille" class="input" placeholder="Taille" value="<?= $joueur['taille']?> cm">
                    </div>
                    <input type="hidden" value="<?= $joueur['id']?>" name="id">
                    <button class="btn btn-primary">Envoyer</button> <a href="index.php" class="btn btn-primary">Retour</a>
                </form>
            </section>
        </div>
    </div>
    </main>
</body>
</html>