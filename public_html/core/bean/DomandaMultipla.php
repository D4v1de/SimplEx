<?php

/**
 * User: Alina
 * Date: 20/11/15
 * Time: 10:45
 */
class DomandaMultipla {
    public $id;
    public $testo;
    public $punteggio_corretta;
    public $punteggio_errata;
    public $percentuale_scelta;
    public $percentuale_risposta_corretta;
    public $alternativa_corretta;
    public $argomento_id;
    public $argomento_insegnamento_id;
    public $argomento_insegnamento_corso_matricola;
    
    /**
     * DomandaMultipla constructor.
     * @param $id
     * @param $testo
     * @param $punteggio_corretta
     * @param $punteggio_errata
     * @param $percentuale_scelta 
     * @param $percentuale_risposta_corretta
     * @param $alternativa_corretta
     * @param $argomento_id
     * @param $argomento_insegnamento_id
     * @param $argomento_insegnamento_corso_matricola
     */
    public function __construct($id, $testo, $punteggio_corretta, $punteggio_errata,$percentuale_scelta, $percentuale_risposta_corretta,$alternativa_corretta, 
            $argomento_id, $argomento_insegnamento_id, $argomento_insegnamento_corso_matricola) {
        $this->id = $id;
        $this->testo = $testo;
        $this->punteggio_corretta = $punteggio_corretta;
        $this->punteggio_errata = $punteggio_errata;
        $this->percentuale_scelta = $percentuale_scelta;
        $this->percentuale_risposta_corretta = $percentuale_risposta_corretta;
        $this->alternativa_corretta = $alternativa_corretta;
        $this->argomento_id = $argomento_id;
        $this->argomento_insegnamento_id = $argomento_insegnamento_id;
        $this->argomento_insegnamento_corso_matricola = $argomento_insegnamento_corso_matricola;
        
    }
    /**
     * @return id della domanda multipla
     */
    function getId() {
        return $this->id;
    }

    /**
     * @return testo della domanda multipla
     */
    
    function getTesto() {
        return $this->testo;
    }

    /**
     * @return punteggio della risposta corretta
     */
    
    function getPunteggioCorretta() {
        return $this->punteggio_corretta;
    }

    /**
     * @return punteggio della risposta errata
     */
    
    function getPunteggioErrata() {
        return $this->punteggio_errata;
    }

    /**
     * @return percentuale di volte in cui viene scelta la domanda multipla
     */
    
    function getPercentualeScelta() {
        return $this->percentuale_scelta;
    }
    
    /**
     * @return percentuale di volte in cui viene risposta correttamente la domanda multipla
     */

    function getPercentualeRispostaCorretta() {
        return $this->percentuale_risposta_corretta;
    }
    
    /**
     * @return risposta corretta della domanda multipla
     */

    function getAlternativaCorretta() {
        return $this->alternativa_corretta;
    }
    
    /**
     * @return id dell'argomento a cui la domanda multipla appartiene
     */

    function getArgomentoId() {
        return $this->argomento_id;
    }
    
    /**
     * @return id dell'insegnamento a cui appartiene l'argomento della domanda multipla
     */

    function getArgomentoInsegnamentoId() {
        return $this->argomento_insegnamento_id;
    }
    
    /**
     * @return la matricola del corso a cui l'insegnamento realativo all'argomento appartiene 
     */

    function getArgomentoInsegnamentoCorsoMatricola() {
        return $this->argomento_insegnamento_corso_matricola;
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
     * @param $punteggio_corretta
     */
    
    function setPunteggioCorretta($punteggio_corretta) {
        $this->punteggio_corretta = $punteggio_corretta;
    }

    /**
     * Setta il punteggio della risposta errata relativa alla domanda multipla
     * @param $punteggio_errata
     */
    
    function setPunteggioErrata($punteggio_errata) {
        $this->punteggio_errata = $punteggio_errata;
    }
    
    /**
     * Setta la percentuale di volte in cui è stata scelta la domanda multipla
     * @param $percentuale_scelte
     */

    function setPercentualeScelta($percentuale_scelta) {
        $this->percentuale_scelta = $percentuale_scelta;
    }

    /**
     * Setta la percentuale di volte in cui viene risposta correttamente la domanda multipla
     * @param $percentuale_risposte_corrette
     */
    
    function setPercentualeRispostaCorretta($percentuale_risposta_corretta) {
        $this->percentuale_risposta_corretta = $percentuale_risposta_corretta;
    }
    
    /**
     * Setta la risposta corretta della domanda multipla
     * @param $alternativa_corretta
     */

    function setAlternativaCorretta($alternativa_corretta) {
        $this->alternativa_corretta = $alternativa_corretta;
    }
    
    /**
     * Setta l'id dell'argomento a cui appartine la domanda multipla
     * @param $argomento_id
     */

    function setArgomentoId($argomento_id) {
        $this->argomento_id = $argomento_id;
    }

    /**
     * Setta id dell'insegnamento a cui appartiene l'argomento della domanda multipla
     * @param $argomento_insegnamento_id
     */
    
    function setArgomentoInsegnamentoId($argomento_insegnamento_id) {
        $this->argomento_insegnamento_id = $argomento_insegnamento_id;
    }

     /**
     * Setta la matricola del corso a cui l'insegnamento realativo all'argomento appartiene
     * @param $argomento_insegnamento_corso_matricola
     */
    
    function setArgomentoInsegnamentoCorsoMatricola($argomento_insegnamento_corso_matricola) {
        $this->argomento_insegnamento_corso_matricola = $argomento_insegnamento_corso_matricola;
    }


}