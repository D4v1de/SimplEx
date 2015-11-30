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
    private static $UPDATE_ARGOMENTO = "UPDATE `argomento` SET nome = '%s' WHERE id = '%d' AND corso_id = '%d'";
    private static $DELETE_ARGOMENTO = "DELETE FROM `argomento` WHERE id = '%d' AND corso_id = '%d'";
    private static $READ_ARGOMENTO = "SELECT * FROM `argomento` WHERE id = '%d' AND corso_id = '%d'";
    private static $GET_ALL_ARGOMENTO = "SELECT * FROM `argomento`";
    private static $GET_ALL_ARGOMENTI_BY_CORSO = "SELECT * FROM `argomento` WHERE corso_id = '%d'";
    
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
            return Model::getDB()->insert_id;
        }
    }

    /**
     * Modifica un argomento nel database
     * @param int $id L'id dell'argomento da aggiornare
     * @param int $corsoId L'id del corso a cui appartiene l'argomento
     * @param Argomento $updatedArgomento L'argomento modificato da aggiornare nel database
     * @throws ApplicationException
     */
    public function updateArgomento($id, $corsoId, $updatedArgomento) {
        $query = sprintf(self::$UPDATE_ARGOMENTO, $updatedArgomento->getNome(), $id, $corsoId);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cancella un argomento nel database
     * @param int $id L'id dell'argomento da cancellare
     * @param int $corsoId L'id del corso a cui appartiene l'argomento
     * @throws ApplicationException
     */
    public function deleteArgomento($id, $corsoId) {
        $query = sprintf(self::$DELETE_ARGOMENTO, $id, $corsoId);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca un argomento nel database
     * @param int $id L'id dell'argomento da cercare
     * @param int $corsoId L'id del corso a cui appartiene l'argomento
     * @return Argomento L'argomento da cercare
     * @throws ApplicationException
     */
    public function readArgomento($id, $corsoId) {
        $query = sprintf(self::$READ_ARGOMENTO, $id, $corsoId);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $argomento = new Argomento($obj['id'], $obj['corso_id'], $obj['nome']);
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
        $argomento = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $argomento[] = new Argomento($obj['id'], $obj['corso_id'], $obj['nome']);
            }
        }
        return $argomento;
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
        $argomento = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $argomento[] = new Argomento($obj['id'], $obj['corso_id'], $obj['nome']);
            }
        }
        return $argomento;
    }

}