<?php

/**
 * User: Alina
 * Date: 27/11/15
 * Time: 10:15
 */
class Alternativa {
    private $id;
    private $domandaMultiplaId;
    private $domandaMultiplaArgomentoId;
    private $domandaMultiplaArgomentoCorsoId;
    private $testo;
    private $percentualeScelta;
    private $corretta;

    /**
     * Alternativa constructor.
     * @param int $domandaMultiplaId L'identificatore della domanda multipla relativa
     * @param int $domandaMultiplaArgomentoCorsoId L'identificatore dell'insegnamento a cui appartiene l'argomento relativo alla domanda multipla di riferimento
     * @param string $testo Il testo dell'alternativa
     * @param float $percentualeScelta La percentuale di volte in cui è stata scelta
     * @param string $corretta Indica se l'alternativa è corretta
     **/
    function __construct($domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId, $testo, $percentualeScelta, $corretta) {
        $this->domandaMultiplaId = $domandaMultiplaId;
        $this->domandaMultiplaArgomentoId = $domandaMultiplaArgomentoId;
        $this->domandaMultiplaArgomentoCorsoId = $domandaMultiplaArgomentoCorsoId;
        $this->testo = $testo;
        $this->percentualeScelta = $percentualeScelta;
        $this->corretta = $corretta;
    }
    
    /**
     * @return int L'id dell'alternativa
     */
    function getId() {
        return $this->id;
    }

    /**
     * @return int L'id della domanda multipla
     */
    function getDomandaMultiplaId() {
        return $this->domandaMultiplaId;
    }
    
    /**
     * @return int L'id dell'argomento a cui appartiene la domanda multipla
     */
    function getDomandaMultiplaArgomentoId() {
        return $this->domandaMultiplaArgomentoId;
    }

    /**
     * @return int L'id del corso a cui appartiene l'argomento della domanda multipla
     */
    function getDomandaMultiplaArgomentoCorsoId() {
        return $this->domandaMultiplaArgomentoCorsoId;
    }
    
    /**
     * @return string Il testo dell'alternativa
     */
    function getTesto() {
        return $this->testo;
    }
    
    /**
     * @return float La percentuale di volte in cui è stata scelta l'alternativa della domanda multipla
     */
    function getPercentualeScelta() {
        return $this->percentualeScelta;
    }

    /**
     * @return string La correttezza dell'alternativa
     */
    function getCorretta() {
        return $this->corretta;
    }

    /**
     * Setta l'id dell'alternativa
     * @param int $id L'id dell'alternativa
     */
    function setId($id) {
        $this->id = $id;
    }
    
    /**
     * Setta l'id della domanda multipla
     * @param int $domandaMultiplaId L'id della domanda multipla
     */
    function setDomandaMultiplaId($domandaMultiplaId) {
        $this->domandaMultiplaId = $domandaMultiplaId;
    }
    
    /**
     * Setta l'id dell'argomento a cui appartiene la domanda multipla
     * @param int $domandaMultiplaArgomentoId L'id dell'argomento a cui appartiniene la domanda multipla
     */
    function setDomandaMultiplaArgomentoId($domandaMultiplaArgomentoId) {
        $this->domandaMultiplaArgomentoId = $domandaMultiplaArgomentoId;
    }

    /**
     * Setta l'id del corso a cui appartiene l'argomento della domanda multipla
     * @param int $domandaMultiplaArgomentoCorsoId L'id del corso a cui appartiene l'argomento della domanda multipla
     */ 
    function setDomandaMultiplaArgomentoCorsoId($domandaMultiplaArgomentoCorsoId) {
        $this->domandaMultiplaArgomentoCorsoId = $domandaMultiplaArgomentoCorsoId;
    }

    /**
     * Setta il testo dell'alternativa
     * @param string $testo Il testo dell'alternativa
     */
    function setTesto($testo) {
        $this->testo = $testo;
    }

    /**
     * Setta la percentuale di volte che l'alternativa è stata scelta
     * @param float $percentualeScelta La percentuale di volte in cui è stata scelta l'alternativa della domanda multipla
     */
    function setPercentualeScelta($percentualeScelta) {
        $this->percentualeScelta = $percentualeScelta;
    }

    /**
     * Setta la correttezza dell'alternativa
     * @param string $corretta La correttezza dell'alternativa
     */
    function setCorretta($corretta) {
        $this->corretta = $corretta;
    }
}