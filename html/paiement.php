<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/paiement.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" href="../src/SH.jpg" type="image/jpeg">
    <title>Social help</title>
</head>
<body>
    <nav>
        <div class="logo">
            <h1>Social Help</h1>
        </div>
        <div  class="btn-menu" id="omenu"><i class="fa-solid fa-bars"></i></div>
        <ul class="headers" id="menu">
           <div s class="btn-menu" id="cmenu"><i class="fa-solid fa-xmark"></i></div>
            <li ><a href="index.php">Accueil</a></li>
        </ul>
    </nav>
    <main>
        <form action="" method="post">
            <div class="titre"><p>Paiement</p></div>
            <div class="form-div">
                <input type="text" name="nom"  placeholder="Nom du deposant" required>
                <!--<div class="phone">
                    <label for="numtel">
                        <img src="..//src/flag.png" alt=""> 
                    </label>
                    <div>+237</div>
                    <input type="tel" name="tel" id="numtel" placeholder="Numero de telephone" pattern="[0-9]{9}" maxlength="9" required>
                </div>-->
                <input type="text" name ="vil" placeholder="Mode de paiement">
                <input type="text" name="mail" value="" placeholder="Montant" required>
                <input type="submit" id="submit" name= "submit" value="Envoyer">
            </div>
        </form>
    </main>
    <script src="../js/navbar.js"></script>
</body>
</html>