<?php

/**
 * User: Elvira
 * Date: 20/11/15
 * Time: 17:17
 */
class Utente extends Account{
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
     * @return String la matricola
     */
    public function getMatricola() {
        return $this->matricola;
    }

    /**
     * @return  String il nome dell'utente
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * @return String il cognome dell'utente
     */
    public function getCognome() {
        return $this->cognome;
    }
    
    /**
     * @return String la tipologia dell'utente
     */
    public function getTipologia() {
        return $this->tipologia;
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

    /**
     * Setta la tipologia dell'utente
     * @param $tipologia la tipologia dell'utente
     */
    public function setTipologia($tipologia) {
        $this->tipologia = $tipologia;
    }
}