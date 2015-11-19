<?php

/**
 * User: Elvira
 * Date: 19/11/15
 * Time: 13:03
 */
class Insegnamento {
    public $corso_matricola;
    public $id;

    /**
     * Corso constructor.
     * @param $corso_matricola
     * @param $id
     */
    public function __construct($corso_matricola, $id) {
        $this->corso_matricola = $corso_matricola;
        $this->id = $id;
    }

}