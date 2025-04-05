<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reserve.css">
    <link rel="icon" href="../src/SH.jpg" type="image/jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Social Help</title>
</head>
<body>
<script src="../js/reserver.js"></script>
    <nav>
        <div class="logo">
             <h1>Social Help</h1>
        </div>
        <ul class="headers" id="menu">
            <li ><a href="##"></a></li>
        </ul>
    </nav>
    <main>
        <i onclick=" history.back()" class="fa-solid fa-arrow-left"></i>
        <div class="reserver">
            <h1>Réservez un Service</h1>
            <form action="validerReservation.php" method="post">
                <div class="formp">
                        <div class="form group">
                            <label for="nom">Nom du client :</label>
                            <input type="text" id="nom" name="nom" required>
                        </div>
                        <div class="form group">
                            <label for="adresse">Adresse :</label>
                            <input type="text" id="adresse" name="adresse" required>
                        </div>
                        <div class="form group">
                            <label for="nbrp">Nombre de pieces :</label>
                            <input type="text" id="nbrp" name="nbrp" >
                        </div>
                            <div class="form group" >
                                <label for="heure_d">Heure de debut :</label>
                                <input type="time" name="heure_d" id="heure_d" required>
                            </div>
                            <?php 
                            $cns = mysqli_connect("localhost","root","");
                            $db = mysqli_select_db($cns,"socialhelp");
                            $nom_cat = "Menage a domicile";
                            $sql_cat = "SELECT id_cat FROM categorie WHERE nom = ? ";
                            $sql_service = "SELECT * FROM service WHERE id_cat = ? ";
                            $stmt = mysqli_prepare($cns,$sql_cat);
                            if($stmt){
                                mysqli_stmt_bind_param($stmt,"s",$nom_cat);// "" contient le type du parametre
                                mysqli_stmt_execute($stmt); // execute la requete
                                $result = mysqli_stmt_get_result($stmt); // recupere le resultat 
                                if($donnees = mysqli_fetch_assoc($result)){ // affiche le resultats
                                        $id_cat = $donnees['id_cat'];
                                }
                            }
                            mysqli_stmt_close($stmt);
                            $stmt_ser = mysqli_prepare($cns,$sql_service);
                            if($stmt_ser){
                                mysqli_stmt_bind_param($stmt_ser,"i",$id_cat);
                                mysqli_stmt_execute($stmt_ser);
                                $resultat = mysqli_stmt_get_result($stmt_ser);
                                ?>
                        <div class="form group"id="menage1">
                            <label for="service_id">Sélectionner un service :</label>
                            <select id="service_id" name="service_id" required>
                               <?php
                               /* if ($ser = mysqli_fetch_assoc($resultat)){*/
                                    while($ser=mysqli_fetch_array($resultat,MYSQLI_ASSOC)){
                        ?>     
                                <option value="<?=$ser['id_service']; ?>"><?=$ser['nom']; ?></option>
                        <?php
                                     } 
                                }
                          /*  }*/
                        ?>
                            </select>
                        </div>
                        <div class="form group" id="date">
                            <label for="date_d">Date de debut de la reservation :</label>
                            <input type="date" id="date_d" name="date_d" required>
                        </div>
                        <div class="form group" id="date">
                            <label for="date_f">Date de fin de la reservation :</label>
                            <input type="date" id="date_f" name="date_f" required>
                        </div>
                        <div class="form group">
                            <label for="heure">Nombre d'heure :</label>
                            <select style=" width:74%;" id="heure" name="heure" required>
                                <option value="1">01 heure</option>
                                <option value="1.5">01:30 </option>
                                <option value="2">02 heures</option>
                                <option value="2.5">02:30</option>
                                <option value="3">03 heures</option>
                                <option value="3.5">03:30 </option>
                                <option value="4">04 heures</option>
                                <option value="4.5">04:30</option>
                                <option value="5">05h eures</option>
                                <option value="0">plus</option>
                            </select>
                        </div>
                       
                        <div class="form group" id="comment1" >
                            <label for="comment">Commentaire :</label>
                            <textarea name="comment" id="comment"  rows="3" ></textarea>
                        </div>
                    <button type="submit" name="submit" id="submit">Confirmer la réservation</button>
                </div>
            </form>
        </div>
        <div id="info"><?= $message ?><button id="close-info" > &nbsp; x</button></div>
        <div class="facture">
            <h2>Facture</h2>
             <p>Votre réservation du  <span id="dat"><?= $date = date('d-m-Y'); ?></span></p> 
             <p>Service réserver <span id="ser"></span></p>
             <p>Date <span id="datd"></span></p>
             <p>Durée en jour  <span id="durj"></span></p> 
             <p>Durée en heures  <span id="dur"></span></p> 
             <p>Heures de début <span id="hd"></span></p>
             <p>Prix de l'heure  <span id="ph"></span></p>
             <p>Frais de service <span id="fs"></span></p>
             <b><p>Prix <span id="prix"></span></p></b>
        </div>
    </main>
    <style>
        #info{
            display:<?= !empty($message)? 'block':'none';
            ?>}

             #info{
            /* display: none;*/
            max-width: 400px;
            height: 30px;
            color: white;
            background: red;
            padding: 10px;
            box-shadow:  5px 5px 5px 5px rgb(0, 0, 0, 0.3);
            border-radius: 5px;
            position: relative;

            }
            #close-info{
            background: none;
            border: none;
            font-size: 18px;
            font-weight: bold;
            float: right;
            }                   
    </style>
    
</body>
</html>