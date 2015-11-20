<?php

/**
 * User: Elvira
 * Date: 20/11/15
 * Time: 10:30
 */
class Utente {
    private $matricola;
    private $nome;
    private $cognome;
    private $tipologia; 
    
    /**
     * Costruttore di Utente
     */
    public function __construct($matricola, $nome, $cognome, $tipologia) {
        $this->matricola=$matricola;
        $this->nome=$nome;
        $this->cognome=$cognome;
        $this->tipologia=$tipologia;
    } 
    
    /**
     * @return la matricola
     */
    public function getMatricola() {
        return $this->matricola;
    }

    /**
     * @return il nome dell'utente
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * @return il cognome dell'utente
     */
    public function getCognome() {
        return $this->cognome;
    }

    /**
     * Setta la matricola dell'utente
     * @param matricola la matricola dell'utente
     */
    public function setMatricola($matricola) {
        $this->matricola = $matricola;
    }
    
    /**
     * Setta il nome dell'utente
     * @param $nome il nome dell'utente
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    /**
     * Setta il cognome dell'utente
     * @param $cognome il cognome dell'utente
     */
    public function setCognome($cognome) {
        $this->cognome = $cognome;
    }

}