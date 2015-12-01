<?php

/**
 * User: Alina
 * Date: 27/11/15
 * Time: 10:00
 */
class DomandaAperta {
    private $id;
    private $argomentoId;
    private $argomentoCorsoId;
    private $testo;
    private $punteggioMax;
    private $percentualeScelta;
    
    /**
     * Costruttore di DomandaAperta.
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id dell'insegnamento a cui appartiene l'argomento relativo
     * @param string $testo Il testo della domanda
     * @param float $punteggioMax Il punteggio max della domanda
     * @param float $percentualeScelta La percentuale di volte in cui è stata scelta quella domanda
     */
    function __construct($argomentoId, $argomentoCorsoId, $testo, $punteggioMax, $percentualeScelta) {
        $this->argomentoId = $argomentoId;
        $this->argomentoCorsoId = $argomentoCorsoId;
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
     * @return int L'id del corso a cui appartiene l'argomento relativo
     */
    function getArgomentoCorsoId() {
        return $this->argomentoCorsoId;
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
     * Setta l'id del corso a cui appartiene l'argomento relativo
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     */
    function setArgomentoCorsoId($argomentoCorsoId) {
        $this->argomentoCorsoId = $argomentoCorsoId;
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