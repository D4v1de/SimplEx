<?php

/**
 * User: Elvira
 * Date: 27/11/15
 * Time: 09:15
 */
class Corso {
    private $id;
    private $matricola;
    private $nome;
    private $tipologia;
    private $cdlMatricola;

    /**
     * Costruttore di Corso.
     * @param int $id L'id del corso
     * @param string $matricola La matricola del corso
     * @param string $nome Il nome del corso
     * @param enum $tipologia La tipologia del corso
     * @param string $cdlMatricola La matricola del CdL a cui il corso appartiene
     */
    public function __construct($id, $matricola, $nome, $tipologia, $cdlMatricola) {
        $this->id = $id;
        $this->matricola = $matricola;
        $this->nome = $nome;
        $this->tipologia = $tipologia;
        $this->cdlMatricola = $cdlMatricola;
    }
    
    /**
     * @return int L'id del corso
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * @return string La matricola del corso
     */
    public function getMatricola() {
        return $this->matricola;
    }

    /**
     * @return string Il nome del corso
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * @return enum La tipologia del corso
     */
    public function getTipologia() {
        return $this->tipologia;
    }
    
    /**
     * @return string La matricola del CdL a cui il corso appartiene
     */
    public function getCdlMatricola() {
        return $this->cdlMatricola;
    }

    /**
     * Setta l'id del corso
     * @param $id L'id del corso
     */
    public function setId($id) {
        $this->id = $id;
    }
    
    /**
     * Setta la matricola del corso
     * @param $matricola La matricola del corso
     */
    public function setMatricola($matricola) {
        $this->matricola = $matricola;
    }
    
    /**
     * Setta il nome del corso
     * @param string $nome Il nome del corso
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    /**
     * Setta la tipologia del corso
     * @param enum $tipologia La tipologia del corso
     */
    public function setTipologia($tipologia) {
        $this->tipologia = $tipologia;
    }
    
    /**
     * Setta la matricola del CdL a cui il corso appartiene
     * @param string $cdlMatricola La matricola del CdL a cui il corso appartiene
     */
    public function setCdlMatricola($cdlMatricola) {
        $this->cdlMatricola = $cdlMatricola;
    }
}