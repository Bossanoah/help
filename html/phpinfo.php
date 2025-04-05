<?php
session_start();

// Connexion à la base de données
$cns = mysqli_connect('localhost', 'root', '', 'socialhelp');
    // Sécuriser les données soumises
    $mail = "audreyglory31@gmail.com"; 
    $mdp = "audreygg";   

    if (!empty($mail) && !empty($mdp)) {
        // Requête pour récupérer le mot de passe haché de la base de données
        $req = "SELECT id_user, motdepasse FROM user WHERE email = '$mail'";
        $result = mysqli_query($cns, $req);
        if (mysqli_num_rows($result) > 0) {
            // Récupérer les données de l'utilisateur
            $donnees = mysqli_fetch_assoc($result);
            // Vérifier le mot de passe avec password_verify()
            if (!password_verify($mdp, $donnees['motdepasse'])) {
                // Le mot de passe est correct, l'utilisateur peut se connecter
               
                header('Location: compteclient.php');
                exit();
            } else {
                // Le mot de passe est incorrect
                var_dump(password_verify($mdp, $donnees['motdepasse']));
            }
        } else {
            // Aucun utilisateur trouvé avec cet email
            $message = "Identifiants Incorrects";
        }
    } else {
        // Champ vide
        $message = "Veuillez remplir tous les champs";
    }

?>
