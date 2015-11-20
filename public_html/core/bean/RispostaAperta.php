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
    function getTesto() {
        return $this->testo;
    }

    function getElaboratoStudenteMatricola() {
        return $this->elaborato_studente_matricola;
    }

    function getDomandApertaId() {
        return $this->domanda_aperta_id;
    }

    function getDomandaApertaArgomentoId() {
        return $this->domanda_aperta_argomento_id;
    }

    function getDomandaApertaArgomentoInsegnamentoId() {
        return $this->domanda_aperta_argomento_insegnamento_id;
    }

    function getDomandaApertaArgomentoInsegnamentoCorsoMatricola() {
        return $this->domanda_aperta_argomento_insegnamento_corso_matricola;
    }

    function setTesto($testo) {
        $this->testo = $testo;
    }

    function setElaboratoStudenteMatricola($elaborato_studente_matricola) {
        $this->elaborato_studente_matricola = $elaborato_studente_matricola;
    }

    function setDomandaApertaId($domanda_aperta_id) {
        $this->domanda_aperta_id = $domanda_aperta_id;
    }

    function setDomandaApertaArgomentoId($domanda_aperta_argomento_id) {
        $this->domanda_aperta_argomento_id = $domanda_aperta_argomento_id;
    }

    function setDomandaApertaArgomentoInsegnamentoId($domanda_aperta_argomento_insegnamento_id) {
        $this->domanda_aperta_argomento_insegnamento_id = $domanda_aperta_argomento_insegnamento_id;
    }

    function setDomandaApertaArgomentoInsegnamentoCorsoMatricola($domanda_aperta_argomento_insegnamento_corso_matricola) {
        $this->domanda_aperta_argomento_insegnamento_corso_matricola = $domanda_aperta_argomento_insegnamento_corso_matricola;
    }



}
    