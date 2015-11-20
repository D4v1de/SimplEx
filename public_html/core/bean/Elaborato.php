<?php

/**
 * User: Elvira
 * Date: 20/11/15
 * Time: 10:43
 */
class Elaborato {
    private $studenteMatricola;
    private $sessioneId;
    private $testId;
    private $esitoParziale;
    private $esitoFinale;

    /**
     * Costruttore di Elaborato.
     * @param $studenteMatricola la matricola dello studente a cui appartiene
     * @param $sessioneId l'id della sessione a cui appartiene
     * @param $testId l'id del test a cui si riferisce
     * @param $esitoParziale l'esito parziale dell'elaborato
     * @param $esitoFinale l'esito finale dell'elaborato
     */
    public function __construct($studenteMatricola, $sessioneId, $testId, $esitoParziale, $esitoFinale) {
        $this->studenteMatricola = $studenteMatricola;
        $this->sessioneId = $sessioneId;
        $this->testId = $testId;
        $this->esitoParziale = $esitoParziale;
        $this->esitoFinale = $esitoFinale;
    }
    
    /**
     * @return la matricola dello studente a cui appartiene
     */
    public function getStudenteMatricola() {
        return $this->studenteMatricola;
    }

    /**
     * @return l'id della sessione a cui appartiene
     */
    public function getSessioneId() {
        return $this->sessioneId;
    }
    
    /**
     * @return l'id del test a cui si riferisce
     */
    public function getTestId() {
        return $this->testId;
    }

    /**
     * @return l'esito parziale dell'elaborato
     */
    public function getEsitoParziale() {
        return $this->esitoParziale;
    }
    
    /**
     * @return l'esito finale dell'elaborato
     */
    public function getEsitoFinale() {
        return $this->esitoFinale;
    }

    /**
     * Setta la matricola dello studente a cui appartiene
     * @param studenteMatricola la matricola dello studente a cui appartiene
     */
    public function setStudenteMatricola($studenteMatricola) {
        $this->studenteMatricola = $studenteMatricola;
    }
    
    /**
     * Setta l'id della sessione a cui appartiene
     * @param $sessioneId l'id della sessione a cui appartiene
     */
    public function setSessioneId($sessioneId) {
        $this->sessioneId = $sessioneId;
    }
    
    /**
     * Setta l'id del test a cui si riferisce
     * @param $testId l'id del test a cui si riferisce
     */
    public function setTestId($testId) {
        $this->testId = $testId;
    }
    
    /**
     * Setta l'esito parziale dell'elaborato
     * @param $esitoParziale l'esito parziale dell'elaborato
     */
    public function setEsitoParziale($esitoParziale) {
        $this->esitoParziale = $esitoParziale;
    }
    
    /**
     * Setta l'esito finale dell'elaborato
     * @param $esitoFinale l'esito parziale dell'elaborato
     */
    public function setEsitoFinale($esitoFinale) {
        $this->esitoFinale = $esitoFinale;
    }
}