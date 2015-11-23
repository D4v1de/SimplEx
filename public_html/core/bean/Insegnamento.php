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
     * @param int $id L'identificatore dell'insegnamento
     * @param string $corsoMatricola La matricola del corso a cui appartiene
     */
    public function __construct($id, $corsoMatricola) {
        $this->corsoMatricola = $corsoMatricola;
        $this->id = $id;
    }
    
    /**
     * @return int L'id del corso
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * @return string La matricola del corso a cui appartiene
     */
    public function getCorsoMatricola() {
        return $this->matricola;
    }

    /**
     * Setta la matricola del corso a cui appartiene
     * @param string $corsoMatricola La matricola del corso a cui appartiene
     */
    public function setCorsoMatricola($corsoMatricola) {
        $this->corsoMatricola = $corsoMatricola;
    }
    
    /**
     * Setta l'id dell'insegnamento
     * @param int $id L'id dell'insegnamento
     */
    public function setNome($id) {
        $this->id = $id;
    }
}