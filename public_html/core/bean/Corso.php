<?php

/**
 * User: Elvira
 * Date: 19/11/15
 * Time: 13:03
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

}