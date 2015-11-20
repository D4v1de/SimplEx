<?php

/**
 * User: Giuseppina
 * Date: 20/11/15
 * Time: 16:40
 */
class Test {
    private $id;
    private $descrizione;
    private $punteggioMax;
    private $numeroMultiple;
    private $numeroAperte;
    private $percentualeScelto;
    private $percentualeSuccesso;

    /**
     * Costruttore di Test
     * @param $id id del test
     * @param $descrizione Descrizione del test
     * @param $punteggioMax Punteggio massimo del test
     * @param $numeroMultiple Numero domande multiple
     * @param $numeroAperte Numero domande aperte
     * @param $percentualeScelto Percentuale di volte in cui il test viene scelto
     * @param $percentualeSuccesso Percentuale di successo del test
     */
    public function __construct($id, $descrizione, $punteggioMax, $numeroMultiple, $numeroAperte, $percentualeScelto, $percentualeSuccesso) {
        $this->id=$id;
        $this->descrizione=$descrizione;
        $this->punteggioMax=$punteggioMax;
        $this->numeroMultiple=$numeroMultiple;
        $this->numeroAperte=$numeroAperte;
        $this->percentualeScelto=$percentualeScelto;
        $this->percentualeSuccesso=$percentualeSuccesso;
    } 
    
     /**
     * @return l'id del test
     */
    function getId() {
        return $this->id;
    }
    
     /**
     * @return la descrizione del test
     */
    function getDescrizione() {
        return $this->descrizione;
    }

     /**
     * @return il punteggio massimo del test
     */
    function getPunteggioMax() {
        return $this->punteggioMax;
    }

     /**
     * @return il numero di domande multiple del test
     */
    function getNumeroMultiple() {
        return $this->numeroMultiple;
    }

     /**
     * @return il numero di domande aperte del test
     */
    function getNumeroAperte() {
        return $this->numeroAperte;
    }

     /**
     * @return la percentuale delle volte in cui il test è stato scelto
     */
    function getPercentualeScelto() {
        return $this->percentualeScelto;
    }

     /**
     * @return la percentuale di successo del test
     */
    function getPercentualeSuccesso() {
        return $this->percentualeSuccesso;
    }
        
    /**
     * Setta l'id del test
     * @param $id id del test
     */
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Setta la descrizione della sessione
     * @param $descrizione descrizione del test
     */
    function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
    }

    /**
     * Setta il punteggio massimo del test
     * @param $punteggioMax punteggio massimo del test
     */
    function setPunteggioMax($punteggioMax) {
        $this->punteggioMax = $punteggioMax;
    }

    /**
     * Setta il numero di domande multiple del test
     * @param $numeroMultiple numero di domande multiple del test
     */
    function setNumeroMultiple($numeroMultiple) {
        $this->numeroMultiple = $numeroMultiple;
    }

     /**
     * Setta il numero di domande aperte del test
     * @param $numeroAperte numero di domande aperte del test
     */
    function setNumeroAperte($numeroAperte) {
        $this->numeroAperte = $numeroAperte;
    }

     /**
     * Setta la percentuale delle volte in cui il test è stato scelto
     * @param $percentualeScelto la percentuale di volte in cui il test è stato scelto
     */
    function setPercentualeScelto($percentualeScelto) {
        $this->percentualeScelto = $percentualeScelto;
    }

     /**
     * Setta la percentuale di successo del test
     * @param $percentualeSuccesso la percentuale di successo del test
     */
    function setPercentualeSuccesso($percentualeSuccesso) {
        $this->percentualeSuccesso = $percentualeSuccesso;
    }
}