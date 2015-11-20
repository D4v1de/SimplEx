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
     * Domanda_aperta constructor.
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
     * @return mixed id
     */
    function getId() {
        return $this->id;
    }

    /**
     * @return mixed testo
     */
    
    function getTesto() {
        return $this->testo;
    }

    /**
     * @return mixed punteggio_corretta
     */
    
    function getPunteggioCorretta() {
        return $this->punteggio_corretta;
    }

    /**
     * @return mixed punteggio_errata
     */
    
    function getPunteggioErrata() {
        return $this->punteggio_errata;
    }

    /**
     * @return mixed percentuale_scelta
     */
    
    function getPercentualeScelta() {
        return $this->percentuale_scelta;
    }
    
    /**
     * @return mixed percentuale_risposta_corretta
     */

    function getPercentualeRispostaCorretta() {
        return $this->percentuale_risposta_corretta;
    }
    
    /**
     * @return mixed alternativa_corretta
     */

    function getAlternativaCorretta() {
        return $this->alternativa_corretta;
    }
    
    /**
     * @return mixed argomento_id
     */

    function getArgomentoId() {
        return $this->argomento_id;
    }
    
    /**
     * @return mixed argomento_insegnamento_id
     */

    function getArgomentoInsegnamentoId() {
        return $this->argomento_insegnamento_id;
    }
    
    /**
     * @return mixed argomento_insegnamento_corso_matricola
     */

    function getArgomentoInsegnamentoCorsoMatricola() {
        return $this->argomento_insegnamento_corso_matricola;
    }

    /**
     * Sets Domanda_multipla's id
     * @param $id
     */
    
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Sets Domanda_multipla's testo
     * @param $testo
     */
    
    function setTesto($testo) {
        $this->testo = $testo;
    }

    /**
     * Sets Domanda_multipla's punteggio_corretta
     * @param $punteggio_corretta
     */
    
    function setPunteggioCorretta($punteggio_corretta) {
        $this->punteggio_corretta = $punteggio_corretta;
    }

    /**
     * Sets Domanda_multipla's punteggio_errata
     * @param $punteggio_errata
     */
    
    function setPunteggioErrata($punteggio_errata) {
        $this->punteggio_errata = $punteggio_errata;
    }
    
    /**
     * Sets Domanda_multipla's percentuale_scelta
     * @param $percentuale_scelte
     */

    function setPercentualeScelta($percentuale_scelta) {
        $this->percentuale_scelta = $percentuale_scelta;
    }

    /**
     * Sets Domanda_multipla's percentuale_risposte_corrette
     * @param $percentuale_risposte_corrette
     */
    
    function setPercentualeRispostaCorretta($percentuale_risposta_corretta) {
        $this->percentuale_risposta_corretta = $percentuale_risposta_corretta;
    }
    
    /**
     * Sets Domanda_multipla's alternativa_corretta
     * @param $alternativa_corretta
     */

    function setAlternativaCorretta($alternativa_corretta) {
        $this->alternativa_corretta = $alternativa_corretta;
    }
    
    /**
     * Sets Domanda_multipla's argomento_id
     * @param $argomento_id
     */

    function setArgomentoId($argomento_id) {
        $this->argomento_id = $argomento_id;
    }

    /**
     * Sets Domanda_multipla's argomento_insegnamento_id
     * @param $argomento_insegnamento_id
     */
    
    function setArgomentoInsegnamentoId($argomento_insegnamento_id) {
        $this->argomento_insegnamento_id = $argomento_insegnamento_id;
    }

     /**
     * Sets Domanda_multipla's argomento_insegnamento_corso_matricola
     * @param $argomento_insegnamento_corso_matricola
     */
    
    function setArgomentoInsegnamentoCorsoMatricola($argomento_insegnamento_corso_matricola) {
        $this->argomento_insegnamento_corso_matricola = $argomento_insegnamento_corso_matricola;
    }


}