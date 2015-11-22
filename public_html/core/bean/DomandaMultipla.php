<?php

/**
 * User: Alina
 * Date: 20/11/15
 * Time: 10:45
 */
class DomandaMultipla {
    private $id;
    private $testo;
    private $punteggioCorretta;
    private $punteggioErrata;
    private $percentualeScelta;
    private $percentualeRispostaCorretta;
    private $alternativaCorretta;
    private $argomentoId;
    private $argomentoInsegnamentoId;
    private $argomentoInsegnamentoCorsoMatricola;
    
    /**
     * DomandaMultipla constructor.
     * @param int $id L'id della domanda
     * @param string $testo Il testo della domanda
     * @param float $punteggioCorretta Il punteggio da assegnare in caso di risposta corretta
     * @param float $punteggioErrata Il punteggio da assegnare in caso di risposta errata
     * @param float $percentualeScelta La percentuale di volte in cui viene scelta
     * @param float $percentualeRispostaCorretta La percentuale di risposte corrette per la domanda
     * @param int $alternativaCorretta L'id dell'alternativa corretta
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoInsegnamentoId L'id dell'insegnamento a cui appartiene l'argomento relativo
     * @param string $argomentoInsegnamentoCorsoMatricola La matricola del corso a cui appartiene l'insegnamento relativo all'argomento di riferimento
     */
    public function __construct($id, $testo, $punteggioCorretta, $punteggioErrata,$percentualeScelta, $percentualeRispostaCorretta,$alternativaCorretta, 
            $argomentoId, $argomentoInsegnamentoId, $argomentoInsegnamentoCorsoMatricola) {
        $this->id = $id;
        $this->testo = $testo;
        $this->punteggioCorretta = $punteggioCorretta;
        $this->punteggioErrata = $punteggioErrata;
        $this->percentualeScelta = $percentualeScelta;
        $this->percentualeRispostaCorretta = $percentualeRispostaCorretta;
        $this->alternativaCorretta = $alternativaCorretta;
        $this->argomentoId = $argomentoId;
        $this->argomentoInsegnamentoId = $argomentoInsegnamentoId;
        $this->argomentoInsegnamentoCorsoMatricola = $argomentoInsegnamentoCorsoMatricola;
        
    }
    
    /**
     * @return int L'id della domanda multipla
     */
    function getId() {
        return $this->id;
    }

    /**
     * @return string Il testo della domanda multipla
     */
    function getTesto() {
        return $this->testo;
    }

    /**
     * @return float Il punteggio da assegnare in caso di risposta corretta
     */
    function getPunteggioCorretta() {
        return $this->punteggioCorretta;
    }

    /**
     * @return float Il punteggio da assegnare in caso di risposta errata
     */
    function getPunteggioErrata() {
        return $this->punteggioErrata;
    }

    /**
     * @return float La percentuale di volte in cui viene scelta
     */
    function getPercentualeScelta() {
        return $this->percentualeScelta;
    }
    
    /**
     * @return float La percentuale di risposte corrette per la domanda
     */
    function getPercentualeRispostaCorretta() {
        return $this->percentualeRispostaCorretta;
    }
    
    /**
     * @return int L'id dell'alternativa corretta
     */
    function getAlternativaCorretta() {
        return $this->alternativaCorretta;
    }
    
    /**
     * @return int L'id dell'argomento a cui appartiene la domanda
     */
    function getArgomentoId() {
        return $this->argomentoId;
    }
    
    /**
     * @return int L'id dell'insegnamento a cui appartiene l'argomento relativo
     */
    function getArgomentoInsegnamentoId() {
        return $this->argomentoInsegnamentoId;
    }
    
    /**
     * @return String La matricola del corso a cui appartiene l'insegnamento relativo all'argomento di riferimento
     */
    function getArgomentoInsegnamentoCorsoMatricola() {
        return $this->argomentoInsegnamentoCorsoMatricola;
    }

    /**
     * Setta l'id della domanda multipla
     * @param $id
     */  
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Setta il testo della domanda multipla
     * @param $testo
     */
    function setTesto($testo) {
        $this->testo = $testo;
    }

    /**
     * Setta il punteggio da assegnare in caso di risposta corretta
     * @param float $punteggioCorretta Il punteggio da assegnare in caso di risposta corretta
     */   
    function setPunteggioCorretta($punteggioCorretta) {
        $this->punteggioCorretta = $punteggioCorretta;
    }

    /**
     * Setta il punteggio da assegnare in caso di risposta errata
     * @param float $punteggioErrata Il punteggio da assegnare in caso di risposta errata
     */  
    function setPunteggioErrata($punteggioErrata) {
        $this->punteggioErrata = $punteggioErrata;
    }
    
    /**
     * Setta la percentuale di volte in cui viene scelta
     * @param float $percentualeScelta La percentuale di volte in cui viene scelta
     */
    function setPercentualeScelta($percentualeScelta) {
        $this->percentualeScelta = $percentualeScelta;
    }

    /**
     * Setta la percentuale di risposte corrette per la domanda
     * @param float $percentualeRispostaCorretta La percentuale di risposte corrette per la domanda
     */  
    function setPercentualeRispostaCorretta($percentualeRispostaCorretta) {
        $this->percentualeRispostaCorretta = $percentualeRispostaCorretta;
    }
    
    /**
     * Setta l'id dell'alternativa corretta
     * @param int $alternativaCorretta L'id dell'alternativa corretta
     */
    function setAlternativaCorretta($alternativaCorretta) {
        $this->alternativaCorretta = $alternativaCorretta;
    }
    
    /**
     * Setta l'id dell'argomento a cui appartiene la domanda
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