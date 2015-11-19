<?php

/**
 * User: Elvira
 * Date: 19/11/15
 * Time: 12:45
 */
class Utente extends UtenteRegistrato {
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