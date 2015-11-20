<?php

/**
 * User: Elvira
 * Date: 20/11/15
 * Time: 16:15
 */
class Corso {
    private $matricola;
    private $nome;
    private $tipologia;
    private $cdlMatricola;

    /**
     * Costruttore di Corso.
     * @param $matricola la matricola del corso
     * @param $nome il nome del corso
     * @param $tipologia la tipolgia del corso
     * @param $cdlMatricola la matricola del CdL a cui il corso appartiene
     */
    public function __construct($matricola, $nome, $tipologia, $cdlMatricola) {
        $this->matricola = $matricola;
        $this->nome = $nome;
        $this->tipologia = $tipologia;
        $this->cdlMatricola = $cdlMatricola;
    }
    
    /**
     * @return String la matricola del corso
     */
    public function getMatricola() {
        return $this->matricola;
    }

    /**
     * @return String il nome del corso
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * @return String la tipologia del corso
     */
    public function getTipologia() {
        return $this->tipologia;
    }
    
    /**
     * @return String la matricola del CdL a cui il corso appartiene
     */
    public function getCdlMatricola() {
        return $this->cdlMatricola;
    }

    /**
     * Setta la matricola del corso
     * @param matricola la matricola del corso
     */
    public function setMatricola($matricola) {
        $this->matricola = $matricola;
    }
    
    /**
     * Setta il nome del corso
     * @param $nome il nome del corso
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    /**
     * Setta la tipologia del corso
     * @param $tipologia la tipologia del corso
     */
    public function setTipologia($tipologia) {
        $this->tipologia = $tipologia;
    }
    
    /**
     * Setta la matricola del CdL a cui il corso appartiene
     * @param cdlMatricola la matricola del CdL a cui il corso appartiene
     */
    public function setCdlMatricola($cdlMatricola) {
        $this->cdlMatricola = $cdlMatricola;
    }
}