<?php

/**
 * User: Alina
 * Date: 20/11/15
 * Time: 10:45
 */
class DomandaMultipla {
    public $id;
    public $testo;
    public $punteggioCorretta;
    public $punteggioErrata;
    public $percentualeScelta;
    public $percentualeRispostaCorretta;
    public $alternativaCorretta;
    public $argomentoId;
    public $argomentoInsegnamentoId;
    public $argomentoInsegnamentoCorsoMatricola;
    
    /**
     * DomandaMultipla constructor.
     * @param $id
     * @param $testo
     * @param $punteggioCorretta
     * @param $punteggioErrata
     * @param $percentualeScelta 
     * @param $percentualeRispostaCorretta
     * @param $alternativaCorretta
     * @param $argomentoId
     * @param $argomentoInsegnamentoId
     * @param $argomentoInsegnamentoCorsoMatricola
     */
    public function __construct($id, $testo, $punteggioCorretta, $punteggioErrata,$percentualeScelta, $percentualeRispostaCorretta,$alternativaCorretta, 
            $argomentoId, $argomentoInsegnamentoId, $argomentoInsegnamentoCorsoMatricola) {
        $this->id = $id;
        $this->testo = $testo;
        $this->punteggioCorretta = $punteggioCorretta;
        $this->punteggioErrata = $punteggioErrata;
        $this->percentualeScelta = $percentualeScelta;
        $this->percentualeRispostaCorretta = $percentualeRispostaCorretta;
        $this->alternativaCorretta = $alternativaCorretta;
        $this->argomentoId = $argomentoId;
        $this->argomentoInsegnamentoId = $argomentoInsegnamentoId;
        $this->argomentoInsegnamentoCorsoMatricola = $argomentoInsegnamentoCorsoMatricola;
        
    }
    /**
     * @return int id della domanda multipla
     */
    function getId() {
        return $this->id;
    }

    /**
     * @return String testo della domanda multipla
     */
    
    function getTesto() {
        return $this->testo;
    }

    /**
     * @return float punteggio della risposta corretta
     */
    
    function getPunteggioCorretta() {
        return $this->punteggioCorretta;
    }

    /**
     * @return float punteggio della risposta errata
     */
    
    function getPunteggioErrata() {
        return $this->punteggioErrata;
    }

    /**
     * @return float percentuale di volte in cui viene scelta la domanda multipla
     */
    
    function getPercentualeScelta() {
        return $this->percentualeScelta;
    }
    
    /**
     * @return float percentuale di volte in cui viene risposta correttamente la domanda multipla
     */

    function getPercentualeRispostaCorretta() {
        return $this->percentualeRispostaCorretta;
    }
    
    /**
     * @return int risposta corretta della domanda multipla
     */

    function getAlternativaCorretta() {
        return $this->alternativaCorretta;
    }
    
    /**
     * @return int id dell'argomento a cui la domanda multipla appartiene
     */

    function getArgomentoId() {
        return $this->argomentoId;
    }
    
    /**
     * @return int id dell'insegnamento a cui appartiene l'argomento della domanda multipla
     */

    function getArgomentoInsegnamentoId() {
        return $this->argomentoInsegnamentoId;
    }
    
    /**
     * @return String la matricola del corso a cui l'insegnamento realativo all'argomento appartiene 
     */

    function getArgomentoInsegnamentoCorsoMatricola() {
        return $this->argomentoInsegnamentoCorsoMatricola;
    }

    /**
     * Setta l'id della domanda multipla
     * @param $id
     */
    
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Setta il testo della domanda multipla
     * @param $testo
     */
    
    function setTesto($testo) {
        $this->testo = $testo;
    }

    /**
     * Setta il punteggio della risposta corretta relativa alla domanda multipla
     * @param $punteggioCorretta
     */
    
    function setPunteggioCorretta($punteggioCorretta) {
        $this->punteggioCorretta = $punteggioCorretta;
    }

    /**
     * Setta il punteggio della risposta errata relativa alla domanda multipla
     * @param $punteggioErrata
     */
    
    function setPunteggioErrata($punteggioErrata) {
        $this->punteggioErrata = $punteggioErrata;
    }
    
    /**
     * Setta la percentuale di volte in cui è stata scelta la domanda multipla
     * @param $percentualeScelta
     */

    function setPercentualeScelta($percentualeScelta) {
        $this->percentualeScelta = $percentualeScelta;
    }

    /**
     * Setta la percentuale di volte in cui viene risposta correttamente la domanda multipla
     * @param $percentualeRispostaCorretta
     */
    
    function setPercentualeRispostaCorretta($percentualeRispostaCorretta) {
        $this->percentualeRispostaCorretta = $percentualeRispostaCorretta;
    }
    
    /**
     * Setta la risposta corretta della domanda multipla
     * @param $alternativaCorretta
     */

    function setAlternativaCorretta($alternativaCorretta) {
        $this->alternativaCorretta = $alternativaCorretta;
    }
    
    /**
     * Setta l'id dell'argomento a cui appartine la domanda multipla
     * @param $argomentoId
     */

    function setArgomentoId($argomentoId) {
        $this->argomentoId = $argomentoId;
    }

    /**
     * Setta id dell'insegnamento a cui appartiene l'argomento della domanda multipla
     * @param $argomentoInsegnamentoId
     */
    
    function setArgomentoInsegnamentoId($argomentoInsegnamentoId) {
        $this->argomentoInsegnamentoId = $argomentoInsegnamentoId;
    }

     /**
     * Setta la matricola del corso a cui l'insegnamento realativo all'argomento appartiene
     * @param $argomentoInsegnamentoCorsoMatricola
     */
    
    function setArgomentoInsegnamentoCorsoMatricola($argomentoInsegnamentoCorsoMatricola) {
        $this->argomentoInsegnamentoCorsoMatricola = $argomentoInsegnamentoCorsoMatricola;
    }


}