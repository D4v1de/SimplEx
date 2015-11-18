<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:40
 */
class Studente extends Utente {
    public $email;

    /**
     * Studente constructor.
     */
    public function __construct($matricola, $nome, $cognome, $email) {
        $this->matricola=$matricola;
        $this->cognome=$cognome;
        $this->nome=$nome;
        $this->email = $email;
    }

}