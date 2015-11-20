<?php

/**
 * User: Dario
 * Date: 22/11/15
 * Time: 09:28
 */

class Argomento {
	private $id;
	private $nome;
	private $insegnamento_id;
	private $insegnamento_corso_matricola;
	
	/**
	 * Costruttore di Argomento
         * @param $id
	 * @param $nome
	 * @param $insegnamento_id
	 * @param $insegnamento_corso_matricola
	 */
	public function __construct($id,$nome,$insegnamento_id,$insegnamento_corso_matricola){
		$this->id = $id;
                $this->nome = $nome;
		$this->insegnamento_id = $insegnamento_id;
		$this->insegnamento_corso_matricola= $insegnamento_corso_matricola;
	}
	
        /**
         * @return id dell'argomento
         */
        function getId() {
            return $this->id;
        }
        
	/**
	 * @return nome dell'argomento
	 */
	public function getNome() {
		return $this->nome;
	}
        
        /**
         * @return l'id dell'insegnamento a cui appartiene
         */
        function getInsegnamentoId() {
            return $this->insegnamento_id;
        }

        /**
         * @return la matricola del corso a cui l'insegnamento relativo appartiene
         */
        function getInsegnamentoCorsoMatricola() {
            return $this->insegnamento_corso_matricola;
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
         * @param $insegnamento_id l'id dell'insegnamento a cui appartiene
	 */
        function setInsegnamentoId($insegnamento_id) {
            $this->insegnamento_id = $insegnamento_id;
        }

        /**
	 * Setta l'id del corso a cui l'insegnamento relativo appartiene
         * @param $insegnamento_corso_matricola l'id del corso a cui l'insegnamento relativo appartiene
	 */
        function setInsegnamentoCorsoMatricola($insegnamento_corso_matricola) {
            $this->insegnamento_corso_matricola = $insegnamento_corso_matricola;
        }
}
?>