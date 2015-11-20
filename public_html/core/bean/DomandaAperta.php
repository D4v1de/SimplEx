<?php

/**
 * User: Alina
 * Date: 20/11/15
 * Time: 09:30
 */
class DomandaAperta {
    public $id;
    public $testo;
    public $punteggio_max;
    public $percentuale_scelta;
    public $argomento_id;
    public $argomento_insegnamento_id;
    public $argomento_insegnamento_corso_matricola;
    
    /**
     * DomandaAperta constructor.
     * @param $id
     * @param $testo
     * @param $punteggio_max
     * @param $percentuale_scelta 
     * @param $argomento_id
     * @param $argomento_insegnamento_id
     * @param $argomento_insegnamento_corso_matricola
     */
    public function __construct($id, $testo, $punteggio_max, $percentuale_scelta, $argomento_id,$argomento_insegnamento_id, $argomento_insegnamento_corso_matricola) {
        $this->id = $id;
        $this->testo = $testo;
        $this->punteggio_max = $punteggio_max;
        $this->percentuale_scelta = $percentuale_scelta;
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
     * @return mixed punteggio_max
     */
    
    function getPunteggioMax() {
        return $this->punteggio_max;
    }

    /**
     * @return mixed percentuale_scelta
     */
    
    function getPercentualeScelta() {
        return $this->percentuale_scelta;
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
     * @param $punteggio_max
     */
    
    function setPunteggioMax($punteggio_max) {
        $this->punteggio_max = $punteggio_max;
    }

    /**
     * Setta la percentuale di volta in cui è stata scelta la domanda aperta
     * @param $percentuale_scelta
     */
    
    function setPercentualeScelta($percentuale_scelta) {
        $this->percentuale_scelta = $percentuale_scelta;
    }

     /**
     * Setta l'id dell'argomento a cui appartiene la domanda aperta
     * @param $argomento_id
     */
    
    function setArgomentoId($argomento_id) {
        $this->argomento_id = $argomento_id;
    }

     /**
     * Setta l'id dell'insegnamento a cui appartiene l'argomento della domanda aperta
     * @param $argomento_insegnamento_id
     */
    
    function setArgomentoInsegnamentoId($argomento_insegnamento_id) {
        $this->argomento_insegnamento_id = $argomento_insegnamento_id;
    }

    /**
     * Setta la matricola del corso a cui l'insegnamento relativo all'argomento apartiene
     * @param $argomento_insegnamento_corso_matricola
     */
    
    function setArgomentoInsegnamentoCorsoMatricola($argomento_insegnamento_corso_matricola) {
        $this->argomento_insegnamento_corso_matricola = $argomento_insegnamento_corso_matricola;
    }

}