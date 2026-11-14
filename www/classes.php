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

    public function getIdCanzone() { return $this->IdCanzone; }
    public function getNome() { return $this->Nome; }
    public function getPosClassifica() { return $this->PosClassifica; }
    public function getNumStream() { return $this->NumStream; }
    public function getAnnoPubblicazione() { return $this->AnnoPubblicazione; }
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


    public function getIdArtista() { return $this->IdArtista; }
    public function getNome() { return $this->Nome; }
    public function getAscoltatoriMensili() { return $this->AscoltatoriMensili; }
    public function getPosClassifica() { return $this->PosClassifica; }
    public function getEtichetta() { return $this->Etichetta; }
}


class Album {
    private $IdAlbum;
    private $Nome;
    private $PosClassifica;
    private$Genere;
    private $NumStream;

    public function __construct($IdAlbum, $Nome, $PosClassifica, $Genere, $NumStream) {
        $this->IdAlbum = $IdAlbum;
        $this->Nome = $Nome;
        $this->PosClassifica = $PosClassifica;
        $this->Genere = $Genere;
        $this->NumStream = $NumStream;
    }

    public function getIdAlbum() { return $this->IdAlbum; }
    public function getNome() { return $this->Nome; }
    public function getPosClassifica() { return $this->PosClassifica; }
    public function getGenere() { return $this->Genere; }
    public function getNumStream() { return $this->NumStream; }
}

?>