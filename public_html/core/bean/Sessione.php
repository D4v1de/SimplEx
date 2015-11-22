<?php

/**
 * User: Giuseppina
 * Date: 20/11/15
 * Time: 16:47
 */
class Sessione {
    private $id;
    private $tipologia;
    private $dataInizio;
    private $dataFine;
    private $sogliaAmmissione;
    private $insegnamentoId;
    private $insegnamentoCorsoMatricola;
    
    /**
     * Costruttore di Sessione
     * @param int $id L'id della sessione
     * @param enum $tipologia La tipologia della sessione
     * @param date $dataInizio La data di inizio della sessione
     * @param date $dataFine La data di termine della sessione
     * @param float $sogliaAmmissione La soglia di ammissione della sessione
     * @param int $insegnamentoId L'id dell'insegnamento a cui appartiene la sessione
     * @param string $insegnamentoCorsoMatricola La matricola del corso a cui appartiene l'insegnamento relativo
     */
    public function __construct($id, $tipologia, $dataInizio, $dataFine, $sogliaAmmissione, $insegnamentoId, $insegnamentoCorsoMatricola ) {
        $this->id=$id;
        $this->tipologia=$tipologia;
        $this->dataInizio=$dataInizio;
        $this->dataFine=$dataFine;
        $this->sogliaAmmissione=$sogliaAmmissione;
        $this->insegnamentoId=$insegnamentoId;
        $this->insegnamentoCorsoMatricola=$insegnamentoCorsoMatricola;
    } 

    /**
     * @return int L'id della sessione
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return enum La tipologia della sessione
     */
    public function getTipologia() {
        return $this->tipologia;
    }
    
    /**
     * @return date La dataInizio della sessione
     */
     public function getDataInizio() {
        return $this->dataInizio;
    }
    
    /**
     * @return date La data di termine della sessione
     */
     public function getDataFine() {
        return $this->dataFine;
    }
    
    /**
     * @return float La soglia di ammissione della sessione
     */
     public function getSogliaAmmissione() {
        return $this->sogliaAmmissione;
    }
    
    /**
     * @return int L'id dell'insegnamento a cui appartiene
     */
     public function getInsegnamentoId() {
        return $this->insegnamentoId;
    }
    
     /**
     * @return String La matricola del corso a cui appartiene l'insegnamento relativo
     */
     public function getInsegnamentoCorsoMatricola() {
        return $this->insegnamentoCorsoMatricola;
    }
    /**
     * Setta l'id della sessione
     * @param int $id L'id della sessione
     */
    public function setId($id) {
        $this->id = $id;
    }
    
   /**
     * Setta la tipologia della sessione
     * @param enum $tipologia La tipologia della sessione
     */
    public function setTipologia($tipologia) {
        $this->tipologia = $tipologia;
    }
    
    /**
     * Setta la data di inizio della sessione
     * @param date $dataInizio La data di inizio della sessione
     */
    public function setDataInizio($dataInizio) {
        $this->dataInizio = $dataInizio;
    }
   
    /**
     * Setta la data di termine della sessione
     * @param date $dataFine La data di termine della sessione
     */
    public function setDataFine($dataFine) {
        $this->dataFine = $dataFine;
    }
   
    /**
     * Setta la  soglia d'ammissione della sessione
     * @param float $sogliaAmmissione La soglia di ammissione della sessione
     */
    public function setSogliaAmmissione($sogliaAmmissione) {
        $this->sogliaAmmissione = $sogliaAmmissione;
    }

    /**
     * Setta l'id dell'insegnamento della sessione a cui appartiene
     * @param int $insegnamentoId L'id dell'insegnamento a cui appartiene la sessione
     */
    public function setInsegnamentoId($insegnamentoId) {
        $this->insegnamentoId = $insegnamentoId;
    }
    
    /**
     * Setta la matricola del corso a cui appartiene l'insegnamento relativo
     * @param string $insegnamentoCorsoMatricola La matricola del corso a cui appartiene l'insegnamento relativo
     */
    public function setInsegnamentoCorsoMatricola($insegnamentoCorsoMatricola) {
        $this->insegnamentoCorsoMatricola = $insegnamentoCorsoMatricola;
    }
 }