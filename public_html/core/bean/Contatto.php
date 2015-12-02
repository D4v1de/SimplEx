<?php

/**
 * User: Elvira
 * Date: 27/11/15
 * Time: 09:00
 */
class Contatto {
    private $id;
    private $valore;
    private $tipologia;
    private $utenteMatricola;

    /**
     * Costruttore di Contatto.
     * @param string $valore Il valore del contatto
     * @param string $tipologia La tipologia del contatto
     * @param string $utenteMatricola La matricola dell'utente a cui appartiene il contatto
     */
    public function __construct($valore, $tipologia, $utenteMatricola) {
        $this->valore = $valore;
        $this->tipologia = $tipologia;
        $this->utenteMatricola = $utenteMatricola;
    }
    
    /**
     * @return int L'id del contatto
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * @return string Il valore del contatto
     */
    public function getValore() {
        return $this->valore;
    }
    
    /**
     * @return string La tipologia del contatto
     */
    public function getTipologia() {
        return $this->tipologia;
    }

    /**
     * @return string La matricola dell'utente a cui appartiene il contatto
     */
    public function getUtenteMatricola() {
        return $this->utenteMatricola;
    }
    
    /**
     * Setta l'id del contatto
     * @param int $id L'id del contatto
     */
    public function setId($id) {
        $this->id = $id;
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
     * Setta la matricola dell'utente a cui appartiene il contatto
     * @param string $utenteMatricola La matricola dell'utente a cui appartiene il contatto
     */
    public function setUtenteMatricola($utenteMatricola) {
        $this->utenteMatricola = $utenteMatricola;
    }
}