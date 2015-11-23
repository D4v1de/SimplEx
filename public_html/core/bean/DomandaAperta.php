<?php

/**
 * User: Alina
 * Date: 20/11/15
 * Time: 09:30
 */
class DomandaAperta {
    private $id;
    private $testo;
    private $punteggioMax;
    private $percentualeScelta;
    private $argomentoId;
    private $argomentoInsegnamentoId;
    private $argomentoInsegnamentoCorsoMatricola;
    
    /**
     * DomandaAperta constructor.
     * @param int $id L'id della domanda
     * @param string $testo Il testo della domanda
     * @param float $punteggioMax Il punteggio max della domanda
     * @param float $percentualeScelta La percentuale di volte in cui è stata scelta quella domanda
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoInsegnamentoId L'id dell'insegnamento a cui appartiene l'argomento relativo
     * @param string $argomentoInsegnamentoCorsoMatricola La matricola del corso a cui appartiene l'insegnamento relativo all'argomento di riferimento
     */
    function __construct($id, $testo, $punteggioMax, $percentualeScelta, $argomentoId, $argomentoInsegnamentoId, $argomentoInsegnamentoCorsoMatricola) {
        $this->id = $id;
        $this->testo = $testo;
        $this->punteggioMax = $punteggioMax;
        $this->percentualeScelta = $percentualeScelta;
        $this->argomentoId = $argomentoId;
        $this->argomentoInsegnamentoId = $argomentoInsegnamentoId;
        $this->argomentoInsegnamentoCorsoMatricola = $argomentoInsegnamentoCorsoMatricola;
    }
    
    /**
     * @return int L'id della domanda aperta
     */
    function getId() {
        return $this->id;
    }

    /**
     * @return string Il testo della domanda aperta
     */
    function getTesto() {
        return $this->testo;
    }
    
    /**
     * @return float Il punteggio massimo della domanda aperta
     */
    function getPunteggioMax() {
        return $this->punteggioMax;
    }

    /**
     * @return float La percentuale di quante volte è stata scelta la domanda aperta
     */
    function getPercentualeScelta() {
        return $this->percentualeScelta;
    }
    
    /**
     * @return int L'id dell'argomento della domanda aperta
     */ 
    function getArgomentoId() {
        return $this->argomentoId;
    }

    /**
     * @return int L'id dell'insegnamento a cui appartiene l'argomento 
     */
    function getArgomentoInsegnamentoId() {
        return $this->argomentoInsegnamentoId;
    }

    /**
     * @return string La matricola del corso a cui l'insegnamento relativo all'argomento apartiene
     */
    function getArgomentoInsegnamentoCorsoMatricola() {
        return $this->argomentoInsegnamentoCorsoMatricola;
    }

    /**
     * Setta l'id della domanda aperta
     * @param int $id L'id della domanda
     */
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Setta il testo della domanda aperta
     * @param string $testo Il testo della domanda
     */
    function setTesto($testo) {
        $this->testo = $testo;
    }

    /**
     * Setta il punteggio massimo della domanda aperta
     * @param  $punteggioMax Il punteggio max della domanda
     */
    function setPunteggioMax($punteggioMax) {
        $this->punteggioMax = $punteggioMax;
    }

    /**
     * Setta la percentuale di volta in cui è stata scelta la domanda aperta
     * @param float $percentualeScelta La percentuale di volte in cui è stata scelta quella domanda
     */
    function setPercentualeScelta($percentualeScelta) {
        $this->percentualeScelta = $percentualeScelta;
    }

    /**
     * Setta l'id dell'argomento a cui appartiene la domanda aperta
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     */
    function setArgomentoId($argomentoId) {
        $this->argomentoId = $argomentoId;
    }

    /**
     * Setta l'id dell'insegnamento a cui appartiene l'argomento relativo
     * @param int $argomentoInsegnamentoId L'id dell'insegnamento a cui appartiene l'argomento relativo
     */
    function setArgomentoInsegnamentoId($argomentoInsegnamentoId) {
        $this->argomentoInsegnamentoId = $argomentoInsegnamentoId;
    }

    /**
     * Setta la matricola del corso a cui appartiene l'insegnamento relativo all'argomento di riferimento
     * @param string $argomentoInsegnamentoCorsoMatricola La matricola del corso a cui appartiene l'insegnamento relativo all'argomento di riferimento
     */
    function setArgomentoInsegnamentoCorsoMatricola($argomentoInsegnamentoCorsoMatricola) {
        $this->argomentoInsegnamentoCorsoMatricola = $argomentoInsegnamentoCorsoMatricola;
    }
}