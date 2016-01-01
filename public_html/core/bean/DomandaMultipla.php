<?php

/**
 * La classe descrive una domanda multipla.
 *
 * @author Alina Korniychuk
 * @version 1.0
 * @since 27/11/15
 */

class DomandaMultipla {
    private $id;
    private $argomentoId;
    private $testo;
    private $punteggioCorretta;
    private $punteggioErrata;
    private $percentualeSceltaEse;
    private $percentualeRispostaCorrettaEse;
    private $percentualeSceltaVal;
    private $percentualeRispostaCorrettaVal;
    
    /**
     * Costruttore di DomandaMultipla.
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param string $testo Il testo della domanda
     * @param float $punteggioCorretta Il punteggio da assegnare in caso di risposta corretta
     * @param float $punteggioErrata Il punteggio da assegnare in caso di risposta errata
     * @param float $percentualeSceltaEse La percentuale di volte in cui viene scelta per le sessioni esercitative
     * @param float $percentualeRispostaCorrettaEse La percentuale di risposte corrette per la domanda per le sessioni esercitative
     * @param float $percentualeSceltaVal La percentuale di volte in cui viene scelta per le sessioni valutative
     * @param float $percentualeRispostaCorrettaVal La percentuale di risposte corrette per la domanda per le sessioni valutative
     */
    public function __construct($argomentoId, $testo, $punteggioCorretta, $punteggioErrata, $percentualeSceltaEse, $percentualeRispostaCorrettaEse, $percentualeSceltaVal, $percentualeRispostaCorrettaVal) {
        $this->argomentoId = $argomentoId;
        $this->testo = $testo;
        $this->punteggioCorretta = $punteggioCorretta;
        $this->punteggioErrata = $punteggioErrata;
        $this->percentualeSceltaEse = $percentualeSceltaEse;
        $this->percentualeRispostaCorrettaEse = $percentualeRispostaCorrettaEse;
        $this->percentualeSceltaVal = $percentualeSceltaVal;
        $this->percentualeRispostaCorrettaVal = $percentualeRispostaCorrettaVal;
    }
    
    /**
     * @return int L'id della domanda multipla
     */
    function getId() {
        return $this->id;
    }
    
    /**
     * @return int L'id dell'argomento della domanda multipla
     */ 
    function getArgomentoId() {
        return $this->argomentoId;
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
     * @return float La percentuale di volte in cui viene scelta per le sessioni esercitative
     */
    function getPercentualeSceltaEse() {
        return $this->percentualeSceltaEse;
    }
    
    /**
     * @return float La percentuale di risposte corrette per la domanda per le sessioni esercitative
     */
    function getPercentualeRispostaCorrettaEse() {
        return $this->percentualeRispostaCorrettaEse;
    }

    /**
     * @return float La percentuale di volte in cui viene scelta per le sessioni valutative
     */
    function getPercentualeSceltaVal() {
        return $this->percentualeSceltaVal;
    }

    /**
     * @return float La percentuale di risposte corrette per la domanda per le sessioni valutative
     */
    function getPercentualeRispostaCorrettaVal() {
        return $this->percentualeRispostaCorrettaVal;
    }
    
    /**
     * Setta l'id della domanda multipla
     * @param $id
     */  
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Setta l'id dell'argomento a cui appartiene la domanda multipla
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     */
    function setArgomentoId($argomentoId) {
        $this->argomentoId = $argomentoId;
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
     * Setta la percentuale di volte in cui viene scelta per le sessioni esercitative
     * @param float $percentualeSceltaEse La percentuale di volte in cui viene scelta per le sessioni esercitative
     */
    function setPercentualeSceltaEse($percentualeSceltaEse) {
        $this->percentualeSceltaEse = $percentualeSceltaEse;
    }

    /**
     * Setta la percentuale di risposte corrette per la domanda per le sessioni esercitative
     * @param float $percentualeRispostaCorrettaEse La percentuale di risposte corrette per la domanda per le sessioni esercitative
     */  
    function setPercentualeRispostaCorrettaEse($percentualeRispostaCorrettaEse) {
        $this->percentualeRispostaCorrettaEse = $percentualeRispostaCorrettaEse;
    }

    /**
     * Setta la percentuale di volte in cui viene scelta per le sessioni valutative
     * @param float $percentualeSceltaVal La percentuale di volte in cui viene scelta per le sessioni valutative
     */
    function setPercentualeSceltaVal($percentualeSceltaVal) {
        $this->percentualeSceltaVal = $percentualeSceltaVal;
    }

    /**
     * Setta la percentuale di risposte corrette per la domanda per le sessioni valutative
     * @param float $percentualeRispostaCorrettaVal La percentuale di risposte corrette per la domanda per le sessioni valutative
     */
    function setPercentualeRispostaCorrettaVal($percentualeRispostaCorrettaVal) {
        $this->percentualeRispostaCorrettaVal = $percentualeRispostaCorrettaVal;
    }
}