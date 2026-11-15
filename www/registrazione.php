<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {    
    try {
        // Connessione al database
        $pdo = new PDO(
            "mysql:host=db;dbname=communitydb;charset=utf8mb4",
            getenv("DB_USER"),
            getenv("DB_PASSWORD")
        );

        $nome = $_POST["name"] ?? "";
        $password = $_POST["password"] ?? "";

        $sql = "INSERT INTO UTENTI (Nome, Password) VALUES (?, ?)";
        $query = $pdo->prepare($sql);
        $query->execute([$nome,password_hash($password,PASSWORD_DEFAULT)]);

        header("Location: login.php?registrato=1");
        exit(); //interrompe esecuzione dello script

    } catch (PDOException $e) { //window.location.href sposta l'utente nella pagina dichiarata
        echo "<script>
                alert('Nome utente già preso!');
                window.location.href = 'registrazione.php'; 
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style_login.css">
    <title>Registrazione</title>
</head>
<body>
    <header>
        <h1>Classifica globale di Spotify</h1>
    </header>
    <div class="container-forms">
        <div class="card_login">
            <h1>Registrazione</h1>
            <form method="post" action="registrazione.php">
                <input type="text" name="name" placeholder="Nome utente" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Registrati">
            </form>
        </div>
    </div>
</body>
</html>