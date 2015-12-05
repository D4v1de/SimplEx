<?php

/**
 * User: Alina
 * Date: 27/11/15
 * Time: 14:47
 */
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Argomento.php";



class ArgomentoModel extends Model {
    private static $CREATE_ARGOMENTO = "INSERT INTO `argomento` (corso_id, nome) VALUES ('%d','%s')";
    private static $UPDATE_ARGOMENTO = "UPDATE `argomento` SET nome = '%s', corso_id = '%d' WHERE id = '%d'";
    private static $DELETE_ARGOMENTO = "UPDATE `argomento` SET stato='Obsoleto' WHERE id = '%d'";
    private static $READ_ARGOMENTO = "SELECT * FROM `argomento` WHERE id = '%d' AND stato = 'In uso'";
    private static $GET_ALL_ARGOMENTO = "SELECT * FROM `argomento` AND stato = 'In uso' ORDER BY nome";
    private static $GET_ALL_ARGOMENTI_BY_CORSO = "SELECT * FROM `argomento` WHERE corso_id = '%d' AND stato = 'In uso' ORDER BY nome";
    private static $DELETE_DOMANDA_APERTA_ARGOMENTO = "UPDATE `domanda_aperta` SET stato = 'Obsoleto' WHERE argomento_id = '%d'";
    private static $DELETE_DOMANDA_MULTIPLA_ARGOMENTO = "UPDATE `domanda_multipla` SET stato = 'Obsoleto' WHERE argomento_id = '%d'";
    
    /**
     *Inserisce un nuovo argomento nel database
     * @param Argomento L'argomento da inserire nel database
     * @throws ApplicationException
     */
    public function createArgomento($argomento) {
        $query = sprintf(self::$CREATE_ARGOMENTO, $argomento->getCorsoId(), $argomento->getNome());
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }else{
            $id = Model::getDB()->insert_id;
            return $id;


        }
    }

    /**
     * Modifica un argomento nel database
     * @param int $id L'id dell'argomento da aggiornare
     * @param Argomento $updatedArgomento L'argomento modificato da aggiornare nel database
     * @throws ApplicationException
     */
    public function updateArgomento($id, $updatedArgomento) {
        $query = sprintf(self::$UPDATE_ARGOMENTO, $updatedArgomento->getNome(), $updatedArgomento->getCorsoId(), $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cancella un argomento nel database e tutte le domande ad esso relative
     * @param int $id L'id dell'argomento da cancellare
     * @throws ApplicationException
     */
    public function deleteArgomento($id) {
        $query = sprintf(self::$DELETE_ARGOMENTO, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
        $query = sprintf(self::$DELETE_DOMANDA_APERTA_ARGOMENTO, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
        $query = sprintf(self:: $DELETE_DOMANDA_MULTIPLA_ARGOMENTO, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca un argomento nel database
     * @param int $id L'id dell'argomento da cercare
     * @return Argomento L'argomento da cercare
     * @throws ApplicationException
     */
    public function readArgomento($id) {
        $query = sprintf(self::$READ_ARGOMENTO, $id);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $argomento = new Argomento( $obj['corso_id'], $obj['nome']);
            $argomento->setId($obj['id']);
            return $argomento;
        } else {
            throw new ApplicationException(Error::$ARGOMENTO_NON_TROVATO);
        }
    }

    /**
     * Restituisce tutti gli Argomenti del database
     * @return Argomento[] Tutti gli argomenti del database
     * @throws ApplicationException
     */
    public function getAllArgomento() {
        $res = Model::getDB()->query(self::$GET_ALL_ARGOMENTO);
        $argomenti = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $argomento = new Argomento( $obj['corso_id'], $obj['nome']);
                $argomento->setId($obj['id']);
                $argomenti[] = $argomento;
            }
        }
        return $argomenti;
    }

    /**
     * Restituisce tutti gli Argomenti di un corso del database
     * @param int $corso_id L'id del corso per il quale si vogliono conoscere tutti gli argomenti
     * @return Argomento[] Tutti gli argomenti di un corso del database
     * @throws ApplicationException
     */
    public function getAllArgomentoCorso($corso_id) {
        $query = sprintf(self::$GET_ALL_ARGOMENTI_BY_CORSO, $corso_id);
        $res = Model::getDB()->query($query);
        $argomenti = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $argomento = new Argomento( $obj['corso_id'], $obj['nome']);
                $argomento->setId($obj['id']);
                $argomenti[] = $argomento;            }
        }
        return $argomenti;
    }

}