<?php

/**
 * User: Dario
 * Date: 20/11/15
 * Time: 09:28
 */

class Argomento {
    private $id;
    private $nome;
    private $insegnamentoId;
    private $insegnamentoCorsoMatricola;

    /**
     * Costruttore di Argomento
     * @param int $id L'id dell'argomento
     * @param string $nome $nome Il nome dell'argomento
     * @param int $insegnamentoId L'id dell'insegnamento a cui appartiene l'argomento
     * @param string $insegnamentoCorsoMatricola La matricola del corso a cui appartiene l'insegnamento relativo all'argomento
     */
    public function __construct($id, $nome, $insegnamentoId, $insegnamentoCorsoMatricola){
            $this->id = $id;
            $this->nome = $nome;
            $this->insegnamentoId = $insegnamentoId;
            $this->insegnamentoCorsoMatricola= $insegnamentoCorsoMatricola;
    }

    /**
     * @return int L'id dell'argomento
     */
    function getId() {
        return $this->id;
    }

    /**
     * @return String Il nome dell'argomento
     */
    public function getNome() {
            return $this->nome;
    }

    /**
     * @return int L'id dell'insegnamento a cui appartiene
     */
    function getInsegnamentoId() {
        return $this->insegnamentoId;
    }

    /**
     * @return String La matricola del corso a cui l'insegnamento relativo appartiene
     */
    function getInsegnamentoCorsoMatricola() {
        return $this->insegnamentoCorsoMatricola;
    }

    /**
     * Setta l'id dell'argomento
     * @param int $id L'id dell'argomento
     */
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Setta il nome dell'argomento
     * @param string $nome Il nome dell'argomento
     */
    public function setNome($nome){
            $this->nome = $nome;
    }

    /**
     * Setta l'id dell'insegnamento a cui appartiene
     * @param int $insegnamentoId L'id dell'insegnamento a cui appartiene
     */
    function setInsegnamentoId($insegnamentoId) {
        $this->insegnamentoId = $insegnamentoId;
    }

    /**
     * Setta l'id del corso a cui l'insegnamento relativo appartiene
     * @param string $insegnamentoCorsoMatricola L'id del corso a cui l'insegnamento relativo appartiene
     */
    function setInsegnamentoCorsoMatricola($insegnamentoCorsoMatricola) {
        $this->insegnamentoCorsoMatricola = $insegnamentoCorsoMatricola;
    }
}