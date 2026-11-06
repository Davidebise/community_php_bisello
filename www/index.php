
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style_index.css">
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
        echo "<p>Nessuna canzone registrata.</p>";
		return;
    }
    ?>
    <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Posizione</th>
                    <th>Nome Canzone</th>
                    <th>Numero Stream</th>
                    <th>Anno Pubblicazione</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($canzoni as $canzone) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($canzone->PosClassifica) . "</td>";
                    echo "<td>" . htmlspecialchars($canzone->Nome) . "</td>";
                    echo "<td>" . htmlspecialchars($canzone->NumStream) . "</td>";
                    echo "<td>" . htmlspecialchars($canzone->AnnoPubblicazione) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
</body>
</html>