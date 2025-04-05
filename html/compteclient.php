<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/compte.css">
    <link rel="icon" href="../src/SH.jpg" type="image/jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title style="font-style: italic;">Social help</title>
</head>
<body>
<script src="../js/navbar.js"></script>
    <?php  
    try
    {
    // On se connecte à MySQL
    $bdd =new PDO('mysql:host=localhost;dbname=socialhelp', 'root', '');
    }catch(Exception $e)
    {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());}
     $message ="";
        $id_client = $_SESSION['client'];
     $req = $bdd->prepare('SELECT nom,prenom FROM user WHERE id_user = ?');
     $req -> execute([$id_client]);
     $donnees = $req -> fetch(PDO::FETCH_ASSOC);
     $message = $donnees['nom']." ".$donnees['prenom'];
    
   /*Recuperer les elements de la reservation*/
    $cns = mysqli_connect("localhost", "root");
    $bd = mysqli_select_db($cns,"socialhelp");
    $id_client = $_SESSION['client'];
    $req = "SELECT * FROM reservation WHERE id_user = ?";
    $stmt = mysqli_prepare($cns,$req);
    mysqli_stmt_bind_param($stmt,"i", $id_client);
    mysqli_stmt_execute($stmt);
    $result =mysqli_stmt_get_result($stmt);
     
?>
    <header>
            <div class="logo">
                <h1>Social Help</h1>
            </div>
        <nav>
           <!-- <div  class="btn-menu" id="omenu"><i class="fa-solid fa-bars"></i></div>-->
            <ul class="headers" id="menu">
                <!-- <div  class="btn-menu" id="cmenu"><i class="fa-solid fa-xmark"></i></div>-->
                <li><a href="index.php">Accueil</a></li>
                <li class="here"><a href="compteclient.php">prestation</a></li>
                <li><a href="facture.php">facture</a></li>
                <li><a href="paracompte.php"><i class="fa-solid fa-gear"></i></a></li>
                <li><a href="aide_client.php">Aide</a></li>
                <a href = "reserve0.php" ><button class="newrest">Nouvelle Reservation</button></a>
            </ul>
        </nav>
    </header>
        <main>
            <div style = "font-size: 2.2rem; text-align: center; color: rgba(73, 230, 73, 0.795); margin-top: 10px" class="welcome">Bienvenue, <?=$message?> ! Voici l'historique de vos réservations.</div>
            <?php if(mysqli_num_rows($result)>0){?>
            <div class="content">
               <div class="filters">
                    <input type="text" id="searchInput" placeholder="Rechercher par service..." onkeyup="filterTable()">
                    <select id="statusFilter" onchange="filterTable()">
                        <option value="">Tous les statuts</option>
                        <option value="Validée">Validée</option>
                        <option value="En attente">En attente</option>
                        <option value="Annulée">Annulée</option>
                        <option value="Effectuée">Effectuée</option>
                        <option value="Non Validée">Non Validée</option>
                        <option value="En cours">En cours</option>
                    </select>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Montant</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="reservationTable">
                            <?php $i = 1;
                            while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC)): 
                                    $id_ser = $data['id_service'] ;
                                    $query = "SELECT nom FROM service WHERE id_service = ?";
                                    $stmt_ser = mysqli_prepare($cns, $query);
                                    mysqli_stmt_bind_param($stmt_ser, "i", $id_ser); 
                                    mysqli_stmt_execute($stmt_ser); 
                                    $resultat = mysqli_stmt_get_result($stmt_ser);
                                     if ($results = mysqli_fetch_assoc($resultat)) {
                                        $nom_service = $results['nom'];
                                     }
                                ?>
                                <tr>
                                    <td><?= $i++ ;?></td>
                                    <td><?= $nom_service ;?></td>
                                    <td><?= $data['date_debut']." au ".$data['date_fin'] ;?></td>
                                    <td><?= $data['status'] ;?></td>
                                    <td><?= $data['montant'];?> FCFA</td>
                                    <td>
                                        <?php if ($data['status'] == 'Validée' OR $data['status'] == 'Non Validée'  ): ?>
                                            <button onclick="cancelReservation(<?= $data['id_user'] ?>)">Annuler</button>
                                        <?php elseif ($data['status'] == 'Effectuée' && empty($data['id_avis'])): ?>
                                            <button onclick="leaveReview(<?= $data['id_user'] ?>)">Laisser un avis</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php  }else{?>
                                <h2 style="text-align: center; margin-top: 60px;">Aucune réservation pour l'instant.</h2>
                        <?php }?>
        </main>

<script src="../js/research.js"></script>
</body>
</html>





   