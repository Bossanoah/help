<?php
if ($_POST['submit']) {
    $expert = htmlspecialchars($_POST['expert']);
    $compt = htmlspecialchars($_POST['compt']);
    $dispo = htmlspecialchars($_POST['dispo']);
    $services = htmlspecialchars($_POST['services[]']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $ville = htmlspecialchars($_POST['ville']);
    $mail = htmlspecialchars($_POST['email']);
    $tel = htmlspecialchars($_POST['tel']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);

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
            echo "Erreur lors du téléchargement du certificat.";
            exit;
        }
         $photoPath;  
         $certificatPath; 
    }
   
    
}
?>