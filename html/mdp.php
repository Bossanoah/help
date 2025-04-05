 <?php
try {
    // Connexion à la base de données
    $conn = new PDO("mysql:host=localhost;dbname=socialhelp", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

 // Sélectionner les utilisateurs avec des mots de passe en clair
 $email = "audreyglory72@gmail.com";

 $stmt = $conn->prepare('SELECT id_user, motdepasse FROM user WHERE email = ?');
 $stmt->execute([$email]);
 $user = $stmt->fetch(PDO::FETCH_ASSOC);

     $id = $user['id_user'];
     $motDePasseClair = $user['motdepasse'];

         $hash = password_hash($motDePasseClair, PASSWORD_DEFAULT);
         $updateStmt = $conn->prepare("UPDATE user SET motdepasse = ? WHERE id_user = ?");
         $updateStmt->execute([$hash, $id]);

         echo "Utilisateur ID $id : mot de passe haché et mis à jour.<br>";

        echo "Mise à jour terminée.";

?>