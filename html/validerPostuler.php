<?php
session_start();
    $cns = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($cns,"socialhelp");

    //Service d'aide a la personne
    $nom_cat = "Auxiliaire de vie";
    $sql_cat = "SELECT id_cat FROM categorie WHERE nom = ? ";
    $sql_service = "SELECT * FROM service WHERE id_cat = ? ";
    $stmt = mysqli_prepare($cns,$sql_cat);
    if($stmt){
        mysqli_stmt_bind_param($stmt,"s",$nom_cat);
        mysqli_stmt_execute($stmt); 
        $result = mysqli_stmt_get_result($stmt); 
        if($donnees = mysqli_fetch_assoc($result)){ 
            $id_cat = $donnees['id_cat'];
        }
    }
    mysqli_stmt_close($stmt);
    $stmt_ser = mysqli_prepare($cns,$sql_service);

    //service de menage
    $nom_cat2 = "Menage a domicile";
    $sql_cat2 = "SELECT id_cat FROM categorie WHERE nom = ?";
    $sql_service2 = "SELECT * FROM service WHERE id_cat = ?";
    $stmt2 = mysqli_prepare($cns,$sql_cat2);
    if($stmt2){
        mysqli_stmt_bind_param($stmt2,"s",$nom_cat2);// "" contient le type du parametre
        mysqli_stmt_execute($stmt2); // execute la requete
        $result2 = mysqli_stmt_get_result($stmt2); // recupere le resultat 
        if($donnees2 = mysqli_fetch_assoc($result2)){ // affiche le resultats
            $id_cat2 = $donnees2['id_cat'];
        }
    }
    mysqli_stmt_close($stmt2);
    $stmt_ser2 = mysqli_prepare($cns,$sql_service2);

if (isset($_POST['submit'])) {
    $expert = htmlspecialchars($_POST['exper']);
    $compt = htmlspecialchars($_POST['compt']);
    $dispo = htmlspecialchars($_POST['dispo']);
    $services = $_POST['services'];
    $mdp = htmlspecialchars($_POST['mdp']);
    $ville = htmlspecialchars($_POST['ville']);
    $mail = htmlspecialchars($_POST['email']);
    $tel = htmlspecialchars($_POST['tel']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $date = date('Y-m-d' , strtotime($_POST['date_nais']));
    $today = date('Y-m-d');
    $status = "Disponible";
    $recrut = "NON";

    if(isset($_FILES['photo'])){
        $photoFile = "uploads/photos/";  // Dossier pour la photo
        $certificatFile = "uploads/certificats/";  // Dossier pour le certificat
        $photoName = basename($_FILES['photo']['name']);
        $photoPath = $photoFile . $photoName;
         // Déplacer le fichier photo vers le dossier de stockage
        move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);

        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
            echo '<script> alert("Erreur lors du téléchargement de la photo.");</script>';
            exit;
        }
    }
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        var_dump($_FILES["photo"]);
        $targetDir = "uploads/"; // Dossier de destination
        $fileName = basename($_FILES["photo"]["name"]);
        $targetFile = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Vérifier le type de fichier (seulement images)
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($fileType, $allowedTypes)) {
            die("Erreur : Seuls les fichiers JPG, JPEG, PNG, et GIF sont autorisés.");
           
        }

        // Déplacer le fichier vers le dossier de destination
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            echo "Le fichier " . htmlspecialchars($fileName) . " a été uploadé avec succès.";
            
        } else {
            echo "Erreur lors de l'upload.";
           
        }
    } else {
        echo "Erreur : Aucun fichier n'a été téléchargé ou une erreur est survenue.";
       
    }


  
    if (isset($_FILES['certificat'])) {
        // Vérifier le type MIME du certificat
        $allowedCertTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png'];
        $certificatType = mime_content_type($_FILES['certificat']['tmp_name']);
        if (!in_array($certificatType, $allowedCertTypes)) {
            echo '<script> alert("Le fichier certificat n\'est pas valide.");</script>';
            exit;
        }
        $certificatName = basename($_FILES['certificat']['name']);
        $certificatPath = $certificatFile . $certificatName;
        move_uploaded_file($_FILES['certificat']['tmp_name'], $certificatPath);

        // Déplacer le fichier certificat vers le dossier de stockage
        if (!move_uploaded_file($_FILES['certificat']['tmp_name'], $certificatPath)) {
            echo '<script> alert("Erreur lors du téléchargement du certificat.");</script>';
            exit;
        }
         $photoPath;  
         $certificatPath; 
    }
    $verifemail = "SELECT COUNT(*) FROM user WHERE email = ?";
    $stmt = mysqli_prepare($cdb, $verifemail);
    mysqli_stmt_bind_param($stmt, "s", $mail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($count > 0){
        $message = "Cet Identifiant exist deja";
        echo $message;

    }else{
       
        $req = "INSERT INTO personel(nom,prenom,experience,disponibilite,num_tel,email,adresse,status,recrut_valider,photo,date_nais,date_recrut,competence,certificat)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($cns,$req);
        mysqli_stmt_bind_param($stmt,"ssssssssssssss",$nom,$prenom,$expert,$dispo,$tel,$mail,$ville,$status,$recrut,$photoPath,$date,$today,$compt,$certificatPath);
        mysqli_stmt_execute($stmt);
        //recupere l'id du professionel
        $prof = "SELECT id_prof,motdepasse FROM personel WHERE email = ?";
        $stmtp = mysqli_prepare($cns,$req);
        mysqli_stmt_bind_param($stmtp,"i",$mail);
        mysqli_stmt_execute($stmtp);
        $result = mysqli_stmt_get_result($stmtp);
        $donnees = mysqli_fetch_assoc($result);
        $id_prof= $donnees['id_prof'];

        //inserer les donnees dans serviceproposer
         $serve = "INSERT INTO propose_service(id_prof,id_service) VALUES(?,?)";
         $stmt = mysqli_prepare($cns, $serve);
        foreach ($services as $id_service) {
            $id_service = intval($id_service); // Sécurisation
            mysqli_stmt_bind_param($stmt, "ii",  $id_prof, $id_service);
            mysqli_stmt_execute($stmt);
        }

        header("Location: postuler.php");
        exit();
    }
}

?>