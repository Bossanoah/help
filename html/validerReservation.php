<?php 
    session_start();

if ( isset($_POST['submit'])){
   /* echo '<pre>';
    print_r($_POST['heure']);
    echo '</pre>';*/
    $cns = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($cns,"socialhelp");
    $nom = htmlspecialchars($_POST['nom']); 
    $adresse = htmlspecialchars($_POST['adresse']); 
    $date_d = htmlspecialchars($_POST['date_d']); 
    $date_f = htmlspecialchars($_POST['date_f']); 
    $heure = htmlspecialchars($_POST['heure']); 
    $heure_d = htmlspecialchars($_POST['heure_d']); 
    $service_id = (int)$_POST['service_id']; 
    $comment= htmlspecialchars($_POST['comment']); 
    $status ="Non Validée";
    if(isset($_POST['id_professionnel'])){
      $id_prof =$_SESSION['prof'];
    }else{
        $id_prof = null;
    }
    if(isset($_POST['nbrp'])){
      $nbrp = $_POST['nbrp'];
    }else{
      $nbrp = 0 ;
    }
    $comment = "Nom client :". $nom ."*/  " .$comment;
    $date = date('Y-m-d');
    $date_d = date('Y-m-d', strtotime($date_d));
    $date_f = date('Y-m-d', strtotime($date_f));

    /*Requete pour avoir le prix du service */
    $query = "SELECT prix_heure FROM service WHERE id_service = ?";
    $stmt = mysqli_prepare($cns, $query);
    mysqli_stmt_bind_param($stmt, "i", $service_id); 
    mysqli_stmt_execute($stmt); 
    $result = mysqli_stmt_get_result($stmt);

    if ($data = mysqli_fetch_assoc($result)) {
        $prix_h = $data['prix_heure'];
    }
     /* prix reservation*/ 
      $montant = ($prix_h * $heure) + 1000;
      $_SESSION['montant'] = $montant;
      if ($heure == 1){
        $heure ="1 heures";
      }elseif($heure == 1.5){
        $heure ="1:30mins";
      }elseif($heure == 2){
        $heure ="2 heures";
      }elseif($heure == 2.5){
        $heure ="2:30mins";
      }elseif($heure == 3){
        $heure ="3 heures";
      }elseif($heure == 3.5){
        $heure ="3:30mins";
      }elseif($heure == 4){
        $heure ="4 heures";
      }elseif($heure == 4.5){
        $heure ="4:30mins";
      }elseif($heure == 5){
        $heure ="5 heures";
      }elseif($heure == 5.5){
        $heure ="5:30mins";
      }elseif($heure == 6){
        $heure ="6 heures";
      }elseif($heure == 6.5){
        $heure ="6:30mins ";
      }elseif($heure == 7){
        $heure ="7 heures";
      }elseif($heure == 7.5){
        $heure ="7:30mins";
      }elseif($heure == 8){
        $heure ="8 heures";
      }
       
         $req = "INSERT INTO reservation (date_reservation, date_debut, date_fin, heure_debut, nombre_heure, montant, status, id_prof, id_user, id_service, commentaire, adresse_res, nbr_piece)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
        $stmt = mysqli_prepare($cns, $req);
        mysqli_stmt_bind_param($stmt, "ssssdsdssssds", 
        $date, $date_d, $date_f, $heure_d, $heure, $montant, $status, 
        $id_prof, $_SESSION['client'], $service_id, $comment, $adresse, $nbrp);
        mysqli_stmt_execute($stmt);
       echo'<script>
            alert("Reservation Enregistrer ");
            </script>;';
       header("Location: paiement.php");
        exit();
    
}
?>