<?php

/**
 * La classe descrive un alternativa.
 *
 * @author Alina Korniychuk
 * @version 1.0
 * @since 27/11/15
 */
class Alternativa {
    private $id;
    private $domandaMultiplaId;
    private $testo;
    private $percentualeScelta;
    private $corretta;

    /**
     * Costruttore di Alternativa.
     * @param int $domandaMultiplaId L'identificatore della domanda multipla relativa
     * @param string $testo Il testo dell'alternativa
     * @param float $percentualeScelta La percentuale di volte in cui è stata scelta
     * @param string $corretta Indica se l'alternativa è corretta
     **/
    function __construct($domandaMultiplaId, $testo, $percentualeScelta, $corretta) {
        $this->domandaMultiplaId = $domandaMultiplaId;
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