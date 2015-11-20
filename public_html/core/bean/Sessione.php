<?php

/**
 * User: Giuseppina
 * Date: 20/11/15
 * Time: 10:45
 */
class Sessione {
    private $id;
    private $tipologia;
    private $data_inizio;
    private $data_fine;
    private $soglia_ammissione;
    private $insegnamento_id;
    private $insegnamento_corso_matricola;
    
    /**
     * Costruttore di Sessione
     */
    public function __construct($id, $tipologia, $data_inizio, $data_fine, $soglia_ammissione, $insegnamento_id, $insegnamento_corso_matricola ) {
        $this->id=$id;
        $this->tipologia=$tipologia;
        $this->data_inizio=$data_inizio;
        $this->data_fine=$data_fine;
        $this->soglia_ammissione=$soglia_ammissione;
        $this->insegnamento_id=$insegnamento_id;
        $this->insegnamento_corso_matricola=$insegnamento_corso_matricola;
    } 

    /**
     * @return l'id della sessione
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return la tipologia della sessione
     */
    public function getTipologia() {
        return $this->tipologia;
    }
    
    /**
     * @return la data_inizio della sessione
     */
     public function getDataInizio() {
        return $this->data_inizio;
    }
    
    /**
     * @return la data_fine della sessione
     */
     public function getDataFine() {
        return $this->data_fine;
    }
    
    /**
     * @return la soglia_ammissione della sessione
     */
     public function getSogliaAmmissione() {
        return $this->soglia_ammissione;
    }
    
    /**
     * @return l'id dell'insegnamento a cui appartiene
     */
     public function getInsegnamentoId() {
        return $this->insegnamento_id;
    }
    
     /**
     * @return la matricola del corso dell'insegnamento
     */
     public function getInsegnamentoCorsoMatricola() {
        return $this->insegnamento_corso_matricola;
    }
    /**
     * Setta l'id della sessione
     * @param $id id della sessione
     */
    public function setId($id) {
        $this->id = $id;
    }
    
   /**
     * Setta la tipologia della sessione
     * @param $tipologia tipologia della sessione
     */
    public function setTipologia($tipologia) {
        $this->tipologia = $tipologia;
    }
    
    /**
     * Setta la data_inizio della sessione
     * @param $data_inizio data_inizio della sessione
     */
    public function setDataInizio($data_inizio) {
        $this->data_inizio = $data_inizio;
    }
   
    /**
     * Setta la data_fine della sessione
     * @param $data_fine data_fine della sessione
     */
    public function setDataFine($data_fine) {
        $this->data_fine = $data_fine;
    }
   
    /**
     * Setta la  soglia d'ammissione della sessione
     * @param $soglia_ammissione soglia_ammissione della sessione
     */
    public function setSogliaAmmissione($soglia_ammissione) {
        $this->soglia_ammissione = $soglia_ammissione;
    }

    /**
     * Setta l'id dell'insegnamento della sessione a cui appartiene
     * @param $insegnamento_id id dell'insegnamento della sessione
     */
    public function setInsegnamentoId($insegnamento_id) {
        $this->insegnamento_id = $insegnamento_id;
    }
    
    /**
     * Setta la matricola del corso dell'insegnamento a cui appartiene
     * @param $insegnamento_corso_matricola la matricola del corso dell'insegnamento a cui appartiene
     */
    public function setInsegnamentoCorsoMatricola($insegnamento_corso_matricola) {
        $this->insegnamento_corso_matricola = $insegnamento_corso_matricola;
    }
 }