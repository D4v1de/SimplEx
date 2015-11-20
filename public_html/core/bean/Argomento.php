<?php

/**
 * User: Dario
 * Date: 22/11/15
 * Time: 09:28
 */

class Argomento {
	public $id;
	public $nome;
	public $insegnamento_id;
	public $insegnamento_corso_matricola;
	
	/**
	 * Costruttore Argomento
	 * @param $nome
	 * @param $insegnamento_id
	 * @param $insegnamento_corso_matricola
	 * @param $id
	 */
	public function __construct($nome,$insegnamento_id,$insegnamento_corso_matricola,$id){
		$this->nome = $nome;
		$this->insegnamento_id = insegnamento_id;
		$this->insegnamento_corso_matricola= insegnamento_corso_matricola;
		$this->id = $id;
	}
	
	/**
	 * Getter del nome
	 */
	public function getNome() {
		return $this->nome;
	}
	
	/**
	 * Setter del nome
	 */
	public function setNome($nome){
		$this->nome = $nome;
	}
}
?>