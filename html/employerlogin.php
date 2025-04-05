<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adminlogin.css">
    <link rel="icon" href="../src/SH.jpg" type="image/jpeg">
    <title>Socialhelp/Connexion Employer</title>
</head>
<body><?php
   session_start();
    
    $message ="";
try
{
// On se connecte à MySQL
$bdd =new PDO('mysql:host=localhost;dbname=socialhelp', 'root', '');
}catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());}
if (isset($_POST['submit'] )){
    $mail = trim($_POST['mail']);
    $mdp = trim($_POST['mdp']);
    if(!empty($mail) AND !empty($mdp)){
    $req = $bdd->prepare('SELECT id_prof,motdepasse FROM personel WHERE email = ?');
    $req -> execute([$mail]);
    $donnees = $req -> fetch(PDO::FETCH_ASSOC);
    if($donnees && $donnees['motdepasse']==$mdp){
        $_SESSION['prof']=$donnees['id_prof'];
        header('Location: compteprof.php');  
    }else{
        $message =  "Identifiants Incorrect";
    }
            }
    }?>
    <nav>
        <div class="logo"><h1>Social Help</h1></div>
        <div class="connect"></div>
    </nav>
    <main>
    <div id="info"><?= $message ?><button id="close-info" > &nbsp; x</button></div>
        <h2>Connexion Employer</h2>
        <form action="">
            <div class="form">
                <div class="input">
                    <label for="">E-mail :  </label>
                    <input type="email" name="mail" id="">
                </div>
               
                <div class="input">
                    <label for="">Mot de Passe :  </label>
                    <input type="password" name="mdp" id="" required>
                </div>
                <button name="submit">Connexion</button>
            </div>
        </form>
    </main>
    <style>
        #info{
            display:<?= !empty($message)? 'block':'none';
            ?>
        }
    </style>
    <script src="../js/appel.js"></script>
</body>
</html>