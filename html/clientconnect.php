<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/clientconnect2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link style="border-radius: 50%;" rel="icon" href="../src/SH.jpg" type="image/jpeg">
    <title>Social Help</title>
</head>
<body>
<?php
   session_start();
   $cns = mysqli_connect('localhost','root','');
        if(!$cns){
            echo 'Erreur de connection ';
        }
        $db = mysqli_select_db($cns, 'socialhelp');
        if(!$db){
            echo "Erreur de connexion a la base de donnees";
        }
    if (isset($_POST['submit'] )){
        $mail =trim(htmlspecialchars($_POST['mail']));
        $mdp = trim(htmlspecialchars($_POST['mdp']));
        if(!empty($mail) AND !empty($mdp)){
        $req ="SELECT id_user,motdepasse,status FROM user WHERE email = '$mail'";
        $result = mysqli_query($cns,$req);       
        if(mysqli_num_rows($result)>0){
            $donnees = mysqli_fetch_assoc($result);
           /* $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT);*/
          if(password_verify($mdp, $donnees['motdepasse']) && $donnees['status'] == "client"){
                $_SESSION['client' ] = $donnees['id_user'];
                header('Location: compteclient.php'); 
                exit();
            }else{
                $message =  "Identifiants Incorrect";
            }
                    }
            }
        }
?>
    <nav>
        <div class="logo"><h1>Social Help</h1></div>
        <div >
            <div  class="btn-menu" id="omenu"><i class="fa-solid fa-bars"></i></div>
            <ul class="header" id="menu">
                <div class="btn-menu" id="cmenu"><i class="fa-solid fa-xmark"></i></div>
                <li><a href="tel:+237 689 79 76 62" id="callLink">+237 689 79 76 62</a></li>
                <li class="here"><a href="##">Connexion</a></li>
                <li><a href="clientI.php">Inscription</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="aide.php">Aide</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <div id="info"><?=$message; ?><button id="close-info" > &nbsp; x</button></div>
        <form action="clientconnect.php" method="post">
            <div class="titre"><p>Se Connecter</p></div>
            <div class="form-div">
                <input type="text" name="mail" placeholder="E-mail" id="" required>
                <input type="password" name="mdp" placeholder="Mot de passe" required>
                <input type="submit" id="connect" name="submit" value="Se connecter">
                <a href="clientforgotpw.php">Mot de passe oublie ?</a>
    
            </div>
           
        </form>
        <div class="compte">Vous etes pas membre ? &nbsp;<a href="clientI.php"> Creer un compte</a></div>

    </main>
    <style>
        #info{
            display:<?= !empty($message)? 'block':'none';
            ?>
        }
    </style>
    <script src="../js/appel.js"></script>
    <script src="../js/navbar.js"></script>
</body>
</html>