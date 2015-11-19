<?php

/**
 * User: Elvira
 * Date: 19/11/15
 * Time: 16:48
 */
class Corso {
    public $matricola;
    public $nome;
    public $tipologia;

    /**
     * Corso constructor.
     * @param $matricola
     * @param $nome
     * @param $tipologia 
     */
    public function __construct($matricola, $nome, $tipologia) {
        $this->matricola = $matricola;
        $this->nome = $nome;
        $this->tipologia = $tipologia;
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
     * @return mixed tipologia
     */
    public function getTipologia() {
        return $this->tipologia;
    }

    /**
     * Sets Corso's matricola
     * @param matricola
     */
    public function setMatricola($matricola) {
        $this->matricola = $matricola;
    }
    
    /**
     * Sets Corso's nome
     * @param $nome
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    /**
     * Sets Corso's tipologia
     * @param $tipologia
     */
    public function setTipologia($tipologia) {
        $this->tipologia = $tipologia;
    }


}