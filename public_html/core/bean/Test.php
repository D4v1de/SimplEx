<?php

/**
 * La classe descrive un test.
 *
 * @author Giuseppina Tufano
 * @version 1.0
 * @since 27/11/15
 */

class Test {
    private $id;
    private $descrizione;
    private $punteggioMax;
    private $numeroMultiple;
    private $numeroAperte;
    private $percentualeSceltoEse;
    private $percentualeSuccessoEse;
    private $percentualeSceltoVal;
    private $percentualeSuccessoVal;
    private $numeroSceltaEsercitativa;
    private $numeroSceltaValutativa;
    private $corsoId;

    /**
     * Costruttore di Test
     * @param string $descrizione La descrizione del test
     * @param float $punteggioMax Il punteggio massimo del test
     * @param int $numeroMultiple Numero di domande multiple
     * @param int $numeroAperte Numero di domande aperte
     * @param float $percentualeSceltoEse Percentuale di volte in cui il test viene scelto per sessioni esercitative
     * @param float $percentualeSuccessoEse Percentuale di successo del test nelle sessioni esercitative
     * @param float $percentualeSceltoVal Percentuale di volte in cui il test viene scelto per sessioni valutative
     * @param float $percentualeSuccessoVal Percentuale di successo del test nelle sessioni valutative
     * @param int $numeroSceltaEsercitativa Il numero di volte che il test è stato scelto per sessioni esercitative
     * @param int $numeroSceltaValutativa Il numero di volte che il test è stato scelto per sessioni valutative
     * @param int $corso_id L'id del corso a cui appartiene
     */
    public function __construct($descrizione, $punteggioMax, $numeroMultiple, $numeroAperte, $percentualeSceltoEse, $percentualeSuccessoEse, $percentualeSceltoVal, $percentualeSuccessoVal, $numeroSceltaEsercitativa, $numeroSceltaValutativa, $corsoId) {
        $this->descrizione=$descrizione;
        $this->punteggioMax=$punteggioMax;
        $this->numeroMultiple=$numeroMultiple;
        $this->numeroAperte=$numeroAperte;
        $this->percentualeSceltoEse=$percentualeSceltoEse;
        $this->percentualeSuccessoEse=$percentualeSuccessoEse;
        $this->percentualeSceltoVal=$percentualeSceltoVal;
        $this->percentualeSuccessoVal=$percentualeSuccessoVal;
        $this->numeroSceltaEsercitativa=$numeroSceltaEsercitativa;
        $this->numeroSceltaValutativa=$numeroSceltaValutativa;
        $this->corsoId = $corsoId;
    } 
    
    /**
     * @return int L'id del test
     */
    function getId() {
        return $this->id;
    }
    
    /**
     * @return string La descrizione del test
     */
    function getDescrizione() {
        return $this->descrizione;
    }

    /**
     * @return float Il punteggio massimo del test
     */
    function getPunteggioMax() {
        return $this->punteggioMax;
    }

    /**
     * @return int Il numero di domande multiple del test
     */
    function getNumeroMultiple() {
        return $this->numeroMultiple;
    }

    /**
     * @return int Il numero di domande aperte del test
     */
    function getNumeroAperte() {
        return $this->numeroAperte;
    }

    /**
     * @return float La percentuale delle volte in cui il test è stato scelto per le sessioni esercitative
     */
    function getPercentualeSceltoEse() {
        return $this->percentualeSceltoEse;
    }

    /**
     * @return float La percentuale di successo del test nelle sessioni esercitative
     */
    function getPercentualeSuccessoEse() {
        return $this->percentualeSuccessoEse;
    }

    /**
     * @return float La percentuale delle volte in cui il test è stato scelto per le sessioni valutative
     */
    function getPercentualeSceltoVal() {
        return $this->percentualeSceltoVal;
    }

