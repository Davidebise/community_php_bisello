<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Canzone</title>
</head>
<body>

    <div class="card">
        <h1>Aggiungi una canzone</h1>
            <?php 
                echo "Buongiorno utente, inserisca i suoi dati";
                // Esegue il codice quando viene inviato il form.
                if ($_SERVER["REQUEST_METHOD"] === "POST") {

                    // Legge i dati inseriti nel form.
                    $nome = $_POST["name"] ?? "";
                    $anno = $_POST["surname"] ?? "";
                    $num_stream = $_POST["email"] ?? "";
                    $posizione = $_POST["password"] ?? "";
                     // Si collega al database MySQL.
                        $pdo = new PDO(
                            "mysql:host=db;dbname=scuola;",
                            getenv("DB_USER"),
                            getenv("DB_PASSWORD")
                        );
                    // Prepara la query di inserimento.
                        $sql = "INSERT INTO Canzone (Nome, NumStream, PosClassifica, AnnoPubblicazione)
                                VALUES (?, ?, ?, ?, ?)";
                        $query = $pdo->prepare($sql);
                        // Inserisce i dati al posto dei quattro punti interrogativi.
                        $query->execute([$nome, $cognome, $email, $password]);
                        // Evita di ripetere l'inserimento aggiornando il browser.
                        header("Location: index.php?registrato=1");
                        exit;
                    }
            ?>
        
        <form method="post" action="add.php">
            <input type="text" id="name" name="name" placeholder="Nome" required>
            <input type="number" id="streams" name="streams" placeholder="Numero Stream" required>
            <input type="number" id="position" name="position" placeholder="Posizione Classifica" required>
            <input type="number" id="year" name="year" placeholder="Anno Pubblicazione" required>
            <input type="submit" id="submit" value="Aggiungi">
        </form>
        <br>

    </div>

</body>
</html>