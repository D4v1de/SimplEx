<?php

/**
 * User: Elvira
 * Date: 20/11/15
 * Time: 16:28
 */
class Contatto {
    private $valore;
    private $tipologia;
    private $docenteMatricola;

    /**
     * Costruttore di Contatto.
     * @param string $valore Il valore del contatto
     * @param string $tipologia La tipologia del contatto
     * @param string $docenteMatricola La matricola del docente a cui appartiene il contatto
     */
    public function __construct($valore, $tipologia, $docenteMatricola) {
        $this->valore = $valore;
        $this->tipologia = $tipologia;
        $this->docenteMatricola = $docenteMatricola;
    }
    
    /**
     * @return String Il valore del contatto
     */
    public function getValore() {
        return $this->valore;
    }
    
    /**
     * @return String La tipologia del contatto
     */
    public function getTipologia() {
        return $this->tipologia;
    }

    /**
     * @return String La matricola del docente a cui appartiene il contatto
     */
    public function getDocenteMatricola() {
        return $this->docenteMatricola;
    }
    
    /**
     * Setta il valore del contatto
     * @param string $valore Il valore del contatto
     */
    public function setValore($valore) {
        $this->valore = $valore;
    }
    
    /**
     * Setta la tipologia del contatto
     * @param string $tipologia La tipologia del contatto
     */
    public function setTipologia($tipologia) {
        $this->tipologia = $tipologia;
    }
    
    /**
     * Setta la matricola del docente a cui appartiene il contatto
     * @param string $docenteMatricola La matricola del docente a cui appartiene il contatto
     */
    public function setDocenteMatricola($docenteMatricola) {
        $this->docenteMatricola = $docenteMatricola;
    }
}