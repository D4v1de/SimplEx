<?php

/**
 * User: Giuseppina
 * Date: 27/11/15
 * Time: 10:40
 */
class RispostaMultipla {
    private $id;
    private $elaboratoSessioneId;
    private $elaboratoStudenteMatricola;
    private $punteggio;
    private $alternativaId;
    private $alternativaDomandaMultiplaId;
    private $alternativaDomandaMultiplaArgomentoId;
    private $alternativaDomandaMultiplaArgomentoCorsoId;
    
    /**
     * Costruttore di Risposta_multipla
     * @param int $id L'identificatore della risposta multipla
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato relativo
     * @param int $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato relativo
     * @param float $punteggio Il punteggio assegnato alla risposta
     * @param int $alternativaId L'id dell'alternativa scelta
     * @param int $alternativaDomandaMultiplaId L'id della domanda multipla relativa all'alternativa scelta
     * @param int $alternativaDomandaMultiplaArgomentoId L'id dell'argomento a cui appartiene la domanda multipla relativa
     * @param int $alternativaDomandaMultiplaArgomentoCorsoId L'id del corso a cui appartiene l'argomento relativo alla domanda multipla
     */
    public function __construct($id, $elaboratoSessioneId, $elaboratoStudenteMatricola, $punteggio, $alternativaId, $alternativaDomandaMultiplaId, 
            $alternativaDomandaMultiplaArgomentoId, $alternativaDomandaMultiplaArgomentoCorsoId) {
        $this->id=$id;
        $this->elaboratoSessioneId=$elaboratoSessioneId;
        $this->elaboratoStudenteMatricola=$elaboratoStudenteMatricola;
        $this->punteggio=$punteggio;
        $this->alternativaId=$alternativaId;
        $this->alternativaDomandaMultiplaId=$alternativaDomandaMultiplaId;
        $this->alternativaDomandaMultiplaArgomentoId=$alternativaDomandaMultiplaArgomentoId;
        $this->alternativaDomandaMultiplaArgomentoCorsoId=$alternativaDomandaMultiplaArgomentoCorsoId;
    } 
    
    /**
     * @return int L'identificatore della risposta multipla
     */
    function getId() {
        return $this->elaboratoStudenteMatricola;
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
     * @return int L'id della domanda multipla a cui appartiene l'alternativa scelta
     */
    function getAlternativaDomandaMultiplaId() {
        return $this->alternativaDomandaMultiplaId;
    }
    
    /**
     * @return int L'id dell'argomento a cui appartiene la domanda multipla relativa
     */
    function getAlternativaDomandaMultiplaArgomentoId() {
        return $this->alternativaDomandaMultiplaArgomentoId;
    }

    /**
     * @return int L'id del corso dell'argomento a cui appartiene la domanda multipla relativa
     */
    function getAlternativaDomandaMultiplaArgomentoCorsoId() {
        return $this->alternativaDomandaMultiplaArgomentoCorsoId;
    }

    /**
     * Setta l'id della risposta multipla
     * @param int $id L'identificatore della risposta multipla
     */
    function setId($id) {
        $this->id = $id;
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

    /**
    * Setta l'id della domanda multipla a cui appartiene l'alternativa scelta
    * @param int $alternativaDomandaMultiplaId L'id della domanda multipla a cui appartiene l'alternativa scelta
    */
    function setAlternativaDomandaMultiplaId($alternativaDomandaMultiplaId) {
        $this->alternativaDomandaMultiplaId = $alternativaDomandaMultiplaId;
    }
    
    /**
    * Setta l'id dell'argomento a cui appartiene la domanda multipla relativa
    * @param int $alternativaDomandaMultiplaArgomentoId L'id dell'argomento a cui appartiene la domanda multipla relativa
    */
    function setAlternativaDomandaMultiplaArgomentoId($alternativaDomandaMultiplaArgomentoId) {
        $this->alternativaDomandaMultiplaArgomentoId = $alternativaDomandaMultiplaArgomentoId;
    }

    /**
     * Setta l'id del corso dell'argomento a cui appartiene la domanda multipla relativa
     * @param int $alternativaDomandaMultiplaArgomentoCorsoId L'id del corso dell'argomento a cui appartiene la domanda multipla relativa
     */
    function setAlternativaDomandaMultiplaArgomentoCorsoId($alternativaDomandaMultiplaArgomentoCorsoId) {
        $this->alternativaDomandaMultiplaArgomentoCorsoId = $alternativaDomandaMultiplaArgomentoCorsoId;
    }
}
    