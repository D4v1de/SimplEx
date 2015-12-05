<?php

/**
 * User: Giuseppina
 * Date: 27/11/15
 * Time: 10:36
 */
class RispostaAperta {
    private $id;
    private $elaboratoSessioneId;
    private $elaboratoStudenteMatricola;
    private $testo;
    private $punteggio;
    private $domandaApertaId;
    
    /**
     * Costruttore di Risposta_multipla
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato relativo
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato 
     * @param string $testo Il testo della risposta aperta
     * @param int $domandaApertaId L'id della domanda aperta a cui si riferisce
     */
    public function __construct($elaboratoSessioneId, $elaboratoStudenteMatricola, $testo, $punteggio, $domandaApertaId){
        $this->elaboratoSessioneId=$elaboratoSessioneId;
        $this->elaboratoStudenteMatricola=$elaboratoStudenteMatricola;
        $this->testo=$testo;
        $this->punteggio=$punteggio;
        $this->domandaApertaId=$domandaApertaId;
    } 
    
    /**
     * @return int L'id della risposta
     */
    function getId() {
        return $this->id;
    }
    
    /**
     * @return string L'id della sessione a cui appartiene l'elaborato
     */
    function getElaboratoSessioneId() {
        return $this->elaboratoSessioneId;
    }
    
    /**
     * @return string La matricola dello studente a cui appartiene l'elaborato
     */
    function getElaboratoStudenteMatricola() {
        return $this->elaboratoStudenteMatricola;
    }
    
    /**
     * @return string Il testo della risposta
     */
    function getTesto() {
        return $this->testo;
    }
    
    /**
     * @return float Il punteggio asseganto alla risposta
     */
    function getPunteggio() {
        return $this->punteggio;
    }

     /**
     * @return int l'id della domanda aperta
     */
    function getDomandaApertaId() {
        return $this->domandaApertaId;
    }

    /**
     * Setta l'id della risposta aperta
     * @param int $id L'id della risposta aperta
     */
    function setId($id) {
        $this->id = $id;
    }
    
    /**
     * Setta il testo della risposta aperta
     * @param string $testo Il testo della risposta aperta
     */
    function setTesto($testo) {
        $this->testo = $testo;
    }

    /**
     * Setta la matricola dello studente a cui appartiene l'elaborato
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato
     */
    function setElaboratoStudenteMatricola($elaboratoStudenteMatricola) {
        $this->elaboratoStudenteMatricola = $elaboratoStudenteMatricola;
    }

     /**
     * Setta l'id della domanda aperta relativa
     * @param int $domandaApertaId L'id della domanda aperta relativa
     */
    function setDomandaApertaId($domandaApertaId) {
        $this->domandaApertaId = $domandaApertaId;
    }
}
    