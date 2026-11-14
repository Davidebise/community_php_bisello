<?php

// Esegue il codice solo se viene inviato un form tramite POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tipoForm = $_POST["form_tipo"] ?? ""; //input di tipo hidden che mi serve per identificare il form

    try {
        // Connessione al database
        $pdo = new PDO(
            "mysql:host=db;dbname=communitydb;charset=utf8mb4",
            getenv("DB_USER"),
            getenv("DB_PASSWORD")
        );

        // 1. GESTIONE INSERIMENTO CANZONE
        if ($tipoForm === "canzone") {
            $nome = $_POST["name"] ?? "";
            $anno = $_POST["year"] ?? "";
            $num_stream = $_POST["streams"] ?? "";
            $posizione = $_POST["position"] ?? "";

            $sql = "INSERT INTO CANZONE (Nome, NumStream, PosClassifica, AnnoPubblicazione) VALUES (?, ?, ?, ?)";
            $query = $pdo->prepare($sql);
            $query->execute([$nome, $num_stream, $posizione, $anno]);

            header("Location: index.php?registrato=1");
            exit;
        }

        // 2. GESTIONE INSERIMENTO ARTISTA
        elseif ($tipoForm === "artista") {
            $nome = $_POST["name_artista"] ?? "";
            $ascoltatori = $_POST["listeners"] ?? "";
            $posizione = $_POST["position_artista"] ?? "";
            $etichetta = $_POST["etichetta"] ?? "";

            $sql = "INSERT INTO ARTISTA (Nome, AscoltatoriMensili, PosClassifica, Etichetta) VALUES (?, ?, ?, ?)";
            $query = $pdo->prepare($sql);
            $query->execute([$nome, $ascoltatori, $posizione, $etichetta]);

            header("Location: index.php?registrato=1");
            exit;
        }

        // 3. GESTIONE INSERIMENTO ALBUM
        elseif ($tipoForm === "album") {
            $nome = $_POST["name_album"] ?? "";
            $posizione = $_POST["position_album"] ?? "";
            $genere = $_POST["genere"] ?? "";
            $num_stream = $_POST["streams_album"] ?? "";

            $sql = "INSERT INTO ALBUM (Nome, PosClassifica, Genere, NumStream) VALUES (?, ?, ?, ?)";
            $query = $pdo->prepare($sql);
            $query->execute([$nome, $posizione, $genere, $num_stream]);

            header("Location: index.php?registrato=1");
            exit;
        }

    } catch (PDOException $e) { //window.location.href sposta l'utente nella pagina dichiarata
        echo "<script>
                alert('Errore durante l\'inserimento nel database!');
                window.location.href = 'add.php'; 
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style_add.css">
    <title>Aggiungi Canzone</title>
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
    <div class="container-forms">
        <div class="card_songs">
            <h1>Aggiungi una canzone</h1>
            <form method="post" action="">
                <input type="hidden" name="form_tipo" value="canzone">
                <input type="text" name="name" placeholder="Nome Canzone" required>
                <input type="number" name="streams" placeholder="Numero Stream" required>
                <input type="number" name="position" placeholder="Posizione Classifica" required>
                <input type="number" name="year" placeholder="Anno Pubblicazione" required>
                <input type="submit" value="Aggiungi Canzone">
            </form>
        </div>

        <div class="card_artist">
            <h1>Aggiungi un artista</h1>
            <form method="post" action="">
                <input type="hidden" name="form_tipo" value="artista">
                <input type="text" name="name_artista" placeholder="Nome Artista" required>
                <input type="number" name="listeners" placeholder="Ascoltatori Mensili" required>
                <input type="number" name="position_artista" placeholder="Posizione Classifica" required>
                <input type="text" name="etichetta" placeholder="Etichetta" required>
                <input type="submit" value="Aggiungi Artista">
            </form>
        </div>

        <div class="card_album">
            <h1>Aggiungi un album</h1>
            <form method="post" action="">
                <input type="hidden" name="form_tipo" value="album">
                <input type="text" name="name_album" placeholder="Nome Album" required>
                <input type="number" name="position_album" placeholder="Posizione Classifica" required>
                <input type="text" name="genere" placeholder="Genere" required>
                <input type="number" name="streams_album" placeholder="Numero Stream" required>
                <input type="submit" value="Aggiungi Album">
            </form>
        </div>
    </div>
</body>

</html>