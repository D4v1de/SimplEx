<?php

/**
 * La classe descrive una domanda aperta.
 *
 * @author Alina Korniychuk
 * @version 1.0
 * @since 27/11/15
 */
class DomandaAperta {
    private $id;
    private $argomentoId;
    private $testo;
    private $punteggioMax;
    private $percentualeSceltaEse;
    private $percentualeSceltaVal;
    
    /**
     * Costruttore di DomandaAperta.
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param string $testo Il testo della domanda
     * @param float $punteggioMax Il punteggio max della domanda
     * @param float $percentualeSceltaEse La percentuale di volte in cui è stata scelta quella domanda per le sessioni esercitative
     * @param float $percentualeSceltaVal La percentuale di volte in cui è stata scelta quella domanda per le sessioni valutative
     */
    function __construct($argomentoId, $testo, $punteggioMax, $percentualeSceltaEse, $percentualeSceltaVal) {
        $this->argomentoId = $argomentoId;
        $this->testo = $testo;
        $this->punteggioMax = $punteggioMax;
        $this->percentualeSceltaEse = $percentualeSceltaEse;
        $this->percentualeSceltaVal = $percentualeSceltaVal;
    }
    
    /**
     * @return int L'id della domanda aperta
     */
    function getId() {
        return $this->id;
    }
    
    /**
     * @return int L'id dell'argomento della domanda aperta
     */ 
    function getArgomentoId() {
        return $this->argomentoId;
    }

    /**
     * @return string Il testo della domanda aperta
     */
    function getTesto() {
        return $this->testo;
    }
    
    /**
     * @return float Il punteggio massimo della domanda aperta
     */
    function getPunteggioMax() {
        return $this->punteggioMax;
    }

    /**
     * @return float La percentuale di quante volte è stata scelta la domanda aperta per le sessioni esercitative
     */
    function getPercentualeSceltaEse() {
        return $this->percentualeSceltaEse;
    }

    /**
     * @return float La percentuale di quante volte è stata scelta la domanda aperta per le sessioni valutative
     */
    function getPercentualeSceltaVal() {
        return $this->percentualeSceltaVal;
    }
    
    /**
     * Setta l'id della domanda aperta
     * @param int $id L'id della domanda
     */
    function setId($id) {
        $this->id = $id;
    }
    
    /**
     * Setta l'id dell'argomento a cui appartiene la domanda aperta
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     */
    function setArgomentoId($argomentoId) {
        $this->argomentoId = $argomentoId;
    }

    /**
     * Setta il testo della domanda aperta
     * @param string $testo Il testo della domanda
     */
    function setTesto($testo) {
        $this->testo = $testo;
    }

    /**
     * Setta il punteggio massimo della domanda aperta
     * @param  $punteggioMax Il punteggio max della domanda
     */
    function setPunteggioMax($punteggioMax) {
        $this->punteggioMax = $punteggioMax;
    }

    /**
     * Setta la percentuale di volta in cui è stata scelta la domanda aperta per le sessioni esercitative
     * @param float $percentualeSceltaEse La percentuale di volte in cui è stata scelta quella domanda per le sessioni esercitative
     */
    function setPercentualeSceltaEse($percentualeSceltaEse) {
        $this->percentualeSceltaEse = $percentualeSceltaEse;
    }

    /**
     * Setta la percentuale di volta in cui è stata scelta la domanda aperta per le sessioni valutative
     * @param float $percentualeSceltaVal La percentuale di volte in cui è stata scelta quella domanda valutative
     */
    function setPercentualeSceltaVal($percentualeSceltaVal) {
        $this->percentualeSceltaVal = $percentualeSceltaVal;
    }
}