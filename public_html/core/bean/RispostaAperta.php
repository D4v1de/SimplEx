<?php

/**
 * User: Giuseppina
 * Date: 20/11/15
 * Time: 12:48
 */
class RispostaAperta {
    private $testo;
    private $elaborato_studente_matricola;
    private $domanda_aperta_id;
    private $domanda_aperta_argomento_id;
    private $domanda_aperta_argomento_insegnamento_id;
    private $domanda_aperta_argomento_insegnamento_corso_matricola;
    
    /**
     * Costruttore di Risposta_multipla
     * @param $testo testo risposta aperta
     * @param $elaborato_studente_matricola la matricola dello studente a cui appartiene l'elaborato
     * @param $domanda_aperta_id l'id della domanda aperta
     * @param $domanda_aperta_argomento_id l'id dell'argomento della domanda aperta
     * @param $domanda_aperta_argomento_insegnamento_id l'id dell'insegnamento dell'argomento della domanda aperta
     * @param $domanda_aperta_argomento_insegnamento_corso_matricola la matricola del corso dell'insegnamento a cui l'argomento appartiene
     * 
     */
    public function __construct($testo, $elaborato_studente_matricola, $domanda_aperta_id, $domanda_aperta_argomento_id,$domanda_aperta_argomento_insegnamento_id, $domanda_aperta_argomento_insegnamento_corso_matricola){
        $this->testo=$testo;
        $this->elaborato_studente_matricola=$elaborato_studente_matricola;
        $this->domanda_aperta_id=$domanda_aperta_id;
        $this->domanda_aperta_argomento_id=$domanda_aperta_argomento_id;
        $this->domanda_aperta_argomento_insegnamento_id=$domanda_aperta_argomento_insegnamento_id;
        $this->domanda_aperta_argomento_insegnamento_corso_matricola=$domanda_aperta_argomento_insegnamento_corso_matricola;
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
        return $this->elaborato_studente_matricola;
    }

     /**
     * @return l'id della domanda aperta
     */
    function getDomandApertaId() {
        return $this->domanda_aperta_id;
    }

     /**
     * @return l'id dell'argomento a cui la domanda aperta appartiene
     */
    function getDomandaApertaArgomentoId() {
        return $this->domanda_aperta_argomento_id;
    }
    
     /**
     * @return l'id dell'insegnamento dell'argomento a cui la domanda aperta appartiene
     */
    function getDomandaApertaArgomentoInsegnamentoId() {
        return $this->domanda_aperta_argomento_insegnamento_id;
    }

    /**
     * @return la matricola del corso dell'insegnamento a cui la domanda aperta appartiene
     */
    function getDomandaApertaArgomentoInsegnamentoCorsoMatricola() {
        return $this->domanda_aperta_argomento_insegnamento_corso_matricola;
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
     * @param $elaborato_studente_matricola matricola dell'elaborato dello studente
     */
    function setElaboratoStudenteMatricola($elaborato_studente_matricola) {
        $this->elaborato_studente_matricola = $elaborato_studente_matricola;
    }

     /**
     * Setta l'id della domanda aperta
     * @param $domanda_aperta_id id della domanda aperta
     */
    function setDomandaApertaId($domanda_aperta_id) {
        $this->domanda_aperta_id = $domanda_aperta_id;
    }

    /**
     * Setta l'id dell'argomento della domanda aperta
     * @param $domanda_aperta_argomento_id id dell'argomento della domanda aperta
     */
    function setDomandaApertaArgomentoId($domanda_aperta_argomento_id) {
        $this->domanda_aperta_argomento_id = $domanda_aperta_argomento_id;
    }

    /**
     * Setta l'id dell'insegnamento dell'argomento a cui la domanda appartiene
     * @param $domanda_aperta_argomento_insegnamento_id id dell'insegnamento dell'argomento a cui la domanda appartiene
     */
    function setDomandaApertaArgomentoInsegnamentoId($domanda_aperta_argomento_insegnamento_id) {
        $this->domanda_aperta_argomento_insegnamento_id = $domanda_aperta_argomento_insegnamento_id;
    }

    /**
     * Setta la matricola del corso dell'insegnamento dell'argomento a cui la domanda appartiene
     * @param $domanda_aperta_argomento_insegnamento_corso_matricola la matricola del corso dell'insegnamento dell'argomento a cui la domanda appartiene
     */
    function setDomandaApertaArgomentoInsegnamentoCorsoMatricola($domanda_aperta_argomento_insegnamento_corso_matricola) {
        $this->domanda_aperta_argomento_insegnamento_corso_matricola = $domanda_aperta_argomento_insegnamento_corso_matricola;
    }



}
    