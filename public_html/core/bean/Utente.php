<?php

/**
 * User: Elvira
 * Date: 19/11/15
 * Time: 12:45
 */
class Utente extends Account {
    protected $matricola;
    protected $nome;
    protected $cognome;
    
    /**
     * Utente's constructor.
     */
    public function __construct($matricola, $nome, $cognome) {
        $this->matricola=$matricola;
        $this->nome=$nome;
        $this->cognome=$cognome;
    } 
    
    /**
     * @return mixed matricola
     */
    public function getMatricola() {
        return $this->matricola;
    }

    /**
     * @return mixed nome
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * @return mixed cognome
     */
    public function getCognome() {
        return $this->cognome;
    }

    /**
     * Sets Utente's matricola
     * @param matricola
     */
    public function setMatricola($matricola) {
        $this->matricola = $matricola;
    }
    
    /**
     * Sets Utente's nome
     * @param $nome
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    /**
     * Sets Utente's cognome
     * @param $cognome
     */
    public function setCognome($cognome) {
        $this->cognome = $cognome;
    }

}