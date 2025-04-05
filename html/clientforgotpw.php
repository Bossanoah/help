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
session_start();
// Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mail'])) {
    $email = trim($_POST['email']);
    $cdb = mysqli_connect('localhost','root','');
    $db = mysqli_select_db($cdb, 'socialhelp');
    // Vérifier si l'email existe dans la base
    $req = $pdo->prepare("SELECT id_user FROM user WHERE email = :email");
    $req->execute(['email' => $email]);
    $user = $req->fetch();

    if ($user) {
        $_SESSION['id_user1'] = $user;
        // Lien de réinitialisation (redirige vers une page pour changer le mot de passe)
        $resetLink = "https://SocialHelp.com/ressetpw.php?email=" . urlencode($email);

        // Envoi de l'email
        $to = $email;
        $subject = "Instructions pour changer le mot de passe";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
        $headers .= "From: no-reply@votre-site.com" . "\r\n";
        $message = "
        <html>
        <body>
            <h2>Réinitialiser Mot de passe</h2>
            <p>Bonjour,</p>
            <p>Quelqu'un a demandé un lien pour changer votre mot de passe. Cliquez ci-dessous pour le faire :</p>
            <p><a href='$resetLink' style='background-color:#28a745;color:white;padding:10px;border-radius:5px;text-decoration:none;'>Changer mon mot de passe</a></p>
            <p>Si vous n'êtes pas à l'origine de cette demande, ignorez simplement cet email.</p>
            <p>Cordialement,<br>L'équipe Social help</p>
        </body>
        </html>";

        if (mail($to, $subject, $message, $headers)) {
             $sms="Un email de réinitialisation a été envoyé.";
        } else {
            $sms= "Erreur lors de l'envoi du mail.";
        }
    } else {
        $sms= "Aucun compte associé à cet email.";
    }
}
?>



    <nav>
        <div class="logo"><h1>Social Help</h1></div>
        <div >
            <div  class="btn-menu" id="omenu"><i class="fa-solid fa-bars"></i></div>
            <ul class="header" id="menu">
                <div s class="btn-menu" id="cmenu"><i class="fa-solid fa-xmark"></i></div>
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
            <p>Entrer l'adresse Email que vous avez utiliser <br/>
                pour vous inscrire et nous vous enverrons le <br/> lien pour reinitialiser par mail</p>
            
            <div class="form-div">
                <input type="text" name="" placeholder="E-mail" id="" required>
                <input type="submit" id="connect" value="Reinitialiser le mot de passe">
    
            </div>
           
        </form>

    </main>
    <script src="../js/appel.js"></script>
</body>
</html>