<?php 
        $message ="";
        if (isset($_POST['submit']) AND strlen($_POST['mdp']) >= 8 AND strlen($_POST['mdp']) <= 15 ){
            $nom = htmlspecialchars($_POST['nom']);
            $pnom = htmlspecialchars($_POST['pnom']);
            $vil = htmlspecialchars($_POST['vil']);
            $tel = htmlspecialchars($_POST['tel']);
            $mail = htmlspecialchars($_POST['mail']);
            $mdp=password_hash($_POST['mdp'],PASSWORD_BCRYPT);
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
        }elseif( isset($_POST['submit']) AND ((strlen($_POST['mdp']) < 8 OR strlen($_POST['mdp']) > 15))){
            $message = "le mot de passe doit entre 8 et 15 caracteres";
        }else {
            $message = "";
        }
    ?>