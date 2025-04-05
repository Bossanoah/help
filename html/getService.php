<?php
// Vérifie si l'ID du service est passé dans la requête
if (isset($_GET['service_id'])) {
   
    $cns = mysqli_connect("localhost", "root", "", "socialhelp");
    $service_id = $_GET['service_id'];

    // Requête pour récupérer le prix par heure du service
    $query = "SELECT prix_heure FROM service WHERE id_service = ?";
    $stmt = mysqli_prepare($cns, $query);
    mysqli_stmt_bind_param($stmt, "i", $service_id); 
    mysqli_stmt_execute($stmt); 
    $result = mysqli_stmt_get_result($stmt);

    if ($data = mysqli_fetch_assoc($result)) {
        // Retourner le prix sous forme de JSON
        echo json_encode(['price_per_hour' => $data['prix_heure']]);
    } else {
        echo json_encode(['price_per_hour' => 0]);
    }
} else {
    // Si aucun service ID n'est passé dans la requête, retourner une erreur
    echo json_encode(['error' => 'Service ID manquant']);
}
?>
