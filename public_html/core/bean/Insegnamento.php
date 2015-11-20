<?php

/**
 * User: Elvira
 * Date: 20/11/15
 * Time: 10:35
 */
class Insegnamento {
    private $id;
    private $corso_matricola;

    /**
     * Costruttore di Insegnamento
     * @param $corso_matricola la matricola del corso a cui appartiene
     * @param $id l'identificatore dell'insegnamento
     */
    public function __construct($corso_matricola, $id) {
        $this->corso_matricola = $corso_matricola;
        $this->id = $id;
    }
    
    /**
     * @return l'id del corso
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * @return la matricola del corso a cui appartiene
     */
    public function getCorsoMatricola() {
        return $this->matricola;
    }

    /**
     * Setta la matricola del corso a cui appartiene
     * @param matricola la matricola del corso
     */
    public function setCorsoMatricola($corso_matricola) {
        $this->corso_matricola = $corso_matricola;
    }
    
    /**
     * Setta l'id dell'insegnamento
     * @param $id l'id dell'insegnamento
     */
    public function setNome($id) {
        $this->id = $id;
    }
}