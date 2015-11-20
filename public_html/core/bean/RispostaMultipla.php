<?php

/**
 * User: Giuseppina
 * Date: 20/11/15
 * Time: 11:38
 */
class RispostaMultipla {
    private $elaborato_studente_matricola;
    private $elaborato_sessione_id;
    private $alternativa_id;
    private $alternativa_domanda_multipla_argomento_id;
    private $alternativa_domanda_multipla_argomento_insegnamento_id;
    private $alternativa_domanda_multipla_argomento_insegnamento_corso_matricola;
    
    /**
     * Costruttore di Risposta_multipla
     * @param $elaborato_studente_matricola la matricola dello studente a cui appartiene l'elaborato
     * @param $elaborato_sessione_id l'id della sessione a cui appartiene l'elaborato
     * @param $alternativa_id l'id dell'alternativa scelta
     * @param $alternativa_domanda_multipla_argomento_id l'id dell'argomento a cui appartiene l'alternativa scelta
     * @param $alternativa_domanda_multipla_argomento_insegnamento_id l'id dell'insegnamento dell'argomento a cui appartiene l'alternativa scelta
     * @param $alternativa_domanda_multipla_argomento_insegnamento_corso_matricola la matricola del corso dell'argomento a cui appartiene l'alternativa scelta
     * 
     */
    public function __construct($elaborato_studente_matricola, $elaborato_sessione_id, $alternativa_id, $alternativa_domanda_multipla_argomento_id, $alternativa_domanda_multipla_argomento_insegnamento_id, $alternativa_domanda_multipla_argomento_insegnamento_corso_matricola) {
        $this->elaborato_studente_matricola=$elaborato_studente_matricola;
        $this->elaborato_sessione_id=$elaborato_sessione_id;
        $this->alternativa_id=$alternativa_id;
        $this->alternativa_domanda_multipla_argomento_id=$alternativa_domanda_multipla_argomento_id;
        $this->alternativa_domanda_multipla_argomento_insegnamento_id=$alternativa_domanda_multipla_argomento_insegnamento_id;
        $this->alternativa_domanda_multipla_argomento_insegnamento_corso_matricola=$alternativa_domanda_multipla_argomento_insegnamento_corso_matricola;
        
    } 
    
    /**
     * @return la matricola dell'elaborato dello studente
     */
    function getElaboratoStudenteMatricola() {
        return $this->elaborato_studente_matricola;
    }

    /**
     * @return l'id della sessione dell'elaborato
     */
    function getElaboratoSessioneId() {
        return $this->elaborato_sessione_id;
    }

    /**
     * @return l'id dell'alternativa scelta
     */
    function getAlternativaId() {
        return $this->alternativa_id;
    }

    /**
     * @return l'id dell'argomento a cui appartiene l'alternativa scelta
     */
    function getAlternativaDomandaMultiplaArgomentoId() {
        return $this->alternativa_domanda_multipla_argomento_id;
    }

    /**
     * @return l'id dell'insegnamento dell'argomento a cui appartiene l'alternativa scelta
     */
    function getAlternativaDomandaMultiplaArgomentoInsegnamentoId() {
        return $this->alternativa_domanda_multipla_argomento_insegnamento_id;
    }

    /**
     * @return la matricola del corso dell'argomento a cui appartiene l'alternativa scelta
     */
    function getAlternativaDomandaMultiplaArgomentoInsegnamentoCorsoMatricola() {
        return $this->alternativa_domanda_multipla_argomento_insegnamento_corso_matricola;
    }

    /**
     * Setta la matricola dell'elaborato dello studente
     * @param $elaborato_studente_matricola matricola dell'elaborato dello studente
     */
    function setElaboratoStudenteMatricola($elaborato_studente_matricola) {
        $this->elaborato_studente_matricola = $elaborato_studente_matricola;
    }

    /**
     * Setta l'id dell'elaborato della sessione
     * @param $elaborato_sessione_id id dell'elaborato della sessione
     */
    function setElaboratoSessioneId($elaborato_sessione_id) {
        $this->elaborato_sessione_id = $elaborato_sessione_id;
    }

     /**
     * Setta l'id dell'alternativa scelta
     * @param $alternativa_id id alternativa scelta
     */
    function setAlternativaId($alternativa_id) {
        $this->alternativa_id = $alternativa_id;
    }

     /**
     * Setta l'id dell'argomento a cui appartiene l'alternativa scelta
     * @param $alternativa_domanda_multipla_argomento_id id dell'argomento a cui appartiene l'alternativa scelta
     */
    function setAlternativaDomandaMultiplaArgomentoId($alternativa_domanda_multipla_argomento_id) {
        $this->alternativa_domanda_multipla_argomento_id = $alternativa_domanda_multipla_argomento_id;
    }

    /**
     * Setta l'id dell'insegnamento dell'argomento a cui appartiene l'alternativa scelta
     * @param $alternativa_domanda_multipla_argomento_insegnamento_id l'id dell'insegnamento dell'argomento a cui appartiene l'alternativa scelta
     */
    function setAlternativaDomandaMultiplaArgomentoInsegnamentoId($alternativa_domanda_multipla_argomento_insegnamento_id) {
        $this->alternativa_domanda_multipla_argomento_insegnamento_id = $alternativa_domanda_multipla_argomento_insegnamento_id;
    }

    /**
     * Setta la matricola del corso dell'argomento a cui appartiene l'alternativa scelta
     * @param $alternativa_domanda_multipla_argomento_insegnamento_corso_matricola la matricola del corso dell'argomento a cui appartiene l'alternativa scelta
     */
    function setAlternativaDomandaMultiplaArgomentoInsegnamentoCorsoMatricola($alternativa_domanda_multipla_argomento_insegnamento_corso_matricola) {
        $this->alternativa_domanda_multipla_argomento_insegnamento_corso_matricola = $alternativa_domanda_multipla_argomento_insegnamento_corso_matricola;
    }


}
    