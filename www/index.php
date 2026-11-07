<?php
       // Connessione al database.
    $pdo = new PDO(
        "mysql:host=db;dbname=communitydb;charset=utf8mb4",
        getenv("DB_USER"),
        getenv("DB_PASSWORD")
    );

    $queryCanzoni = $pdo->query("SELECT Nome, PosClassifica, NumStream, AnnoPubblicazione
     FROM CANZONE 
     ORDER BY PosClassifica");

    $canzoni = $queryCanzoni->fetchAll(PDO::FETCH_OBJ);
    if (count($canzoni) === 0) {
        echo "<p>Nessuna canzone registrata.</p>";
    }

    $queryArtisti = $pdo->query("SELECT Nome, AscoltatoriMensili, PosClassifica, Etichetta 
    FROM ARTISTA
    ORDER BY PosClassifica");
    $artisti = $queryArtisti->fetchAll(PDO::FETCH_OBJ);
    if (count($artisti) === 0) {
        echo "<p>Nessun artista registrato.</p>";
    }

    $queryAlbum = $pdo->query("SELECT Nome, PosClassifica, Genere, NumStream 
    FROM ALBUM
    ORDER BY PosClassifica");
    $album = $queryAlbum->fetchAll(PDO::FETCH_OBJ);
    if (count($album) === 0) {
        echo "<p>Nessuna album registrato.</p>";
    }
    ?>

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
    
    <div class="table-container">
        <h2>Tabella Canzoni</h2>
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
        <br>

        <h2>Tabella Artisti</h2>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Nome Artista</th>
                    <th>Posizione</th>
                    <th>Ascoltatori Mensili</th>
                    <th>Etichetta</th>
                </tr>
            </thead>
            <tbody>
                <?php
        foreach ($artisti as $artista) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($artista->Nome) . "</td>";
            echo "<td>" . htmlspecialchars($artista->PosClassifica) . "</td>";
            echo "<td>" . htmlspecialchars($artista->AscoltatoriMensili) . "</td>";
            echo "<td>" . htmlspecialchars($artista->Etichetta) . "</td>";
            echo "</tr>";
        }
        ?>
            </tbody>
        </table>

        <h2>Tabella Album</h2>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Nome Album</th>
                    <th>Posizione</th>
                    <th>Genere</th>
                    <th>Numero Stream</th>
                </tr>
            </thead>
            <tbody>
                <?php
        foreach ($album as $al) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($al->Nome) . "</td>";
            echo "<td>" . htmlspecialchars($al->PosClassifica) . "</td>";
            echo "<td>" . htmlspecialchars($al->Genere) . "</td>";
            echo "<td>" . htmlspecialchars($al->NumStream) . "</td>";
            echo "</tr>";
        }
        ?>
            </tbody>
        </table>
    </div>
</body>

</html>