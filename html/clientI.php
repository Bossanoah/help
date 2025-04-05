<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/clientI2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" href="../src/SH.jpg" type="image/jpeg">
    <title>Social help</title>
</head>
<body>
<?php 
        $message ="";
        if (isset($_POST['submit']) AND strlen($_POST['mdp']) >= 8 AND strlen($_POST['mdp']) <= 15 ){
            $nom = htmlspecialchars($_POST['nom']);
            $pnom = htmlspecialchars($_POST['pnom']);
            $vil = htmlspecialchars($_POST['vil']);
            $tel = htmlspecialchars($_POST['tel']);
            $mail = htmlspecialchars($_POST['mail']);
            $mdp = trim(htmlspecialchars($_POST['mdp']));
           $mdp=password_hash($_POST['mdp'],PASSWORD_DEFAULT);
            $date = date('Y-m-d');
            $status = 'client';
            if(!empty($nom) AND !empty($pnom) AND !empty($tel) AND !empty($vil) AND !empty($mail) AND !empty($mdp)){
                $Iclient = "INSERT INTO user(id_user,nom,prenom,email,motdepasse,adresse,date_inscription,status,num_tel)
                 VALUES('','".$nom."','".$pnom."','". $mail."','".$mdp."','".$vil."','". $date."','".$status."','".$tel."') " ;
                 $verifemail = " SELECT COUNT(*) FROM user WHERE email = ? " ;
                 $cdb = mysqli_connect('localhost','root','');
                    if(!$cdb){
                        echo 'Erreur de connection ';
                    }
                    $db = mysqli_select_db($cdb, 'socialhelp');
                    if(!$db){
                        echo "Erreur de connexion a la base de donnees";
                    }
                    //$count = mysqli_query($cdb,$verifemail);
                    $verifemail = "SELECT COUNT(*) FROM user WHERE email = ?";
                    $stmt = mysqli_prepare($cdb, $verifemail);
                    mysqli_stmt_bind_param($stmt, "s", $mail);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $count);
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_close($stmt);
                
                 if ($count > 0){
                    $message = "Cet Identifiant exist deja";
                 }else{
                    $cdb = mysqli_connect('localhost','root','');
                    if(!$cdb){
                        echo 'Erreur de connection ';
                    }
                    $db = mysqli_select_db($cdb, 'socialhelp');
                    if(!$db){
                        echo "Erreur de connexion a la base de donnees";
                    }
                    $req = mysqli_query($cdb,$Iclient);
                     // on dirige  le user sur la page de connexion
	                 header("location:clientconnect.php");
                 }
            }
        }elseif( isset($_POST['submit']) AND (strlen($_POST['mdp']) < 8)){
            $message = "Entrer un mot de passe de minimum 8 carateres";
        }else {
            $message = "";
        }
    ?>
    <nav>
        <div class="logo"><h1>Social Help</h1></div>
        <div class="btn-menu" id="omenu"><i class="fa-solid fa-bars"></i></div>
        <div >
            <ul class="header" id="menu">
            <div class="btn-menu" id="cmenu"><i class="fa-solid fa-xmark"></i></div>
                <li> <a href="tel:+237 689 79 76 62" id="callLink">+237 689 79 76 62</a></li>
                <li><a href="clientconnect.php">Connexion</a></li>
                <li class="here"><a href="##">Inscription</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="aide.php">Aide</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <div id="info"><?= $message ?><button id="close-info"> &nbsp; x</button></div>
        <form action="clientI.php" method="post">
            <div class="titre"><p>S'inscrire</p></div>
            <div class="form-div">
                <div class="names">
                    <input type="text" name="nom"  placeholder="Votre Nom" required>
                    <input type="text" name="pnom"  placeholder="Votre Prénom" required>
                </div> 
                <div class="phone">
                    <label for="numtel">
                        <img src="..//src/flag.png" alt=""> 
                    </label>
                    <div>+237</div>
                    <input type="tel" name="tel" id="numtel" placeholder="Numero de telephone" pattern="[0-9]{9}" maxlength="9" required>
                </div>
                <input type="text" name = "vil" placeholder="Votre ville">
                <input type="text" name="mail" placeholder="E-mail" id="" required>
                <input type="password" id="mdp1" name="mdp" placeholder="Mot de passe"  required >
                <div style="color: grey;"  id="mpd">Entrer un mot de passe de minimum 8  caracteres</div>
                <input type="submit" id="submit" name= "submit" value="Creer un Compte">
            </div>
        </form>
        <div class="compte">Vous avez déja un compte ? &nbsp; <a href="clientconnect.php">Connexion</a></div>
    </main>
    <style>
        #info{
            display:<?= !empty($message)? 'block':'none';
            ?>
        }
    </style>
    <script src="../js/navbar.js"></script>
</body>
</html>