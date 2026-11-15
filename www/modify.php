<?php
require_once 'classes.php'; //in questo modo viene incluso il file contenente le classi

// Esegue il codice solo se viene inviato un form tramite POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tipoForm = $_POST["form_tipo"] ?? ""; //input di tipo hidden che mi serve per identificare il form
    
    $pdo = new PDO(
            "mysql:host=db;dbname=communitydb;charset=utf8mb4",
            getenv("DB_USER"),
            getenv("DB_PASSWORD")
        );
 
        if ($tipoForm === "canzone") {
            
            $id= $_POST["id_canzone"] ?? "";
            $nome = $_POST["name"] ?? "";
            $anno = $_POST["year"] ?? "";
            $num_stream = $_POST["streams"] ?? "";
            $posizione = $_POST["position"] ?? "";

            $sql = "SELECT IdCanzone, Nome, PosClassifica, NumStream, AnnoPubblicazione
            FROM CANZONE 
            WHERE IdCanzone = ?";
            $query = $pdo->prepare($sql);
            $query->execute([$id]);

            $row = $query->fetch(PDO::FETCH_OBJ); //prendo la canzone con l'id scritto dall'utente e ci metto i campi originali
            $song = new Canzone($row->IdCanzone,$row->Nome,$row->PosClassifica,$row->NumStream,$row->AnnoPubblicazione);
            
            if($nome !== ""){  //sostiuisco i valori vecchi con quelli nuovi
                $song->setNome($nome);
            }
            if($anno !== ""){
                $song->setAnnoPubblicazione($anno);
            }
            if($num_stream !== ""){
                $song->setNumStream($num_stream);
            }
            if($posizione !== ""){
                $song-> setPosClassifica($posizione);
            }
            
            Canzone::modifySong($song);

            header("Location: index.php?registrato=1");
            exit;
        }

       
        elseif ($tipoForm === "artista") {
            $id= $_POST["id_artista"] ?? "";
            $nome = $_POST["name_artista"] ?? "";
            $ascoltatori = $_POST["listeners"] ?? "";
            $posizione = $_POST["position_artista"] ?? "";
            $etichetta = $_POST["etichetta"] ?? "";

            $sql = "SELECT IdArtista, Nome, AscoltatoriMensili, PosClassifica, Etichetta
            FROM ARTISTA 
            WHERE IdArtista = ?";

            $query = $pdo->prepare($sql);
            $query->execute([$id]);

            $row = $query->fetch(PDO::FETCH_OBJ); //fetch e non fetchall perchè è solo un oggetto
            $artista = new Artista($row->IdArtista,$row->Nome,$row->AscoltatoriMensili,$row->PosClassifica,$row->Etichetta);

            if($nome !== ""){  //sostiuisco i valori vecchi con quelli nuovi
                $artista->setNome($nome);
            }
            if($ascoltatori !== ""){
                $artista->setAscoltatoriMensili($ascoltatori);
            }
            if($posizione !== ""){
                $artista->setPosClassifica($posizione);
            }
            if($etichetta !== ""){
                $artista-> setEtichetta($etichetta);
            }

            Artista::modifyArtist($artista);
            header("Location: index.php?registrato=1");
            exit;
        }

    
        elseif ($tipoForm === "album") {
            $id= $_POST["id_album"] ?? "";
            $nome = $_POST["name_album"] ?? "";
            $posizione = $_POST["position_album"] ?? "";
            $genere = $_POST["genere"] ?? "";
            $num_stream = $_POST["streams_album"] ?? "";

            $sql = "SELECT IdAlbum, Nome, PosClassifica, Genere, NumStream
            FROM ALBUM 
            WHERE IdAlbum = ?";

            $query = $pdo->prepare($sql);
            $query->execute([$id]);

            $row = $query->fetch(PDO::FETCH_OBJ); 
            $album = new Album($row->IdAlbum,$row->Nome,$row->PosClassifica,$row->Genere,$row->NumStream);
            
            if($nome !== ""){  //sostiuisco i valori vecchi con quelli nuovi
                $album->setNome($nome);
            }
            if($posizione !== ""){
                $album->setPosClassifica($posizione);
            }
            if($num_stream !== ""){
                $album->setNumStream($num_stream);
            }
            if($genere !== ""){
                $album-> setGenere($genere);
            }
            
            Album::modifyAlbum($album);
            header("Location: index.php?registrato=1");

            exit;
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
            <h1>Modifica una canzone</h1>
            <form method="post" action="">
                <input type="hidden" name="form_tipo" value="canzone">
                <input type="number" name="id_canzone" placeholder="Id Canzone" required>
                <input type="text" name="name" placeholder="Nome Canzone">
                <input type="number" name="streams" placeholder="Numero Stream">
                <input type="number" name="position" placeholder="Posizione Classifica">
                <input type="number" name="year" placeholder="Anno Pubblicazione">
                <input type="submit" value="Modifica Canzone">
            </form>
        </div>

        <div class="card_artist">
            <h1>Modifica un artista</h1>
            <form method="post" action="">
                <input type="hidden" name="form_tipo" value="artista">
                <input type="number" name="id_artista" placeholder="Id Artista" required>
                <input type="text" name="name_artista" placeholder="Nome Artista">
                <input type="number" name="listeners" placeholder="Ascoltatori Mensili">
                <input type="number" name="position_artista" placeholder="Posizione Classifica">
                <input type="text" name="etichetta" placeholder="Etichetta">
                <input type="submit" value="Modifica Artista">
            </form>
        </div>

        <div class="card_album">
            <h1>Modifica un album</h1>
            <form method="post" action="">
                <input type="hidden" name="form_tipo" value="album">
                <input type="number" name="id_album" placeholder="Id Album" required>
                <input type="text" name="name_album" placeholder="Nome Album">
                <input type="number" name="position_album" placeholder="Posizione Classifica">
                <input type="text" name="genere" placeholder="Genere">
                <input type="number" name="streams_album" placeholder="Numero Stream">
                <input type="submit" value="Modifica Album">
            </form>
        </div>
    </div>
</body>

</html>