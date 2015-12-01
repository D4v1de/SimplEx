<?php

/**
 * User: Giuseppina
 * Date: 27/11/15
 * Time: 10:30
 */
class Sessione {
    private $id;
    private $dataInizio;
    private $dataFine;
    private $sogliaAmmissione;
    private $stato;
    private $tipologia;
    private $corsoId;
    
    /**
     * Costruttore di Sessione
     * @param date $dataInizio La data di inizio della sessione
     * @param date $dataFine La data di termine della sessione
     * @param float $sogliaAmmissione La soglia di ammissione della sessione
     * @param enum $stato Lo stato della sessione
     * @param enum $tipologia La tipologia della sessione
     * @param int $corsoId L'id dell'insegnamento a cui appartiene la sessione
     */
    public function __construct($dataInizio, $dataFine, $sogliaAmmissione, $stato, $tipologia, $corsoId) {
        $this->dataInizio = $dataInizio;
        $this->dataFine = $dataFine;
        $this->sogliaAmmissione = $sogliaAmmissione;
        $this->stato = $stato;
        $this->tipologia = $tipologia;
        $this->corsoId = $corsoId;
    } 

    /**
     * @return int L'id della sessione
     */
    public function getId() {
        return $this->id;
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
     * @return enum Lo stato della sessione
     */
    public function getStato() {
        return $this->stato;
    }        
            
    /**
     * @return enum La tipologia della sessione
     */
    public function getTipologia() {
        return $this->tipologia;
    }
    
    /**
     * @return int L'id del corso a cui appartiene
     */
     public function getCorsoId() {
        return $this->corsoId;
    }
    
    /**
     * Setta l'id della sessione
     * @param int $id L'id della sessione
     */
    public function setId($id) {
        $this->id = $id;
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
     * Setta lo stato della sessione
     * @param enum $stato Lo stato della sessione
     */
    public function setStato($stato) {
        $this->stato = $stato;
    }        
            
    /**
     * Setta la tipologia della sessione
     * @param enum $tipologia La tipologia della sessione
     */
    public function setTipologia($tipologia) {
        $this->tipologia = $tipologia;
    }

    /**
     * Setta l'id del corso a cui appartiene
     * @param int $corsoId L'id del corso a cui appartiene la sessione
     */
    public function setCorsoId($corsoId) {
        $this->corsoId = $corsoId;
    }
 }