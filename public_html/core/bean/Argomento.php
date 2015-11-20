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
     * @param $id
     * @param $nome
     * @param $insegnamentoId
     * @param $insegnamentoCorsoMatricola
     */
    public function __construct($id,$nome,$insegnamentoId,$insegnamentoCorsoMatricola){
            $this->id = $id;
            $this->nome = $nome;
            $this->insegnamentoId = $insegnamentoId;
            $this->insegnamentoCorsoMatricola= $insegnamentoCorsoMatricola;
    }

    /**
     * @return int id dell'argomento
     */
    function getId() {
        return $this->id;
    }

    /**
     * @return String nome dell'argomento
     */
    public function getNome() {
            return $this->nome;
    }

    /**
     * @return int l'id dell'insegnamento a cui appartiene
     */
    function getInsegnamentoId() {
        return $this->insegnamentoId;
    }

    /**
     * @return String la matricola del corso a cui l'insegnamento relativo appartiene
     */
    function getInsegnamentoCorsoMatricola() {
        return $this->insegnamentoCorsoMatricola;
    }

    /**
     * Setta l'id dell'argomento
     * @param $id l'id dell'argomento
     */
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Setta il nome dell'argomento
     * @param $nome il nome dell'argomento
     */
    public function setNome($nome){
            $this->nome = $nome;
    }

    /**
     * Setta l'id dell'insegnamento a cui appartiene
     * @param $insegnamentoId l'id dell'insegnamento a cui appartiene
     */
    function setInsegnamentoId($insegnamentoId) {
        $this->insegnamentoId = $insegnamentoId;
    }

    /**
     * Setta l'id del corso a cui l'insegnamento relativo appartiene
     * @param $insegnamentoCorsoMatricola l'id del corso a cui l'insegnamento relativo appartiene
     */
    function setInsegnamentoCorsoMatricola($insegnamentoCorsoMatricola) {
        $this->insegnamentoCorsoMatricola = $insegnamentoCorsoMatricola;
    }
}
?>