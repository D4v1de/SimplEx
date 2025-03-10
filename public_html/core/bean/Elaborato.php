<?php

/**
 * La classe descrive un elaborato.
 *
 * @author Elvira Zanin
 * @version 1.0
 * @since 27/11/15
 */

class Elaborato {
    private $studenteMatricola;
    private $sessioneId;
    private $esitoParziale;
    private $esitoFinale;
    private $testId;
    private $stato;

    /**
     * Costruttore di Elaborato.
     * @param string $studenteMatricola La matricola dello studente a cui appartiene
     * @param int $sessioneId L'id della sessione a cui appartiene
     * @param float $esitoParziale L'esito parziale dell'elaborato
     * @param float $esitoFinale L'esito finale dell'elaborato
     * @param int $testId L'id del test a cui si riferisce
     * @param string $stato Lo stato dell'elaborato
     */
    public function __construct($studenteMatricola, $sessioneId, $esitoParziale, $esitoFinale, $testId, $stato) {
        $this->studenteMatricola = $studenteMatricola;
        $this->sessioneId = $sessioneId;
        $this->esitoParziale = $esitoParziale;
        $this->esitoFinale = $esitoFinale;
        $this->testId = $testId;
        $this->stato = $stato;
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
     * @return int L'id del test a cui si riferisce
     */
    public function getTestId() {
        return $this->testId;
    }

    /**
     * @return string Lo stato dell'elaborato
     */
    public function getStato(){
        return $this->stato;
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

    /**
     * Setta l'id del test a cui si riferisce
     * @param int $testId L'id del test a cui si riferisce
     */
    public function setTestId($testId) {
        $this->testId = $testId;
    }

    /**
     * Setta lo stato dell'elaborato
     * @param $stato Lo stato dell'elaborato
     */
    public function setStato($stato){
        $this->stato = $stato;
    }
}