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
     * @param string $studenteMatricola La matricola dello studente a cui appartiene
     * @param int $sessioneId L'id della sessione a cui appartiene
     * @param int $testId L'id del test a cui si riferisce
     * @param float $esitoParziale L'esito parziale dell'elaborato
     * @param float $esitoFinale L'esito finale dell'elaborato
     */
    public function __construct($studenteMatricola, $sessioneId, $testId, $esitoParziale, $esitoFinale) {
        $this->studenteMatricola = $studenteMatricola;
        $this->sessioneId = $sessioneId;
        $this->testId = $testId;
        $this->esitoParziale = $esitoParziale;
        $this->esitoFinale = $esitoFinale;
    }
    
    /**
     * @return string La matricola dello studente a cui appartiene
     */
    public function getStudenteMatricola() {
        return $this->studenteMatricola;
    }

    /**
     * @return int L'id della sessione a cui appartiene
     */
    public function getSessioneId() {
        return $this->sessioneId;
    }
    
    /**
     * @return int L'id del test a cui si riferisce
     */
    public function getTestId() {
        return $this->testId;
    }

    /**
     * @return float L'esito parziale dell'elaborato
     */
    public function getEsitoParziale() {
        return $this->esitoParziale;
    }
    
    /**
     * @return float L'esito finale dell'elaborato
     */
    public function getEsitoFinale() {
        return $this->esitoFinale;
    }

    /**
     * Setta la matricola dello studente a cui appartiene
     * @param string $studenteMatricola La matricola dello studente a cui appartiene
     */
    public function setStudenteMatricola($studenteMatricola) {
        $this->studenteMatricola = $studenteMatricola;
    }
    
    /**
     * Setta l'id della sessione a cui appartiene
     * @param int $sessioneId L'id della sessione a cui appartiene
     */
    public function setSessioneId($sessioneId) {
        $this->sessioneId = $sessioneId;
    }
    
    /**
     * Setta l'id del test a cui si riferisce
     * @param int $testId L'id del test a cui si riferisce
     */
    public function setTestId($testId) {
        $this->testId = $testId;
    }
    
    /**
     * Setta l'esito parziale dell'elaborato
     * @param float $esitoParziale L'esito parziale dell'elaborato
     */
    public function setEsitoParziale($esitoParziale) {
        $this->esitoParziale = $esitoParziale;
    }
    
    /**
     * Setta l'esito finale dell'elaborato
     * @param float $esitoFinale L'esito parziale dell'elaborato
     */
    public function setEsitoFinale($esitoFinale) {
        $this->esitoFinale = $esitoFinale;
    }
}