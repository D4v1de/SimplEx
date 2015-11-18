<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 10:54
 */
class CdL {
    public $codice;
    public $nome;

    /**
     * CdL constructor.
     * @param $codice
     * @param $nome
     */
    public function __construct($codice, $nome) {
        $this->codice = $codice;
        $this->nome = $nome;
    }

}