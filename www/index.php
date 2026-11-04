
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

    $sql = "SELECT IdCanzone, Nome, PosClassifica, NumStream, AnnoPubblicazione
     FROM Canzone ORDER BY PosClassifica";

    $query = $pdo->query($sql);

    // Recupera gli utenti come oggetti.
    $canzoni = $query->fetchAll(PDO::FETCH_OBJ);
    if (count($canzoni) === 0) {
        echo "<p>Nessun utente registrato.</p>";
		return;
    }
    // Stampa i dati di ogni utente.
    foreach ($canzoni as $canzone) {
        echo "<h5>Id Canzone: " . $canzone->IdCanzone . "</h5>";
        echo "<p>Nome: " . htmlspecialchars($canzone->Nome) . "</p>";
        echo "<p>Posizione classifica: " . htmlspecialchars($canzone->PosClassifica) . "</p>";
        echo "<p>Numero streams: " . htmlspecialchars($canzone->NumStream) . "</p>";
        echo "<p>Anno pubblicazione: " . htmlspecialchars($canzone->AnnoPubblicazione) . "</p>";
        echo "<hr>";
    }
    ?>
</body>
</html>