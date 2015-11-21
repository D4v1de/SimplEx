<?php

/**
 * User: Dario
 * Date: 21/11/15
 * Time: 09:55
 */

include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Utente.php";

class UtenteModel extends Model {
    /**
     * Controlla se l'utente è un docente o uno studente
     * @param type Utente
     * @return string
     */
    private function checkTipologia($utente){
        if($utente->tipologia == "studente"){
        return "studente";}
        else {return "docente";}
    }
    
    /**
     * Inserisce un nuovo utente nel database
     * @param type Utente
     */
    public function createUtente($utente) {
        $query = "INSERT INTO ".checkTipologia($utente)."(matricola, nome, cognome) VALUES('".$utente->matricola."', '".$utente->nome."', '".$utente->cognome."');";
        $res = Model::getDB()->query($query);
    }   
    /**
     * Cerca nel database un utente in base alla matricola e lo restituisce
     * @param type string
     * @return type Utente
     */
    public function readUtente($matricola) {
        $query = "SELECT * FROM studente WHERE matricola='".$matricola."' LIMIT 1;";
        $res = Model::getDB()->query($query);
        if($res->num_rows == 0) {
            $query = "SELECT * FROM docente WHERE matricola='".$matricola."' LIMIT 1;";
            $res = Model::getDB()->query($query);
        }
        $utente = new Utente($res->fetch_assoc()['matricola'],$res->fetch_assoc()['nome'],$res->fetch_assoc()['cognome'],$res->fetch_assoc()['tipologia']);
        return $utente;
    }
    /**
     * Aggiorna i valori di un utente nel database con nuovi valori
     * @param type $utente I vecchi valori dell'utente
     * @param type $updatedUtente I nuovi valori dell'utente da inserire nel database
     */
    public function updateUtente($utente,$updatedUtente) {
        $query = "UPDATE ".checkTipologia($utente)." SET nome='".$updatedUtente->nome."', cognome='".$updatedUtente->cognome."', matricola='".$updatedUtente->matricola."' WHERE matricola='".$utente->matricola."';";
        $res = Model::getDB()->query($query);
    }
    /**
     * Elimina dal database un utente
     * @param type Utente
     */
    public function deleteUtente($utente) {
        $query = "DELETE FROM ".checkTipologia($utente)." WHERE matricola=".$utente->matricola.";";
        $res = Model::getDB()->query($query);
    }
}
?>
