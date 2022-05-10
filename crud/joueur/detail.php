<?php
// On démarre une session
session_start();

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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du joueur</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Détails de l'étudiant <?= $joueur['nom'] ?> <?= $etudiant['prenom'] ?></h1>
                <p>Nom: <?= $joueur['nom'] ?></p>
                <p>Prénom: <?= $joueur['prenom'] ?></p>
                <p>Âge: <?= $joueur['age'] ?></p>
                <p>Poste: <?= $joueur['poste'] ?></p>
                <p>Taille: <?= $joueur['taille'] ?></p>
                <p><a class="btn btn-primary" href="index.php">Retour</a> <a class="btn btn-primary" href="edit.php?id=<?= $joueur['id'] ?>">Modifier</a></p>
            </section>
        </div>
    </main>
</body>
</html>