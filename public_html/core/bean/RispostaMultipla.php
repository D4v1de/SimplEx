<?php

/**
 * User: Giuseppina
 * Date: 27/11/15
 * Time: 10:40
 */
class RispostaMultipla {

    private $elaboratoSessioneId;
    private $elaboratoStudenteMatricola;
    private $domandaMultiplaId;
    private $punteggio;
    private $alternativaId;
    
    /**
     * Costruttore di Risposta_multipla
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato relativo
     * @param int $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato relativo
     * @param int $domandaMultiplaId L'id della domanda multipla a cui si riferisce
     * @param float $punteggio Il punteggio assegnato alla risposta
     * @param int $alternativaId L'id dell'alternativa scelta
     */
    public function __construct($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId, $punteggio, $alternativaId) {
        $this->elaboratoSessioneId=$elaboratoSessioneId;
        $this->elaboratoStudenteMatricola=$elaboratoStudenteMatricola;
        $this->domandaMultiplaId=$domandaMultiplaId;
        $this->punteggio=$punteggio;
        $this->alternativaId=$alternativaId;
    }
    
    /**
     * @return int L'id della sessione dell'elaborato
     */
    function getElaboratoSessioneId() {
        return $this->elaboratoSessioneId;
    }
    
    /**
     * @return String La matricola dello studente a cui appartiene l'elaborato relativo
     */
    function getElaboratoStudenteMatricola() {
        return $this->elaboratoStudenteMatricola;
    }

    /**
     * @return int L'identificatore della domanda multipla a cui si riferisce
     */
    function getDomandaMultiplaId() {
        return $this->domandaMultiplaId;
    }

    /**
     * @return float Il punteggio assegnato alla risposta
     */
    function getPunteggio() {
        return $this->punteggio;
    }

    /**
     * @return int L'id dell'alternativa scelta
     */
    function getAlternativaId() {
        return $this->alternativaId;
    }
    
    /**
     * Setta l'id dell'elaborato della sessione
     * @param int $elaboratoSessioneId L'id dell'elaborato della sessione
     */
    function setElaboratoSessioneId($elaboratoSessioneId) {
        $this->elaboratoSessioneId = $elaboratoSessioneId;
    }

    /**
     * Setta la matricola dell'elaborato dello studente
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato relativo
     */
    function setElaboratoStudenteMatricola($elaboratoStudenteMatricola) {
        $this->elaboratoStudenteMatricola = $elaboratoStudenteMatricola;
    }

    /**
     * Setta l'id della domanda multipla
     * @param int $domandaMultiplaId L'identificatore della domanda multipla
     */
    function setDomandaMultiplaId($domandaMultiplaId) {
        $this->domandaMultiplaId = $domandaMultiplaId;
    }

    /**
     * Setta il punteggio da asseganre alla risposta
     * @param float $punteggio Il punteggio da asseganre alla risposta
     */
    function setPunteggio($punteggio) {
        $this->punteggio = $punteggio;
    }

     /**
     * Setta l'id dell'alternativa scelta
     * @param int $alternativaId L'id dell'alternativa scelta
     */
    function setAlternativaId($alternativaId) {
        $this->alternativaId = $alternativaId;
    }
}
    