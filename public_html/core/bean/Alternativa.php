<?php

/**
 * User: Alina
 * Date: 20/11/15
 * Time: 11:30
 */
class Alternativa {
    public $id;
    public $testo;
    public $percentualeScelta;
    public $domandaMultiplaArgomentoId;
    public $domandaMultiplaArgomentoInsegnamentoId;
    public $domandaMultiplaArgomentoInsegnamentoCorsoMatricola;
    
    /**
     * Alternativa constructor.
     * @param $id
     * @param $testo
     * @param $percentualeScelta 
     * @param $domandaMultiplaArgomentoId
     * @param $domandaMultiplaArgomentoInsegnamentoId
     * @param $domandaMultiplaArgomentoInsegnamentoCorsoMatricola
     */
    
    
    function __construct($id, $testo, $percentualeScelta, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoInsegnamentoId, $domandaMultiplaArgomentoInsegnamentoCorsoMatricola) {
        $this->id = $id;
        $this->testo = $testo;
        $this->percentualeScelta = $percentualeScelta;
        $this->domandaMultiplaArgomentoId = $domandaMultiplaArgomentoId;
        $this->domandaMultiplaArgomentoInsegnamentoId = $domandaMultiplaArgomentoInsegnamentoId;
        $this->domandaMultiplaArgomentoInsegnamentoCorsoMatricola = $domandaMultiplaArgomentoInsegnamentoCorsoMatricola;
    }

    /**
     * @return id dell'alternativa
     */
    
    function getId() {
        return $this->id;
    }

    /**
     * @return testo dell'alternativa
     */
    
    function getTesto() {
        return $this->testo;
    }
    
    /**
     * @return percentuale di volte che è stata scelta l'alternativa della domanda multipla
     */

    function getPercentualeScelta() {
        return $this->percentualeScelta;
    }

    /**
     * @return l'id dell'argomento a cui appartiniene la domanda multipla
     */
    
    function getDomandaMultiplaArgomentoId() {
        return $this->domandaMultiplaArgomentoId;
    }

    /**
     * @return l'id dell'insegnamento a cui appertiene l'argomento della domanda multipla
     */
    
    function getDomandaMultiplaArgomentoInsegnamentoId() {
        return $this->domandaMultiplaArgomentoInsegnamentoId;
    }

    /**
     * @return la matricola del corso a cui appartiene l'insegnamento realativo all'argomento della domanda multipla   
     */
    
    function getDomandaMultiplaArgomentoInsegnamentoCorsoMatricola() {
        return $this->domandaMultiplaArgomentoInsegnamentoCorsoMatricola;
    }

    /**
     * Setta l'id dell'alternativa
     * @param $id
     */
    
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Setta il testo dell'alternativa
     * @param $testo
     */
    
    function setTesto($testo) {
        $this->testo = $testo;
    }

    /**
     * Setta la percentuale di volte che l'alternativa è stata scelta
     * @param $percentualeScelta
     */
    
    function setPercentualeScelta($percentualeScelta) {
        $this->percentualeScelta = $percentualeScelta;
    }

    /**
     * Setta l'id dell'argomento a cui appartiene la domanda multipla
     * @param $domandaMultiplaArgomentoId
     */
    
    function setDomandaMultiplaArgomentoId($domandaMultiplaArgomentoId) {
        $this->domandaMultiplaArgomentoId = $domandaMultiplaArgomentoId;
    }

    /**
     * Setta l'id dell'insegnamento a cui appartiene l'argomento della domanda multipla
     * @param $domandaMultiplaArgomentoInsegnamentoId
     */
    
    function setDomandaMultiplaArgomentoInsegnamentoId($domandaMultiplaArgomentoInsegnamentoId) {
        $this->domandaMultiplaArgomentoInsegnamentoId = $domandaMultiplaArgomentoInsegnamentoId;
    }

    /**
     * Setta la matricola del corso a cui appartiene l'insegnamento realativo all'argomento della domanda multipla 
     * @param $domandaMultiplaArgomentoInsegnamentoId
     */
    
    function setDomandaMultiplaArgomentoInsegnamentoCorsoMatricola($domandaMultiplaArgomentoInsegnamentoCorsoMatricola) {
        $this->domandaMultiplaArgomentoInsegnamentoCorsoMatricola = $domandaMultiplaArgomentoInsegnamentoCorsoMatricola;
    }




}