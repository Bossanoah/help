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
         session_start(); 
         try
        {
        // On se connecte à MySQL
        $bdd =new PDO('mysql:host=localhost;dbname=socialhelp', 'root', '');
        }catch(Exception $e)
        {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());}
         $message ="";
         $id_prof = $_SESSION['prof'];
         $req = $bdd->prepare('SELECT nom,prenom FROM personel WHERE id_prof= ?');
         $req -> execute([$id_prof]);
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
                <li><a href="reserve_compte.php">prestation</a></li>
                <li><a href="paracompte.php"><i class="fa-solid fa-gear"></i></a></li>
                <li><a href="aide_client.php">Aide</a></li>
                <button class="newrest">Nouvelle Reservation</button>
            </ul>
        </nav>
    </header>
        <main>
            <div style = "font-size: 2.2rem; text-align: center; color: rgba(73, 230, 73, 0.795);;" class="welcome"></div>
        </main>
</body>
</html>