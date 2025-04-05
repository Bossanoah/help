<?php require 'validerPostuler.php';?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socialhelp/Postulation</title>
    <link rel="stylesheet" href="../css/postuler2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" href="../src/SH.jpg" type="image/jpeg">
    <script src="../js/postuler.js"></script>
</head>
<body>
    <nav>
       <div class="logo">
            <h1>Social Help</h1>
       </div>
       <div  class="btn-menu" id="omenu"><i class="fa-solid fa-bars"></i></div>
        <ul class="headers" id="menu">
            <div  class="btn-menu" id="cmenu"><i class="fa-solid fa-xmark"></i></div>
            <li ><a href="index.php">Accueil</a></li>
            <li ><a href="about.php">A Propos</a></li>
            <li ><a href="service.php">Services</a></li>
           <!-- <li>
                <select name="service" id="service">
                    <optgroup>
                        <option value="##">Nos Services</option>
                        <option value="avs"><a href="avs.php">Auxiliaire de vie</a></option>
                        <option value="menage"><a href="menage.php">Menage</a></option>
                        
                    </optgroup>
                </select>
            </li>-->
            <li><a href="FAQ.php">FAQ</a></li>
              <div class="dropdown" ><p><a href="##">Menu </a></p>
                    <div class="dropdown-content">
                        <li><a href="Tarif.php">Tarif</a></li>
                        <li><a href="avisclient.php">Avis </a></li>
                    </div>
                </div>
            <li class="here"><a href="postuler.php">Postulez</a></li>
            <li><a href="clientconnect.php">Espace client</a></li>
        </ul>
    </nav>
    <main class="container">
        <h1>Postuler en tant que professionnel</h1>
        <form id="postulationForm" action="validerPostuler.php" method="POST" enctype="multipart/form-data">

            <label for="nom">Nom :</label>
            <input type="text"  name="nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text"  name="prenom" required>

            <label for="date_naissance">Date de naissance :</label>
            <input type="date"  name="date_nais" required>
                <div class="phone">
                    <label for="numtel">
                        <img src="..//src/flag.png" alt=""> 
                    </label>
                    <div>+237</div>
                    <input type="tel" name="tel" id="numtel" pattern="[0-9]{9}"  placeholder="Numero de telephone" maxlength="9" required>
                </div>

            <label for="email">Email :</label>
            <input type="email"  name="email" required>

            <label for="ville">Adresse Complet :</label>
            <input type="text"  name="ville" required>

            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password"  name="mdp" required>

            <label for="service">Service :</label>
            <select id="services" name="service" required>
                <option value="">Sélectionnez un service</option>
                <option value="menage">Ménage</option>
                <option value="auxiliaire">Aide a la personne</option>
            </select>
                     <?php 
                            if($stmt_ser){
                                mysqli_stmt_bind_param($stmt_ser,"i",$id_cat);
                                mysqli_stmt_execute($stmt_ser);
                                $resultat = mysqli_stmt_get_result($stmt_ser);
                                ?>
            <div id="services-avs" >
                <div id="sousServices">
                <?php
                        while($ser=mysqli_fetch_array($resultat,MYSQLI_ASSOC)){
                        ?>     
                       <label><input type="checkbox" name="services[]" value="<?=$ser['id_service']; ?>"><div><?=$ser['nom'];?></div></label>
                       <?php } }?>
                </div>
            </div>
                    <?php  
                            if($stmt_ser2){
                                mysqli_stmt_bind_param($stmt_ser2,"i",$id_cat2);
                                mysqli_stmt_execute($stmt_ser2);
                                $resultat2 = mysqli_stmt_get_result($stmt_ser2);
                                ?>
            <div id="services-menage" >
                <div id="sousServices">
                <?php
                        while($ser2=mysqli_fetch_array($resultat2,MYSQLI_ASSOC)){
                        ?>     
                       <label><input type="checkbox" name="services[]" value="<?=$ser2['id_service']; ?>"><div><?=$ser2['nom'];?></div></label>
                       <?php } }?>
                </div>
            </div>
            <label for="disponibilite">Disponibilité :</label>
            <textarea  name="dispo" rows="2" required></textarea>

            <label for="competences">Compétences :</label>
            <textarea  name="compt" rows="2" required></textarea>

            <label for="experience">Expérience :</label>
            <textarea id="experience" name="exper" rows="2" required></textarea>
            <label for="photo">Photo :</label>
            <input type="file"  name="photo" accept="image/*" class="file-input" required>

            <div id="certificat-container" >
                <label for="certificat">Certificat :</label>
                <input type="file"  name="certificat" accept="application/pdf" class="file-input">
            </div>
            <button type="submit" name="submit" >Postuler</button>
        </form>
    </main>
</body>
</html>