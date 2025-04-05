<?php
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
                <li><a href="prestationClient.php">prestation</a></li>
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
                <?php 
                    $cns = mysqli_connect("localhost","root");
                    $bd = mysqli_select_db($cns,"socialhelp");
                    $req = "SELECT * FROM reservation WHERE id_user = ?";
                    $stmt = mysqli_prepare($cns,$req);
                    mysqli_stmt_bind_param($stmt,"i",$id_client);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while($data = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                        
                    }
                    
                ?>
            </div>
        </main>
</body>
</html>