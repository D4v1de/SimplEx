<?php

/**
 * User: Elvira
 * Date: 19/11/15
 * Time: 16:40
 */
class Contatto {
    public $valore;
    public $tipologia;
    public $docente;

    /**
     * Contatto constructor.
     * @param $valore
     * @param $tipologia
     * @param $docente
     */
    public function __construct($valore, $tipologia, $docente) {
        $this->valore = $valore;
        $this->tipologia = $tipologia;
        $this->docente = $docente;
    }
    
    /**
     * @return mixed valore
     */
    public function getValore() {
        return $this->valore;
    }
    
    /**
     * @return mixed tipologia
     */
    public function getTipologia() {
        return $this->tipologia;
    }

    /**
     * @return mixed docente
     */
    public function getDocente() {
        return $this->docente;
    }
    

    /**
     * Sets Contatto's valore
     * @param $valore
     */
    public function setValore($valore) {
        $this->valore = $valore;
    }
    
    /**
     * Sets Contatto's tipologia
     * @param $tipologia
     */
    public function setTipologia($tipologia) {
        $this->tipologia = $tipologia;
    }
    
    /**
     * Sets Account's docente
     * @param $docente
     */
    public function setDocente($docente) {
        $this->docente = $docente;
    }
}