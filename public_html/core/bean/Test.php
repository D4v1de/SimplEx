<?php

/**
 * La classe descrive un test.
 *
 * @author Giuseppina Tufano
 * @version 1.0
 * @since 27/11/15
 */

class Test {
    private $id;
    private $descrizione;
    private $punteggioMax;
    private $numeroMultiple;
    private $numeroAperte;
    private $percentualeScelto;
    private $percentualeSuccesso;
    private $corsoId;

    /**
     * Costruttore di Test
     * @param string $descrizione La descrizione del test
     * @param float $punteggioMax Il punteggio massimo del test
     * @param int $numeroMultiple Numero di domande multiple
     * @param int $numeroAperte Numero di domande aperte
     * @param float $percentualeScelto Percentuale di volte in cui il test viene scelto
     * @param float $percentualeSuccesso Percentuale di successo del test
     * @param int $corso_id L'id del corso a cui appartiene
     */
    public function __construct($descrizione, $punteggioMax, $numeroMultiple, $numeroAperte, $percentualeScelto, $percentualeSuccesso, $corsoId) {
        $this->descrizione=$descrizione;
        $this->punteggioMax=$punteggioMax;
        $this->numeroMultiple=$numeroMultiple;
        $this->numeroAperte=$numeroAperte;
        $this->percentualeScelto=$percentualeScelto;
        $this->percentualeSuccesso=$percentualeSuccesso;
        $this->corsoId = $corsoId;
    } 
    
    /**
     * @return int L'id del test
     */
    function getId() {
        return $this->id;
    }
    
    /**
     * @return string La descrizione del test
     */
    function getDescrizione() {
        return $this->descrizione;
    }

    /**
     * @return float Il punteggio massimo del test
     */
    function getPunteggioMax() {
        return $this->punteggioMax;
    }

    /**
     * @return int Il numero di domande multiple del test
     */
    function getNumeroMultiple() {
        return $this->numeroMultiple;
    }

    /**
     * @return int Il numero di domande aperte del test
     */
    function getNumeroAperte() {
        return $this->numeroAperte;
    }

    /**
     * @return float La percentuale delle volte in cui il test è stato scelto
     */
    function getPercentualeScelto() {
        return $this->percentualeScelto;
    }

    /**
     * @return float La percentuale di successo del test
     */
    function getPercentualeSuccesso() {
        return $this->percentualeSuccesso;
    }

    /**
     * @return int L'id del corso a cui appartiene
     */
    function getCorsoId() {
        return $this->corsoId;
    }
        
    /**
     * Setta l'id del test
     * @param int $id L'id del test
     */
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Setta la descrizione della sessione
     * @param string $descrizione La descrizione del test
     */
    function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
    }

    /**
     * Setta il punteggio massimo del test
     * @param float $punteggioMax Il punteggio massimo del test
     */
    function setPunteggioMax($punteggioMax) {
        $this->punteggioMax = $punteggioMax;
    }

    /**
     * Setta il numero di domande multiple del test
     * @param int $numeroMultiple Il numero di domande multiple del test
     */
    function setNumeroMultiple($numeroMultiple) {
        $this->numeroMultiple = $numeroMultiple;
    }

    /**
     * Setta il numero di domande aperte del test
     * @param int $numeroAperte Il numero di domande aperte del test
     */
    function setNumeroAperte($numeroAperte) {
        $this->numeroAperte = $numeroAperte;
    }

    /**
     * Setta la percentuale delle volte in cui il test è stato scelto
     * @param float $percentualeScelto La percentuale di volte in cui il test è stato scelto
     */
    function setPercentualeScelto($percentualeScelto) {
        $this->percentualeScelto = $percentualeScelto;
    }

    /**
     * Setta la percentuale di successo del test
     * @param float $percentualeSuccesso La percentuale di successo del test
     */
    function setPercentualeSuccesso($percentualeSuccesso) {
        $this->percentualeSuccesso = $percentualeSuccesso;
    }

    /**
     * Setta l'id del corso a cui appartiene
     * @param int $corsoId L'id del corso a cui appartiene
     */
    function setCorsoId($corsoId) {
        $this->corsoId = $corsoId;
    }
}