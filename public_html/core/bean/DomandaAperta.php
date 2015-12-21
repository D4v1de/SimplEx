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
    private $percentualeScelta;
    
    /**
     * Costruttore di DomandaAperta.
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param string $testo Il testo della domanda
     * @param float $punteggioMax Il punteggio max della domanda
     * @param float $percentualeScelta La percentuale di volte in cui è stata scelta quella domanda
     */
    function __construct($argomentoId, $testo, $punteggioMax, $percentualeScelta) {
        $this->argomentoId = $argomentoId;
        $this->testo = $testo;
        $this->punteggioMax = $punteggioMax;
        $this->percentualeScelta = $percentualeScelta;
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
     * @return float La percentuale di quante volte è stata scelta la domanda aperta
     */
    function getPercentualeScelta() {
        return $this->percentualeScelta;
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
     * Setta la percentuale di volta in cui è stata scelta la domanda aperta
     * @param float $percentualeScelta La percentuale di volte in cui è stata scelta quella domanda
     */
    function setPercentualeScelta($percentualeScelta) {
        $this->percentualeScelta = $percentualeScelta;
    }
}