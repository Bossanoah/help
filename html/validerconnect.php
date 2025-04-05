<?php
   session_start();
    /*function connectDB(){
        $cdb = mysqli_connect('localhost','root','');
        if(!$cdb){
            echo 'Erreur de connection ';
        }
        $db = mysqli_select_db($cdb, 'socialhelp');
        if(!$db){
            echo "Erreur de connexion a la base de donnees";
        }
        return $cdb;
    }*/
    $message ="";
    try
{
// On se connecte à MySQL $mdp=password_hash($mdp,PASSWORD_DEFAULT);
$bdd =new PDO('mysql:host=localhost;dbname=socialhelp', 'root', '');
$bdd->exec("SET NAMES utf8mb4");
}catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());}
if (isset($_POST['submit'] )){
    $mail = htmlspecialchars($_POST['mail']);
    $mdp = htmlspecialchars($_POST['mdp']);
    if(!empty($mail) AND !empty($mdp)){
    $req = $bdd->prepare('SELECT id_user,motdepasse FROM user WHERE email = ?');
    $req -> execute([$mail]);
    $donnees = $req -> fetch(PDO::FETCH_ASSOC);
    if($donnees && password_verify($mdp,$donnees['motdepasse'])){
        $_SESSION['client']= $donnees['id_user'];
        header('Location: compteclient.php'); 
        exit;
    }else{
        $message =urlencode("Identifiants Incorrect"); 
        header("Location: clientconnect.php?message=$message"); 
        exit;
    }
            }
    }

?>