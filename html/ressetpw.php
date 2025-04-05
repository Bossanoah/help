<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/clientforgotpw.css">
    <link rel="icon" href="../src/SH.jpg" type="image/jpeg">
    <title>Social Help</title>
</head>
<body>
<?php
// Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mail']) && isset($_POST['mail'])) {
    $mail = htmlspecialchars($_POST['mail']);
    $mdp = htmlspecialchars($_POST['mdp']);
    if(!empty($mail) AND !empty($mdp)){
        $req = "UPDATE user SET motdepasse = '$mdp' WHERE email = '$mail' ";
        $cdb = mysqli_connect('localhost','root','');
        $db = mysqli_select_db($cdb, 'socialhelp');
        $req = mysqli_query($cdb,$req);
    
    }   
}
?>



    <nav>
        <div class="logo"><h1>Social Help</h1></div>
        <div >
            <ul class="header">
                <li><a href="tel:+237 689 79 76 62" id="callLink">+237 689 79 76 62</a></li>
                <li class="here"><a href="##">Connexion</a></li>
                <li><a href="clientI.php">Inscription</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="aide.php">Aide</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="info">Adresse Email Incorrect</div>
        <form action="">
            <div class="titre"><p>Reinitialisation du mot de passe</p></div>
            <p>Entrer l'adresse Email que vous avez utiliser <br/></p>
            <div class="form-div">
                <input type="email" name="mail" placeholder="E-mail" id="" required>
                <input type="text" name="pwd" placeholder="Mot de passe " id="" required>
                <input type="submit" id="connect" value="Reinitialiser le mot de passe">
            </div>
           
        </form>

    </main>
    <script src="../js/appel.js"></script>
</body>
</html>