    /**
     * @return float La percentuale di successo del test nelle sessioni valutative
     */
    function getPercentualeSuccessoVal() {
        return $this->percentualeSuccessoVal;
    }

    /**
     * @return int Il numero di volte che il test è stato scelto per sessioni esercitative
     */
    function getNumeroSceltaEsercitativa() {
        return $this->numeroSceltaEsercitativa;
    }

    /**
     * @return int Il numero di volte che il test è stato scelto per sessioni valutative
     */
    function getNumeroSceltaValutativa() {
        return $this->numeroSceltaValutativa;
    }

    /**
     * @return int L'id del corso a cui appartiene
     */
    function getCorsoId() {
        return $this->corsoId;
    }
        
    /**
     * Setta l'id del test
     * @param int $id L'id del test
     */
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Setta la descrizione della sessione
     * @param string $descrizione La descrizione del test
     */
    function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
    }

    /**
     * Setta il punteggio massimo del test
     * @param float $punteggioMax Il punteggio massimo del test
     */
    function setPunteggioMax($punteggioMax) {
        $this->punteggioMax = $punteggioMax;
    }

    /**
     * Setta il numero di domande multiple del test
     * @param int $numeroMultiple Il numero di domande multiple del test
     */
    function setNumeroMultiple($numeroMultiple) {
        $this->numeroMultiple = $numeroMultiple;
    }

    /**
     * Setta il numero di domande aperte del test
     * @param int $numeroAperte Il numero di domande aperte del test
     */
    function setNumeroAperte($numeroAperte) {
        $this->numeroAperte = $numeroAperte;
    }

    /**
     * Setta la percentuale delle volte in cui il test è stato scelto per le sessioni esercitative
     * @param float $percentualeSceltoEse La percentuale di volte in cui il test è stato scelto per le sessioni esercitative
     */
    function setPercentualeSceltoEse($percentualeSceltoEse) {
        $this->percentualeSceltoEse = $percentualeSceltoEse;
    }

    /**
     * Setta la percentuale di successo del test nelle sessioni esercitative
     * @param float $percentualeSuccessoEse La percentuale di successo del test nelle sessioni esercitative
     */
    function setPercentualeSuccessoEse($percentualeSuccessoEse) {
        $this->percentualeSuccessoEse = $percentualeSuccessoEse;
    }

    /**
     * Setta la percentuale delle volte in cui il test è stato scelto per le sessioni valutative
     * @param float $percentualeScelto La percentuale di volte in cui il test è stato scelto per le sessioni valutative
     */
    function setPercentualeSceltoVal($percentualeSceltoVal) {
        $this->percentualeSceltoVal = $percentualeSceltoVal;
    }

    /**
     * Setta la percentuale di successo del test nelle sessioni valutative
     * @param float $percentualeSuccessoVal La percentuale di successo del test nelle sessioni valutative
     */
    function setPercentualeSuccessoVal($percentualeSuccessoVal) {
        $this->percentualeSuccessoVal = $percentualeSuccessoVal;
    }

    /**
     * Setta il numero di volte che il test è stato scelto per sessioni esercitative
     * @param int $numeroSceltaEsercitativa Il numero di volte che il test è stato scelto per sessioni esercitative
     */
    function setNumeroSceltaEsercitativa($numeroSceltaEsercitativa) {
        $this->numeroSceltaEsercitativa = $numeroSceltaEsercitativa;
    }

    /**
     * Setta il numero di volte che il test è stato scelto per sessioni valutative
     * @param int $numeroSceltaEsercitativa Il numero di volte che il test è stato scelto per sessioni valutative
     */
    function setNumeroSceltaValutativa($numeroSceltaValutativa) {
        $this->numeroSceltaValutativa = $numeroSceltaValutativa;
    }

    /**
     * Setta l'id del corso a cui appartiene
     * @param int $corsoId L'id del corso a cui appartiene
     */
    function setCorsoId($corsoId) {
        $this->corsoId = $corsoId;
    }
}