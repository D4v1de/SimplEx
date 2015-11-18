<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:37
 */
class Utente {
    protected $matricola;
    protected $nome;
    protected $cognome;

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
     * @return mixed cognome
     */
    public function getCognome() {
        return $this->cognome;
    }




}