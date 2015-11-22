<?php

/**
 * User: Elvira
 * Date: 22/11/15
 * Time: 17:20
 */
class Utente {
    private $username;
    private $password; 
    private $matricola;
    private $nome;
    private $cognome;
    private $tipologia;  
    private $cdlMatricola;

    /**
     * Costruttore di Utente
     * @param string $username L'username dell'utente
     * @param string $password La password dell'utente
     * @param string $matricola La matricola dell'utente
     * @param string $nome Il nome dell'utente
     * @param string $cognome Il cognome dell'utente
     * @param enum $tipologia La tipologia di utente
     * @param string $cdlMatricola La matricola del corso di laurea a cui è iscritto l'utente Studente
     */
    public function __construct($username, $password, $matricola, $nome, $cognome, $tipologia, $cdlMatricola) {
        $this->username=$username;
        $this->password=$password;
        $this->matricola=$matricola;
        $this->nome=$nome;
        $this->cognome=$cognome;
        $this->tipologia=$tipologia;
        $this->cdlMatricol=$cdlMatricola;
    } 
    
    /**
     * @return String L'username dell'utente
     */
    public function getUsername() {
        return $this->username;
    }
  
    /**
     * @return string La password dell'utente
     */
    public function getPassword() {
        return $this->password;
    }
    
    /**
     * @return string La matricola
     */
    public function getMatricola() {
        return $this->matricola;
    }

    /**
     * @return string Il nome dell'utente
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * @return string Il cognome dell'utente
     */
    public function getCognome() {
        return $this->cognome;
    }
    
    /**
     * @return enum La tipologia dell'utente
     */
    public function getTipologia() {
        return $this->tipologia;
    }

    /**
     * @return string La matricola del corso di laurea a cui è iscritto l'utente Studente
     */
    public function getCdlMatricola() {
        return $this->cdlMatricola;
    }
    
    /**
     * Setta l'username dell'utente
     * @param string $username L'username dell'utente
     */
    public function setUsername($username) {
        $this->username = $username;
    }
    
    /**
     * Setta la password dell'utente
     * @param string $password La password dell'utente
     */
    public function setPassword($password) {
        $this->password = $password;
    }
    
    /**
     * Setta la matricola dell'utente
     * @param string $matricola La matricola dell'utente
     */
    public function setMatricola($matricola) {
        $this->matricola = $matricola;
    }
    
    /**
     * Setta il nome dell'utente
     * @param string $nome Il nome dell'utente
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    /**
     * Setta il cognome dell'utente
     * @param string $cognome Il cognome dell'utente
     */
    public function setCognome($cognome) {
        $this->cognome = $cognome;
    }

    /**
     * Setta la tipologia dell'utente
     * @param enum $tipologia La tipologia dell'utente
     */
    public function setTipologia($tipologia) {
        $this->tipologia = $tipologia;
    }
    
    /**
     * Setta la matricola del corso di laurea a cui è iscritto l'utente Studente
     * @param string $cdlMatricola La matricola del corso di laurea a cui è iscritto l'utente Studente
     */
    public function setCldMatricola($cdlMatricola) {
        $this->cdlMatricola = $cdlMatricola;
    }
}