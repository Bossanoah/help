<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adminlogin.css">
    <link rel="icon" href="../src/SH.jpg" type="image/jpeg">
    <link rel="stylesheet" href="">
    <title>Socialhelp/Connexion Admin</title>
</head>
<body>
    <?php
    session_start(); $message ="";
    try
{
// On se connecte à MySQL
$bdd =new PDO('mysql:host=localhost;dbname=socialhelp', 'root', '');
}catch(Exception $e){
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());}

    if (isset($_POST['submit'] )){
        $mail = trim($_POST['mail']);
        $mdp = trim($_POST['mdp']);
        $status = "admin";
        if(!empty($mail) AND !empty($mdp)){
        $req = $bdd->prepare('SELECT id_user,status,motdepasse FROM user WHERE email = ?');
        $req -> execute([$mail]);
        $donnees = $req -> fetch(PDO::FETCH_ASSOC);
        if($donnees && $donnees['status'] ==  $status  &&  $donnees['motdepasse']==$mdp ){
            $_SESSION['admin']=$donnees['id_user'];
            header('Location: admin.php');  
        }else{
            $message =  "Identifiants Incorrect";
        }
                }
        }
    ?>
    <nav>
        <div class="logo"><h1>Social Help</h1></div>
    </nav>
    <main>
    <div id="info"><?= $message ?><button id="close-info" > &nbsp; x</button></div>
        <h2>Connexion Admin</h2>
        <form action="adminlogin.php" method="post">
           
            <div class="form">
                <div class="input">
                    <label for="">Email :  </label>
                   <input type="text"  name = "mail" required>
                </div>
                
                <div class="input">
                    <label for="">Mot de Passe :  </label>
                    <input type="password" name="mdp" id="" required>
                </div>
                
                <button name="submit" >Connexion</button>
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