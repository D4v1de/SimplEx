<?php

/**
 * La classe descrive un argomento
 *
 * @author Dario Castellano
 * @version 1.0
 * @since 27/11/15
 */

class Argomento {
    private $id;
    private $corsoId;
    private $nome;

    /**
     * Costruttore di Argomento
     * @param int $id L'id dell'argomento
     * @param string $corsoId L'id del corso a cui appartiene l'argomento
     * @param string $nome Il nome dell'argomento
     */
    public function __construct($corsoId, $nome){
            $this->corsoId = $corsoId;
            $this->nome = $nome;
    }

    /**
     * @return int L'id dell'argomento
     */
    function getId() {
        return $this->id;
    }
    
    /**
     * @return int L'id del corso a cui appartiene
     */
    function getCorsoId() {
        return $this->corsoId;
    }
    
    /**
     * @return String Il nome dell'argomento
     */
    public function getNome() {
            return $this->nome;
    }

    /**
     * Setta l'id dell'argomento
     * @param int $id L'id dell'argomento
     */
    function setId($id) {
        $this->id = $id;
    }
    
    /**
     * Setta l'id del corso a cui appartiene
     * @param int $corsoId L'id del corso a cui appartiene
     */
    function setCorsoId($corsoId) {
        $this->corsoId = $corsoId;
    }
    
    /**
     * Setta il nome dell'argomento
     * @param string $nome Il nome dell'argomento
     */
    public function setNome($nome){
            $this->nome = $nome;
    }
}