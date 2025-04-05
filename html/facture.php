<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/compte.css">
    <link rel="icon" href="../src/SH.jpg" type="image/jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title style="font-style: italic;">Social help</title>
</head>
<body>
    <?php  
    try
    {
    // On se connecte à MySQL
    $bdd =new PDO('mysql:host=localhost;dbname=socialhelp', 'root', '');
    }catch(Exception $e)
    {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());}
     $message ="";
        $id_client = $_SESSION['client'];
     $req = $bdd->prepare('SELECT nom,prenom FROM user WHERE id_user = ?');
     $req -> execute([$id_client]);
     $donnees = $req -> fetch(PDO::FETCH_ASSOC);
     $message = $donnees['nom']." ".$donnees['prenom'];
    
    ?>
    <header>
            <div class="logo">
                <h1>Social Help</h1>
            </div>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="compteclient.php">prestation</a></li>
                <li><a href="facture.php">facture</a></li>
                <li><a href="paracompte.php"><i class="fa-solid fa-gear"></i></a></li>
                <li><a href="aide_client.php">Aide</a></li>
                <a href = "reserve0.php" ><button class="newrest">Nouvelle Reservation</button></a>
            </ul>
        </nav>
    </header>
        <main>
            <div style = "font-size: 2.2rem; text-align: center; color: rgba(73, 230, 73, 0.795); margin-top: 10px" class="welcome">Bienvenue <?=$message?> </div>
            <div class= "content" >
                <div class="facture">
                    <h2>Facture</h2>
                    <p>Votre réservation du  <span id="dat"><?= $date = date('d-m-Y'); ?></span></p> 
                    <p>Service réserver <span id="ser"></span></p>
                    <p>Date <span id="datd">--</span></p>
                    <p>Durée en jour  <span id="durj"></span></p> 
                    <p>Durée en heures  <span id="dur"></span></p> 
                    <p>Heures de début <span id="hd"></span></p>
                    <p>Prix de l'heure  <span id="ph"></span></p>
                    <p>Frais de service <span id="fs"></span></p>
                    <b><p>Prix <span id="prix"></span></p></b>
                </div>
            </div>
        </main>
</body>
</html>
