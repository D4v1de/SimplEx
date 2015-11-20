<?php

/**
 * User: Elvira
 * Date: 20/11/15
 * Time: 09:43
 */
class Corso {
    private $matricola;
    private $nome;
    private $tipologia;
    private $cdl_matricola;

    /**
     * Costruttore di Corso.
     * @param $matricola la matricola del corso
     * @param $nome il nome del corso
     * @param $tipologia la tipolgia del corso
     * @param $cdl_matricola la matricola del CdL a cui il corso appartiene
     */
    public function __construct($matricola, $nome, $tipologia, $cdl_matricola) {
        $this->matricola = $matricola;
        $this->nome = $nome;
        $this->tipologia = $tipologia;
        $this->cdl_matricola = $cdl_matricola;
    }
    
    /**
     * @return la matricola del corso
     */
    public function getMatricola() {
        return $this->matricola;
    }

    /**
     * @return il nome del corso
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * @return la tipologia del corso
     */
    public function getTipologia() {
        return $this->tipologia;
    }
    
    /**
     * @return la matricola del CdL a cui il corso appartiene
     */
    public function getCdlMatricola() {
        return $this->cdl_matricola;
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
     * @param matricola la matricola del CdL a cui il corso appartiene
     */
    public function setCdlMatricola($cdl_matricola) {
        $this->cdl_matricola = $cdl_matricola;
    }
}