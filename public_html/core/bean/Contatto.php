<?php

/**
 * User: Elvira
 * Date: 20/11/15
 * Time: 10:00
 */
class Contatto {
    private $valore;
    private $tipologia;
    private $docente_matricola;

    /**
     * Costruttore di Contatto.
     * @param $valore il valore del contatto
     * @param $tipologia la tipologia del contatto
     * @param $docente_matricola la matricola del docente a cui appartiene il contatto
     */
    public function __construct($valore, $tipologia, $docente_matricola) {
        $this->valore = $valore;
        $this->tipologia = $tipologia;
        $this->docente_matricola = $docente_matricola;
    }
    
    /**
     * @return valore il valore del contatto
     */
    public function getValore() {
        return $this->valore;
    }
    
    /**
     * @return la tipologia del contatto
     */
    public function getTipologia() {
        return $this->tipologia;
    }

    /**
     * @return la matricola del docente a cui appartiene il contatto
     */
    public function getDocenteMatricola() {
        return $this->docente_matricola;
    }
    

    /**
     * Setta il valore del contatto
     * @param $valore il valore del contatto
     */
    public function setValore($valore) {
        $this->valore = $valore;
    }
    
    /**
     * Setta la tipologia del contatto
     * @param $tipologia la tipologia del contatto
     */
    public function setTipologia($tipologia) {
        $this->tipologia = $tipologia;
    }
    
    /**
     * Setta la matricola del docente a cui appartiene il contatto
     * @param $docente_matricola la matricola del docente a cui appartiene il contatto
     */
    public function setDocenteMatricola($docente_matricola) {
        $this->docente_matricola = $docente_matricola;
    }
}