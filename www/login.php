<?php

session_start(); //riprende la sessione di index.php

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

        $sql = "SELECT Nome, Password FROM UTENTI WHERE Nome = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$nome]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        
        if (!$user) {
            echo "<script>
                alert('Nome utente non trovato!');
                window.location.href = 'login.php'; 
              </script>";
              exit();
        }

        if (password_verify($password, $user->Password)) { // verifico se l'utente esiste e se la password corrisponde all'hash salvato

            $_SESSION['logged_in'] = true;

            header("Location: index.php");
            exit();
        } else {
            echo "<script>
                alert('Password non valida!');
                window.location.href = 'login.php'; 
              </script>";
        }

    } catch (PDOException $e) { //window.location.href sposta l'utente nella pagina dichiarata
        echo "<script>
                alert('Errore nel database!');
                window.location.href = 'login.php'; 
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
    <title>Login</title>
</head>
<body>
    <header>
        <h1>Classifica globale di Spotify</h1>
    </header>
    <div class="container-forms">
        <div class="card_login">
            <h1>Effettua il login</h1>
            <form method="post" action="">
                <input type="text" name="name" placeholder="Nome utente" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
            </form>
            <a href="registrazione.php">Registrati</a>
        </div>
    </div>
</body>
</html>