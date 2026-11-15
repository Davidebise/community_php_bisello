<?php 

class Canzone {
    private $IdCanzone;
    private $Nome;
    private $PosClassifica;
    private $NumStream;
    private $AnnoPubblicazione;

    public function __construct($IdCanzone, $Nome, $PosClassifica, $NumStream, $AnnoPubblicazione) {
        $this->IdCanzone = $IdCanzone;
        $this->Nome = $Nome;
        $this->PosClassifica = $PosClassifica;
        $this->NumStream = $NumStream;
        $this->AnnoPubblicazione = $AnnoPubblicazione;
    }

    //getter
    public function getIdCanzone() { return $this->IdCanzone; }
    public function getNome() { return $this->Nome; }
    public function getPosClassifica() { return $this->PosClassifica; }
    public function getNumStream() { return $this->NumStream; }
    public function getAnnoPubblicazione() { return $this->AnnoPubblicazione; }


    // setter

    public function setNome($Nome) {
        $this->Nome = $Nome;
    }

    public function setPosClassifica($PosClassifica) {
        $this->PosClassifica = $PosClassifica;
    }

    public function setNumStream($NumStream) {
        $this->NumStream = $NumStream;
    }

    public function setAnnoPubblicazione($AnnoPubblicazione) {
        $this->AnnoPubblicazione = $AnnoPubblicazione;
    }

    public static function modifySong($c){
        $pdo = new PDO(
            "mysql:host=db;dbname=communitydb;charset=utf8mb4",
            getenv("DB_USER"),
            getenv("DB_PASSWORD")
        );

        try{
            $sql = "UPDATE CANZONE SET Nome = ?, PosClassifica = ?, 
            NumStream = ?, AnnoPubblicazione = ?
            WHERE IdCanzone = ?";
            $query = $pdo->prepare($sql);
            $query->execute([$c->getNome(), 
            $c->getPosClassifica(), 
            $c->getNumStream(),
            $c->getAnnoPubblicazione(),
            $c->getIdCanzone()
            ]);
        }
        catch (PDOException $e) { //window.location.href sposta l'utente nella pagina dichiarata
            echo "<script>
            alert('Errore durante l\'inserimento nel database!');
            window.location.href = 'modify.php'; 
            </script>";
        }
    }
}


class Artista {
    private $IdArtista;
    private $Nome;
    private $AscoltatoriMensili;
    private $PosClassifica;
    private $Etichetta;

    public function __construct($IdArtista, $Nome, $AscoltatoriMensili, $PosClassifica, $Etichetta) {
        $this->IdArtista = $IdArtista;
        $this->Nome = $Nome;
        $this->AscoltatoriMensili = $AscoltatoriMensili;
        $this->PosClassifica = $PosClassifica;
        $this->Etichetta = $Etichetta;
    }

    //getter
    public function getIdArtista() { return $this->IdArtista; }
    public function getNome() { return $this->Nome; }
    public function getAscoltatoriMensili() { return $this->AscoltatoriMensili; }
    public function getPosClassifica() { return $this->PosClassifica; }
    public function getEtichetta() { return $this->Etichetta; }

    //setter

    public function setNome($Nome) {
        $this->Nome = $Nome;
    }

    public function setAscoltatoriMensili($AscoltatoriMensili) {
        $this->AscoltatoriMensili = $AscoltatoriMensili;
    }

    public function setPosClassifica($PosClassifica) {
        $this->PosClassifica = $PosClassifica;
    }

    public function setEtichetta($Etichetta) {
        $this->Etichetta = $Etichetta;
    }

    public static function modifyArtist($a){
        $pdo = new PDO(
            "mysql:host=db;dbname=communitydb;charset=utf8mb4",
            getenv("DB_USER"),
            getenv("DB_PASSWORD")
        );

        try{
            $sql = "UPDATE ARTISTA SET Nome = ?, AscoltatoriMensili = ?, 
            PosClassifica = ?, Etichetta = ?
            WHERE IdArtista = ?";
            $query = $pdo->prepare($sql);
            $query->execute([$a->getNome(), 
            $a->getAscoltatoriMensili(), 
            $a->getPosClassifica(),
            $a->getEtichetta(),
            $a->getIdArtista()
            ]);
        }
        catch (PDOException $e) { //window.location.href sposta l'utente nella pagina dichiarata
            echo "<script>
            alert('Errore durante l\'inserimento nel database!');
            window.location.href = 'modify.php'; 
            </script>";
        }
    }
}


class Album {
    private $IdAlbum;
    private $Nome;
    private $PosClassifica;
    private $Genere;
    private $NumStream;

    public function __construct($IdAlbum, $Nome, $PosClassifica, $Genere, $NumStream) {
        $this->IdAlbum = $IdAlbum;
        $this->Nome = $Nome;
        $this->PosClassifica = $PosClassifica;
        $this->Genere = $Genere;
        $this->NumStream = $NumStream;
    }

    //getter
    public function getIdAlbum() { return $this->IdAlbum; }
    public function getNome() { return $this->Nome; }
    public function getPosClassifica() { return $this->PosClassifica; }
    public function getGenere() { return $this->Genere; }
    public function getNumStream() { return $this->NumStream; }

    //setter
    public function setNome($Nome) {
        $this->Nome = $Nome;
    }

    public function setPosClassifica($PosClassifica) {
        $this->PosClassifica = $PosClassifica;
    }

    public function setGenere($Genere) {
        $this->Genere = $Genere;
    }

    public function setNumStream($NumStream) {
        $this->NumStream = $NumStream;
    }

    public static function modifyAlbum($a){
        $pdo = new PDO(
            "mysql:host=db;dbname=communitydb;charset=utf8mb4",
            getenv("DB_USER"),
            getenv("DB_PASSWORD")
        );

        try{
            $sql = "UPDATE ALBUM SET Nome = ?, PosClassifica = ?, 
            NumStream = ?, Genere = ?
            WHERE IdAlbum = ?";
            $query = $pdo->prepare($sql);
            $query->execute([$a->getNome(), 
            $a->getPosClassifica(), 
            $a->getNumStream(),
            $a->getGenere(),
            $a->getIdAlbum()
            ]);
        }
        catch (PDOException $e) { //window.location.href sposta l'utente nella pagina dichiarata
            echo "<script>
            alert('Errore durante l\'inserimento nel database!');
            window.location.href = 'modify.php'; 
            </script>";
        }
    }
}

?>