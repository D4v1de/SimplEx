<?php

/**
 * User: Elvira
 * Date: 20/11/15
 * Time: 09:09
 */
class CdL {
    private $matricola;
    private $nome;
    private $tipologia;

    /**
     * Cotruttore di CdL
     * @param $matricola la matricola del CdL
     * @param $nome il nome del CdL
     * @param $tipologia la tipologia del CdL
     */
    public function __construct($matricola, $nome, $tipologia) {
        $this->matricola = $matricola;
        $this->nome = $nome;
        $this->tipologia = $tipologia;
    }
    
    /**
     * @return String la matricola del CdL
     */
    public function getMatricola() {
        return $this->matricola;
    }
    
    /**
     * @return String il nome del CdL
     */
    public function getNome() {
        return $this->nome;
    }
    
    /**
     * @return String la tipologia del CdL
     */
    public function getTipologia() {
        return $this->tipologia;
    }
    
    /**
     * Setta la matricola del CdL
     * @param $matricola la matricola del CdL
     */
    public function setMatricola($matricola) {
        $this->matricola = $matricola;
    }

    /**
     * Setta il nome del CdL
     * @param $nome il nome del CdL
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    /**
     * Setta la tipologia del CdL
     * @param $tipologia la tipologia del CdL
     */
    public function setTipologia($tipologia) {
        $this->tipologia = $tipologia;
    }
}