<?php

/**
 * User: Giuseppina
 * Date: 20/11/15
 * Time: 12:48
 */
class RispostaAperta {
    private $testo;
    private $elaboratoStudenteMatricola;
    private $domandaApertaId;
    private $domandaApertaArgomentoId;
    private $domandaApertaArgomentoInsegnamentoId;
    private $domandaApertaArgomentoInsegnamentoCorsoMatricola;
    
    /**
     * Costruttore di Risposta_multipla
     * @param $testo testo risposta aperta
     * @param $elaboratoStudenteMatricola la matricola dello studente a cui appartiene l'elaborato
     * @param $domandaApertaId l'id della domanda aperta a cui si riferisce
     * @param $domandaApertaArgomentoId l'id dell'argomento della domanda aperta
     * @param $domandaApertaArgomentoInsegnamentoId l'id dell'insegnamento dell'argomento della domanda aperta
     * @param $domandaApertaArgomentoInsegnamentoCorsoMatricola la matricola del corso dell'insegnamento a cui l'argomento appartiene
     * 
     */
    public function __construct($testo, $elaboratoStudenteMatricola, $domandaApertaId, $domandaApertaArgomentoId,$domandaApertaArgomentoInsegnamentoId, $domandaApertaArgomentoInsegnamentoCorsoMatricola){
        $this->testo=$testo;
        $this->elaboratoStudenteMatricola=$elaboratoStudenteMatricola;
        $this->domandaApertaId=$domandaApertaId;
        $this->domandaApertaArgomentoId=$domandaApertaArgomentoId;
        $this->domandaApertaArgomentoInsegnamentoId=$domandaApertaArgomentoInsegnamentoId;
        $this->domandaApertaArgomentoInsegnamentoCorsoMatricola=$domandaApertaArgomentoInsegnamentoCorsoMatricola;
    } 
    
     /**
     * @return il testo dlela risposta
     */
    function getTesto() {
        return $this->testo;
    }

     /**
     * @return la matricola dell'elaborato dello studente
     */
    function getElaboratoStudenteMatricola() {
        return $this->elaboratoStudenteMatricola;
    }

     /**
     * @return l'id della domanda aperta
     */
    function getDomandApertaId() {
        return $this->domandaApertaId;
    }

     /**
     * @return l'id dell'argomento a cui la domanda aperta appartiene
     */
    function getDomandaApertaArgomentoId() {
        return $this->domandaApertaArgomentoId;
    }
    
     /**
     * @return l'id dell'insegnamento dell'argomento a cui la domanda aperta appartiene
     */
    function getDomandaApertaArgomentoInsegnamentoId() {
        return $this->domandaApertaArgomentoInsegnamentoId;
    }

    /**
     * @return la matricola del corso dell'insegnamento a cui la domanda aperta appartiene
     */
    function getDomandaApertaArgomentoInsegnamentoCorsoMatricola() {
        return $this->domandaApertaArgomentoInsegnamentoCorsoMatricola;
    }

     /**
     * Setta il testo della risposta aperta
     * @param $Testo testo della risposta aperta
     */
    function setTesto($testo) {
        $this->testo = $testo;
    }

    /**
     * Setta la matricola dell'elaborato dello studente
     * @param $elaboratoStudenteMatricola matricola dell'elaborato dello studente
     */
    function setElaboratoStudenteMatricola($elaboratoStudenteMatricola) {
        $this->elaboratoStudenteMatricola = $elaboratoStudenteMatricola;
    }

     /**
     * Setta l'id della domanda aperta
     * @param $domandaApertaId id della domanda aperta
     */
    function setDomandaApertaId($domandaApertaId) {
        $this->domandaApertaId = $domandaApertaId;
    }

    /**
     * Setta l'id dell'argomento della domanda aperta
     * @param $domandaApertaArgomentoId id dell'argomento della domanda aperta
     */
    function setDomandaApertaArgomentoId($domandaApertaArgomentoId) {
        $this->domandaApertaArgomentoId = $domandaApertaArgomentoId;
    }

    /**
     * Setta l'id dell'insegnamento dell'argomento a cui la domanda appartiene
     * @param $domandaApertaArgomentoInsegnamentoId id dell'insegnamento dell'argomento a cui la domanda appartiene
     */
    function setDomandaApertaArgomentoInsegnamentoId($domandaApertaArgomentoInsegnamentoId) {
        $this->domandaApertaArgomentoInsegnamentoId = $domandaApertaArgomentoInsegnamentoId;
    }

    /**
     * Setta la matricola del corso dell'insegnamento dell'argomento a cui la domanda appartiene
     * @param $domandaApertaArgomentoInsegnamentoCorsoMatricola la matricola del corso dell'insegnamento dell'argomento a cui la domanda appartiene
     */
    function setDomandaApertaArgomentoInsegnamentoCorsoMatricola($domandaApertaArgomentoInsegnamentoCorsoMatricola) {
        $this->domandaApertaArgomentoInsegnamentoCorsoMatricola = $domandaApertaArgomentoInsegnamentoCorsoMatricola;
    }



}
    