<?php

/**
 * User: Alina
 * Date: 20/11/15
 * Time: 09:30
 */
class DomandaAperta {
    public $id;
    public $testo;
    public $punteggioMax;
    public $percentualeScelta;
    public $argomentoId;
    public $argomentoInsegnamentoId;
    public $argomentoInsegnamentoCorsoMatricola;
    
    /**
     * DomandaAperta constructor.
     * @param $id
     * @param $testo
     * @param $punteggioMax
     * @param $percentualeScelta 
     * @param $argomentoId
     * @param $argomentoInsegnamentoId
     * @param $argomentoInsegnamentoCorsoMatricola
     */
    function __construct($id, $testo, $punteggioMax, $percentualeScelta, $argomentoId, $argomentoInsegnamentoId, $argomentoInsegnamentoCorsoMatricola) {
        $this->id = $id;
        $this->testo = $testo;
        $this->punteggioMax = $punteggioMax;
        $this->percentualeScelta = $percentualeScelta;
        $this->argomentoId = $argomentoId;
        $this->argomentoInsegnamentoId = $argomentoInsegnamentoId;
        $this->argomentoInsegnamentoCorsoMatricola = $argomentoInsegnamentoCorsoMatricola;
    }
    
    /**
     * @return int l'id della domanda aperta
     */
    
    function getId() {
        return $this->id;
    }

    /**
     * @return String testo della domanda aperta
     */
    
    function getTesto() {
        return $this->testo;
    }

    /**
     * @return float punteggio massimo della domanda aperta
     */
    
    function getPunteggioMax() {
        return $this->punteggioMax;
    }

    /**
     * @return float percentuale di quante volte è stata scelta la domanda aperta
     */
    
    function getPercentualeScelta() {
        return $this->percentualeScelta;
    }

    /**
     * @return int l'id dell'argomento della domanda aperta
     */
    
    function getArgomentoId() {
        return $this->argomentoId;
    }

    /**
     * @return int l'id dell'insegnamento a cui appartiene l'argomento 
     */
    
    function getArgomentoInsegnamentoId() {
        return $this->argomentoInsegnamentoId;
    }

    /**
     * @return String la matricola del corso a cui l'insegnamento relativo all'argomento apartiene
     */
    
    function getArgomentoInsegnamentoCorsoMatricola() {
        return $this->argomentoInsegnamentoCorsoMatricola;
    }

    /**
     * Setta l'id della domanda aperta
     * @param $id
     */
    
    function setId($id) {
        $this->id = $id;
    }

    
    /**
     * Setta il testo della domanda aperta
     * @param $testo
     */
    
    function setTesto($testo) {
        $this->testo = $testo;
    }

    /**
     * Setta il punteggio massimo della domanda aperta
     * @param $punteggioMax
     */
    
    function setPunteggioMax($punteggioMax) {
        $this->punteggioMax = $punteggioMax;
    }

    /**
     * Setta la percentuale di volta in cui è stata scelta la domanda aperta
     * @param $percentualeScelta
     */
    
    
    function setPercentualeScelta($percentualeScelta) {
        $this->percentualeScelta = $percentualeScelta;
    }

    /**
     * Setta l'id dell'argomento a cui appartiene la domanda aperta
     * @param $argomentoId
     */
    
    
    function setArgomentoId($argomentoId) {
        $this->argomentoId = $argomentoId;
    }

     /**
     * Setta l'id dell'insegnamento a cui appartiene l'argomento della domanda aperta
     * @param $argomentoInsegnamentoId
     */
    
    function setArgomentoInsegnamentoId($argomentoInsegnamentoId) {
        $this->argomentoInsegnamentoId = $argomentoInsegnamentoId;
    }

    /**
     * Setta la matricola del corso a cui l'insegnamento relativo all'argomento apartiene
     * @param $argomentoInsegnamentoCorsoMatricola
     */
    
    function setArgomentoInsegnamentoCorsoMatricola($argomentoInsegnamentoCorsoMatricola) {
        $this->argomentoInsegnamentoCorsoMatricola = $argomentoInsegnamentoCorsoMatricola;
    }

}