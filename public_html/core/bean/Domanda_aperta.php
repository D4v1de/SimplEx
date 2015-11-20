<?php

/**
 * User: Alina
 * Date: 20/11/15
 * Time: 09:30
 */
class Domanda_aperta {
    public $id;
    public $testo;
    public $punteggio_max;
    public $percentuale_scelta;
    public $argomento_id;
    public $argomento_insegnamento_id;
    public $argomento_insegnamento_corso_matricola;
    
    /**
     * Domanda_aperta constructor.
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
    
    function getPunteggio_max() {
        return $this->punteggio_max;
    }

    /**
     * @return mixed percentuale_scelta
     */
    
    function getPercentuale_scelta() {
        return $this->percentuale_scelta;
    }

    /**
     * @return mixed argomento_id
     */
    
    function getArgomento_id() {
        return $this->argomento_id;
    }

    /**
     * @return mixed argomento_insegnamento_id
     */
    
    function getArgomento_insegnamento_id() {
        return $this->argomento_insegnamento_id;
    }

    /**
     * @return mixed argomento_insegnamento_corso_matricola
     */
    
    function getArgomento_insegnamento_corso_matricola() {
        return $this->argomento_insegnamento_corso_matricola;
    }

    /**
     * Sets Domanda_aperta's id
     * @param $id
     */
    
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Sets Domanda_aperta's testo
     * @param $testo
     */
    
    function setTesto($testo) {
        $this->testo = $testo;
    }

    /**
     * Sets Domanda_aperta's punteggio_max
     * @param $punteggio_max
     */
    
    function setPunteggio_max($punteggio_max) {
        $this->punteggio_max = $punteggio_max;
    }

    /**
     * Sets Domanda_aperta's percentuale_scelta
     * @param $percentuale_scelta
     */
    
    function setPercentuale_scelta($percentuale_scelta) {
        $this->percentuale_scelta = $percentuale_scelta;
    }

     /**
     * Sets Domanda_aperta's argomento_id
     * @param $argomento_id
     */
    
    function setArgomento_id($argomento_id) {
        $this->argomento_id = $argomento_id;
    }

     /**
     * Sets Domanda_aperta's argomento_insegnamento_id
     * @param $argomento_insegnamento_id
     */
    
    function setArgomento_insegnamento_id($argomento_insegnamento_id) {
        $this->argomento_insegnamento_id = $argomento_insegnamento_id;
    }

    /**
     * Sets Domanda_aperta's argomento_insegnamento_corso_matricola
     * @param $argomento_insegnamento_corso_matricola
     */
    
    function setArgomento_insegnamento_corso_matricola($argomento_insegnamento_corso_matricola) {
        $this->argomento_insegnamento_corso_matricola = $argomento_insegnamento_corso_matricola;
    }

}