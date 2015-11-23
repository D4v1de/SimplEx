<?php

/**
 * User: Alina
 * Date: 20/11/15
 * Time: 11:30
 */
class Alternativa {
    private $id;
    private $testo;
    private $percentualeScelta;
    private $domandaMultiplaId;
    private $domandaMultiplaArgomentoId;
    private $domandaMultiplaArgomentoInsegnamentoId;
    private $domandaMultiplaArgomentoInsegnamentoCorsoMatricola;
    
    /**
     * Alternativa constructor.
     * @param int $id L'identificatore dell'alternativa
     * @param string $testo Il testo dell'alternativa
     * @param float $percentualeScelta La percentuale di volte in cui è stata scelta
     * @param int $domandaMultiplaId L'identificatore della domanda multipla relativa
     * @param int $domandaMultiplaArgomentoId L'identificatore dell'argomento a cui appartiene la domanda multipla relativa
     * @param int $domandaMultiplaArgomentoInsegnamentoId L'identificatore dell'insegnamento a cui appartiene l'argomento relativo alla domanda multipla di riferimento
     * @param string $domandaMultiplaArgomentoInsegnamentoCorsoMatricola La matricola del corso a cui appartiene l'insegnamento relativo all'argomento che contiene la domanda multipla di riferimento
     */
    function __construct($id, $testo, $percentualeScelta,$domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoInsegnamentoId, $domandaMultiplaArgomentoInsegnamentoCorsoMatricola) {
        $this->id = $id;
        $this->testo = $testo;
        $this->percentualeScelta = $percentualeScelta;
        $this->domandaMultiplaId = $domandaMultiplaId;
        $this->domandaMultiplaArgomentoId = $domandaMultiplaArgomentoId;
        $this->domandaMultiplaArgomentoInsegnamentoId = $domandaMultiplaArgomentoInsegnamentoId;
        $this->domandaMultiplaArgomentoInsegnamentoCorsoMatricola = $domandaMultiplaArgomentoInsegnamentoCorsoMatricola;
    }
    
    /**
     * @return int L'id dell'alternativa
     */
    function getId() {
        return $this->id;
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
     * @return int L'id della domanda multipla
     */
    function getDomandaMultiplaId() {
        return $this->domandaMultiplaId;
    }
    
    /**
     * @return int L'id dell'argomento a cui appartiniene la domanda multipla
     */
    function getDomandaMultiplaArgomentoId() {
        return $this->domandaMultiplaArgomentoId;
    }

    /**
     * @return int L'id dell'insegnamento a cui appertiene l'argomento della domanda multipla
     */
    function getDomandaMultiplaArgomentoInsegnamentoId() {
        return $this->domandaMultiplaArgomentoInsegnamentoId;
    }

    /**
     * @return String La matricola del corso a cui appartiene l'insegnamento relativo all'argomento della domanda multipla di riferimento  
     */
    function getDomandaMultiplaArgomentoInsegnamentoCorsoMatricola() {
        return $this->domandaMultiplaArgomentoInsegnamentoCorsoMatricola;
    }

    /**
     * Setta l'id dell'alternativa
     * @param int $id L'id dell'alternativa
     */
    function setId($id) {
        $this->id = $id;
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
     * Setta l'id dell'insegnamento a cui appartiene l'argomento della domanda multipla
     * @param int $domandaMultiplaArgomentoInsegnamentoId L'id dell'insegnamento a cui appertiene l'argomento della domanda multipla
     */ 
    function setDomandaMultiplaArgomentoInsegnamentoId($domandaMultiplaArgomentoInsegnamentoId) {
        $this->domandaMultiplaArgomentoInsegnamentoId = $domandaMultiplaArgomentoInsegnamentoId;
    }

    /**
     * Setta la matricola del corso a cui appartiene l'insegnamento realativo all'argomento della domanda multipla 
     * @param string $domandaMultiplaArgomentoInsegnamentoCorsoMatricola La matricola del corso a cui appartiene l'insegnamento relativo all'argomento della domanda multipla di riferimento
     */
    function setDomandaMultiplaArgomentoInsegnamentoCorsoMatricola($domandaMultiplaArgomentoInsegnamentoCorsoMatricola) {
        $this->domandaMultiplaArgomentoInsegnamentoCorsoMatricola = $domandaMultiplaArgomentoInsegnamentoCorsoMatricola;
    }
}