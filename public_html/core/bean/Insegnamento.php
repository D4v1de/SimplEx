<?php

/**
 * User: Elvira
 * Date: 20/11/15
 * Time: 16:48
 */
class Insegnamento {
    private $id;
    private $corsoMatricola;

    /**
     * Costruttore di Insegnamento
     * @param $corsoMatricola la matricola del corso a cui appartiene
     * @param $id l'identificatore dell'insegnamento
     */
    public function __construct($corsoMatricola, $id) {
        $this->corsoMatricola = $corsoMatricola;
        $this->id = $id;
    }
    
    /**
     * @return int l'id del corso
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * @return String la matricola del corso a cui appartiene
     */
    public function getCorsoMatricola() {
        return $this->matricola;
    }

    /**
     * Setta la matricola del corso a cui appartiene
     * @param corsoMatricola la matricola del corso a cui appartiene
     */
    public function setCorsoMatricola($corsoMatricola) {
        $this->corsoMatricola = $corsoMatricola;
    }
    
    /**
     * Setta l'id dell'insegnamento
     * @param $id l'id dell'insegnamento
     */
    public function setNome($id) {
        $this->id = $id;
    }
}