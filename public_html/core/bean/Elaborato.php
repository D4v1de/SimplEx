<?php

/**
 * User: Elvira
 * Date: 20/11/15
 * Time: 10:43
 */
class Elaborato {
    private $studente_matricola;
    private $sessione_id;
    private $esito_parziale;
    private $esito_finale;

    /**
     * Costruttore di Elaborato.
     * @param $studente_matricola la matricola dello studente a cui appartiene
     * @param $sessione_id l'id della sessione a cui appartiene
     * @param $esito_parziale l'esito parziale dell'elaborato
     * @param $esito_finale l'esito finale dell'elaborato
     */
    public function __construct($studente_matricola, $sessione_id, $esito_parziale, $esito_finale) {
        $this->studente_matricola = $studente_matricola;
        $this->sessione_id = $sessione_id;
        $this->esito_parziale = $esito_parziale;
        $this->esito_finale = $esito_finale;
    }
    
    /**
     * @return la matricola dello studente a cui appartiene
     */
    public function getStudenteMatricola() {
        return $this->studente_matricola;
    }

    /**
     * @return l'id della sessione a cui appartiene
     */
    public function getSessioneId() {
        return $this->sessione_id;
    }

    /**
     * @return l'esito parziale dell'elaborato
     */
    public function getEsitoParziale() {
        return $this->esito_parziale;
    }
    
    /**
     * @return l'esito finale dell'elaborato
     */
    public function getEsitoFinale() {
        return $this->esito_finale;
    }

    /**
     * Setta la matricola dello studente a cui appartiene
     * @param studente_matricola la matricola dello studente a cui appartiene
     */
    public function setStudenteMatricola($studente_matricola) {
        $this->studente_matricola = $studente_matricola;
    }
    
    /**
     * Setta l'id della sessione a cui appartiene
     * @param $sessione_id l'id della sessione a cui appartiene
     */
    public function setSessioneId($sessione_id) {
        $this->sessione_id = $sessione_id;
    }
    
    /**
     * Setta l'esito parziale dell'elaborato
     * @param $esito_parziale l'esito parziale dell'elaborato
     */
    public function setEsitoParziale($esito_parziale) {
        $this->esito_parziale = $esito_parziale;
    }
    
    /**
     * Setta l'esito finale dell'elaborato
     * @param $esito_finale l'esito parziale dell'elaborato
     */
    public function setEsitoFinale($esito_finale) {
        $this->esito_finale = $esito_finale;
    }
}