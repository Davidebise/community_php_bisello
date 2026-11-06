
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classifica Canzoni</title>
</head>
<body>
    <header>
        <h1>Classifica globale di Spotify</h1>
        <nav class="menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="add.php">Aggiungi</a></li>
                <li><a href="delete.php">Elimina</a></li>
                <li><a href="modify.php">Modifica</a></li>
            </ul>
        </nav>
    </header>
    <?php
       // Connessione al database.
    $pdo = new PDO(
        "mysql:host=db;dbname=communitydb;charset=utf8mb4",
        getenv("DB_USER"),
        getenv("DB_PASSWORD")
    );

    $sql = "SELECT CA.Nome, CA.PosClassifica, CA.NumStream, CA.AnnoPubblicazione
     FROM CANZONE CA
     ORDER BY CA.PosClassifica";

    $query = $pdo->query($sql);

    $canzoni = $query->fetchAll(PDO::FETCH_OBJ);
    if (count($canzoni) === 0) {
        echo "<p>Nessun utente registrato.</p>";
		return;
    }

    foreach ($canzoni as $canzone) {
        echo "<h5>Nome Canzone: " . $canzone->Nome . "</h5>";
        echo "<p>Posizione classifica: " . htmlspecialchars($canzone->PosClassifica) . "</p>";
        echo "<p>Numero streams: " . htmlspecialchars($canzone->NumStream) . "</p>";
        echo "<p>Anno pubblicazione: " . htmlspecialchars($canzone->AnnoPubblicazione) . "</p>";
        echo "<br>";
    }
    ?>
</body>
</html>