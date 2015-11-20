<?php

/**
 * User: Giuseppina
 * Date: 20/11/15
 * Time: 11:17
 */
class Test {
    private $id;
    private $descrizione;
    private $punteggio_max;
    private $numero_multiple;
    private $numero_aperte;
    private $percentuale_scelto;
    private $percentuale_successo;
    private $elaboratostudente_matricola;
    private $elaboratosessione_id;



    /**
     * Costruttore di Test
     * @param $id id del test
     * @param $descrizione Descrizione del test
     * @param $punteggio_max Punteggio massimo del test
     * @param $numero_multiple Numero domande multiple
     * @param $numero_aperte Numero domande aperte
     * @param $percentuale_scelto Percentuale di volte in cui il test viene scelto
     * @param $percentuale_successo Percentuale di successo del test
     * @param $elaboratostudente_matricola La matricola dell'elaborato dello studente
     * @param $elaboratosessione_id l'id dell'elaborato della sessione
     */
    public function __construct($id, $descrizione, $punteggio_max, $numero_multiple, $numero_aperte, $percentuale_scelto, $percentuale_successo, $elaboratostudente_matricola, $elaboratosessione_id ) {
        $this->id=$id;
        $this->descrizione=$descrizione;
        $this->punteggio_max=$punteggio_max;
        $this->numero_multiple=$numero_multiple;
        $this->numero_aperte=$numero_aperte;
        $this->percentuale_scelto=$percentuale_scelto;
        $this->percentuale_successo=$percentuale_successo;
        $this->elaboratostudente_matricola=$elaboratostudente_matricola;
        $this->elaboratosessione_id=$elaboratosessione_id;
    } 
    
     /**
     * @return l'id del test
     */
    function getId() {
        return $this->id;
    }
    
     /**
     * @return la descrizione del test
     */
    function getDescrizione() {
        return $this->descrizione;
    }

     /**
     * @return il punteggio massimo del test
     */
    function getPunteggioMax() {
        return $this->punteggio_max;
    }

     /**
     * @return il numero di domande multiple del test
     */
    function getNumeroMultiple() {
        return $this->numero_multiple;
    }

     /**
     * @return il numero di domande aperte del test
     */
    function getNumeroAperte() {
        return $this->numero_aperte;
    }

     /**
     * @return la percentuale delle volte in cui il test è stato scelto
     */
    function getPercentualeScelto() {
        return $this->percentuale_scelto;
    }

     /**
     * @return la percentuale di successo del test
     */
    function getPercentualeSuccesso() {
        return $this->percentuale_successo;
    }
    
    /**
     * @return la matricola dell'elaborato dello studente
     */
    function getElaboratostudenteMatricola() {
        return $this->elaboratostudente_matricola;
    }

    /**
     * @return l'id dell'elaborato della sessione
     */
    function getElaboratosessioneId() {
        return $this->elaboratosessione_id;
    }
    
    
    /**
     * Setta l'id del test
     * @param $id id del test
     */
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Setta la descrizione della sessione
     * @param $descrizione descrizione del test
     */
    function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
    }

    /**
     * Setta il punteggio massimo del test
     * @param $punteggio_max punteggio massimo del test
     */
    function setPunteggioMax($punteggio_max) {
        $this->punteggio_max = $punteggio_max;
    }

    /**
     * Setta il numero di domande multiple del test
     * @param $numero_multiple numero di domande multiple del test
     */
    function setNumeroMultiple($numero_multiple) {
        $this->numero_multiple = $numero_multiple;
    }

     /**
     * Setta il numero di domande aperte del test
     * @param $numero_aperte numero di domande aperte del test
     */
    function setNumeroAperte($numero_aperte) {
        $this->numero_aperte = $numero_aperte;
    }

     /**
     * Setta la percentuale delle volte in cui il test è stato scelto
     * @param $percentuale_scelto percentuale di scelta del test
     */
    function setPercentualeScelto($percentuale_scelto) {
        $this->percentuale_scelto = $percentuale_scelto;
    }

     /**
     * Setta la percentuale di successo del test
     * @param $percentuale_successo percentuale successo test
     */
    function setPercentualeSuccesso($percentuale_successo) {
        $this->percentuale_successo = $percentuale_successo;
    }
    
    /**
     * Setta la matricola dell'elaborato dello studente
     * @param $elaboratostudente_matricola matricola dell'elaborato dello studente
     */
    function setElaboratostudenteMatricola($elaboratostudente_matricola) {
        $this->elaboratostudente_matricola = $elaboratostudente_matricola;
    }

    /**
     * Setta l'id dell'elaborato della sessione
     * @param $elaboratosessione_id id dell'elaborato della sessione
     */
    function setElaboratosessioneId($elaboratosessione_id) {
        $this->elaboratosessione_id = $elaboratosessione_id;
    }


    
}