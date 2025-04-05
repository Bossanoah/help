<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tarif.css">
    <link rel="icon" href="../src/SH.jpg" type="image/jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
             <li ><a href="index.php">A Propos</a></li>
             <li ><a href="index.php">Services</a></li>
            
             <li ><a href="FAQ.php">FAQ</a></li>
              <div class="dropdown" ><p><a href="##">Menu </a></p>
                    <div class="dropdown-content">
                        <li><a href="Tarif.php">Tarif</a></li>
                        <li><a href="avisclient.php">Avis </a></li>
                    </div>
                </div>
             <li><a href="postuler.php">Postulez</a></li>
             <li><a href="clientconnect.php">Espace client</a></li>
         </ul>
     </nav>

    <main>
        <div class="img">
            <img src="../src/avs.jpg">
        </div>
        <div class="note"> 
            <h1>Prix des prestations à domicile <br/>avec Social Help</h1>
            <h2>Des tarifs transparents et avantageux !</h2>
            <div class="button">
                <a href="postuler.php"><button type="button">Réjoinez nous</button></a>
                <a href="clientconnect2.php"><button type="button">Réserver</button></a>
            </div>
        </div>
        <header>
            <h1>Tarifs des Services</h1>
        </header>
        <section class="table-container">
            <?php
            $cns = mysqli_connect("localhost","root","");
            $db = mysqli_select_db($cns,"socialhelp");
            $req = "SELECT * FROM service";
            $result = $cns->query($req);
            if ($result->num_rows > 0) {
                echo "<table><tr><th>Service</th><th>Description<th>Tarif par heure (FCFA)</th></tr>";
                while ($data = $result->fetch_assoc()) {
                    echo "<tr class = 'table-result'><td>" . htmlspecialchars($data['nom']) . "</td><td>" . htmlspecialchars($data['description']) . "</td><td>" . number_format($data['prix_heure'], 0, ',', ' ') . " FCFA</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Aucun service disponible.</p>";
            }
            $cns->close();
            ?>
        </section>
        
    </main>
    <script src="../js/navbar.js"></script>
</body>
</html> 