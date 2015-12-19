<?php

/**
 * La classe descrive un corso di laurea.
 *
 * @author Elvira Zanin
 * @version 1.0
 * @since 20/11/15
 */

class CdL {
    private $matricola;
    private $nome;
    private $tipologia;

    /**
     * Costruttore di CdL
     * @param string $matricola La matricola del CdL
     * @param string $nome Il nome del CdL
     * @param string $tipologia La tipologia del CdL
     */
    public function __construct($matricola, $nome, $tipologia) {
        $this->matricola = $matricola;
        $this->nome = $nome;
        $this->tipologia = $tipologia;
    }
    
    /**
     * @return string La matricola del CdL
     */
    public function getMatricola() {
        return $this->matricola;
    }
    
    /**
     * @return string Il nome del CdL
     */
    public function getNome() {
        return $this->nome;
    }
    
    /**
     * @return string La tipologia del CdL
     */
    public function getTipologia() {
        return $this->tipologia;
    }
    
    /**
     * Setta la matricola del CdL
     * @param string $matricola La matricola del CdL
     */
    public function setMatricola($matricola) {
        $this->matricola = $matricola;
    }

    /**
     * Setta il nome del CdL
     * @param string $nome Il nome del CdL
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    /**
     * Setta la tipologia del CdL
     * @param string $tipologia La tipologia del CdL
     */
    public function setTipologia($tipologia) {
        $this->tipologia = $tipologia;
    }
}