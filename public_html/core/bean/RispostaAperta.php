<?php

/**
 * User: Giuseppina
 * Date: 20/11/15
 * Time: 12:48
 */
class RispostaAperta {
    private $id;
    private $elaboratoSessioneId;
    private $elaboratoStudenteMatricola;
    private $testo;
    private $punteggio;
    private $domandaApertaId;
    private $domandaApertaArgomentoId;
    private $domandaApertaArgomentoInsegnamentoId;
    private $domandaApertaArgomentoInsegnamentoCorsoMatricola;
    
    /**
     * Costruttore di Risposta_multipla
     * @param int $id L'id della risposta aperta
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato relativo
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato 
     * @param string $testo Il testo della risposta aperta
     * @param int $domandaApertaId L'id della domanda aperta a cui si riferisce
     * @param int $domandaApertaArgomentoId L'id dell'argomento della domanda aperta
     * @param int $domandaApertaArgomentoInsegnamentoId L'id dell'insegnamento dell'argomento della domanda aperta
     * @param string $domandaApertaArgomentoInsegnamentoCorsoMatricola La matricola del corso dell'insegnamento a cui l'argomento appartiene
     */
    public function __construct($id, $elaboratoSessioneId, $elaboratoStudenteMatricola, $testo, $punteggio, $domandaApertaId, $domandaApertaArgomentoId,$domandaApertaArgomentoInsegnamentoId, $domandaApertaArgomentoInsegnamentoCorsoMatricola){
        $this->id=$id;
        $this->elaboratoSessioneId=$elaboratoSessioneId;
        $this->elaboratoStudenteMatricola=$elaboratoStudenteMatricola;
        $this->testo=$testo;
        $this->punteggio=$punteggio;
        $this->domandaApertaId=$domandaApertaId;
        $this->domandaApertaArgomentoId=$domandaApertaArgomentoId;
        $this->domandaApertaArgomentoInsegnamentoId=$domandaApertaArgomentoInsegnamentoId;
        $this->domandaApertaArgomentoInsegnamentoCorsoMatricola=$domandaApertaArgomentoInsegnamentoCorsoMatricola;
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
    function getDomandApertaId() {
        return $this->domandaApertaId;
    }

     /**
     * @return int L'id dell'argomento a cui la domanda aperta appartiene
     */
    function getDomandaApertaArgomentoId() {
        return $this->domandaApertaArgomentoId;
    }
    
     /**
     * @return int L'id dell'insegnamento dell'argomento a cui la domanda aperta appartiene
     */
    function getDomandaApertaArgomentoInsegnamentoId() {
        return $this->domandaApertaArgomentoInsegnamentoId;
    }

    /**
     * @return string La matricola del corso dell'insegnamento a cui la domanda aperta appartiene
     */
    function getDomandaApertaArgomentoInsegnamentoCorsoMatricola() {
        return $this->domandaApertaArgomentoInsegnamentoCorsoMatricola;
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
     * @param stirng $testo Il testo della risposta aperta
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

    /**
     * Setta l'id dell'argomento a cui appartiene la domanda aperta
     * @param int $domandaApertaArgomentoId L'id dell'argomento a cui appartiene la domanda aperta
     */
    function setDomandaApertaArgomentoId($domandaApertaArgomentoId) {
        $this->domandaApertaArgomentoId = $domandaApertaArgomentoId;
    }

    /**
     * Setta l'id dell'insegnamento a cui appartiene l'argomento relativo alla domanda
     * @param int $domandaApertaArgomentoInsegnamentoId L'id dell'insegnamento a cui appartiene l'argomento relativo alla domanda
     */
    function setDomandaApertaArgomentoInsegnamentoId($domandaApertaArgomentoInsegnamentoId) {
        $this->domandaApertaArgomentoInsegnamentoId = $domandaApertaArgomentoInsegnamentoId;
    }

    /**
     * Setta la matricola del corso dell'insegnamento a cui appartiene l'argomento relativo alla domanda
     * @param string $domandaApertaArgomentoInsegnamentoCorsoMatricola La matricola del corso dell'insegnamento a cui appartiene l'argomento relativo alla domanda
     */
    function setDomandaApertaArgomentoInsegnamentoCorsoMatricola($domandaApertaArgomentoInsegnamentoCorsoMatricola) {
        $this->domandaApertaArgomentoInsegnamentoCorsoMatricola = $domandaApertaArgomentoInsegnamentoCorsoMatricola;
    }
}
    