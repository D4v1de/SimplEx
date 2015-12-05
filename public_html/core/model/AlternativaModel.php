<?php
/**
 * Created by PhpStorm.
 * User: Alina
 * Date: 29/11/2015
 * Time: 11:26
 */


include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Alternativa.php";


class AlternativaModel extends Model{



    private static $CREATE_ALTERNATIVA = "INSERT INTO `alternativa` (domanda_multipla_id, testo, percentuale_scelta, corretta) VALUES ( '%d','%s','%f','%s')";
    private static $UPDATE_ALTERNATIVA = "UPDATE `alternativa` SET testo = '%s', percentuale_scelta = '%f', corretta = '%s', domanda_multipla_id = '%d' WHERE id = '%d'";
    private static $DELETE_ALTERNATIVA = "DELETE FROM `alternativa` WHERE id = '%d'";
    private static $READ_ALTERNATIVA = "SELECT * FROM `alternativa` WHERE id = '%d'";
    private static $GET_ALL_ALTERNATIVA = "SELECT * FROM `alternativa` ORDER BY testo";
    private static $GET_ALL_ALTERNATIVA_BY_DOMANDA = "SELECT * FROM `alternativa` WHERE domanda_multipla_id = '%d' ORDER BY testo";
    private static $GET_ALTERNATIVA_CORRETTA_BY_DOMANDA = "SELECT * FROM `alternativa` WHERE domanda_multipla_id = '%d' AND corretta = 'Si'";

    /**
     * Inserisce una nuova alternativa nel database
     * @param Alternativa $alternativa L'alternativa da inserire nel database
     * @throws ApplicationException
     */
    public function createAlternativa($alternativa) {
        $query = sprintf(self::$CREATE_ALTERNATIVA, $alternativa->getDomandaMultiplaId(),$alternativa->getTesto(), $alternativa->getPercentualeScelta(), $alternativa->getCorretta());
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }else{
            return Model::getDB()->insert_id;
        }
    }

    /**
     * Modifica un'alternativa nel database
     * @param int $id L'id dell'alternativa da modificare
     * @param Alternativa $updatedAlternativa L'alternativa modificata da aggiornare nel database
     * @throws ApplicationException
     */
    public function updateAlternativa($id, $updatedAlternativa) {
        $query = sprintf(self::$UPDATE_ALTERNATIVA,  $updatedAlternativa->getTesto(), $updatedAlternativa->getPercentualeScelta(), $updatedAlternativa->getCorretta(), $updatedAlternativa->getDomandaMultiplaId(), $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cancella un'alternativa nel database
     * @param int $id L'id dell'alternativa da cancellare
     * @throws ApplicationException
     */
    public function deleteAlternativa($id) {
        $query = sprintf(self::$DELETE_ALTERNATIVA, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca una domanda aperta nel database
     * @param int $id dell'alternativa da cercare
     * @return Alternativa L'alternativa trovata
     * @throws ApplicationException
     */
    public function readAlternativa($id) {
        $query = sprintf(self::$READ_ALTERNATIVA, $id);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $alternativa = new Alternativa( $obj['domanda_multipla_id'], $obj['testo'], $obj['percentuale_scelta'], $obj['corretta']);
            $alternativa->setId($obj['id']);
            return $alternativa;
        } else {
            throw new ApplicationException(Error::$ALTERNATIVA_NON_TROVATA);
        }
    }

    /**
     * Restituisce tutte le alternative del database
     * @return Alternativa[] Tutte le alternative del database
     * @throws ApplicationException
     */
    public function getAllAlternativa() {
        $res = Model::getDB()->query(self::$GET_ALL_ALTERNATIVA);
        $alternative = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $alternativa = new Alternativa($obj['domanda_multipla_id'], $obj['testo'], $obj['percentuale_scelta'], $obj['corretta']);
                $alternativa->setId($obj['id']);
                $alternative[] = $alternativa;
            }
        }
        return $alternative;
    }

    /**
     * Restituisce tutte le alternative di una domanda multipla
     * @param int $domandaMultiplaId L'id della domanda multipla di cui si voglione conoscere le alternative
     * @return Altenativa[] Tutte le alternative di una domanda multipla
     * @throws ApplicationException
     */
    public function getAllAlternativaByDomanda($domandaMultiplaId) {
        $res = Model::getDB()->query(sprintf(self::$GET_ALL_ALTERNATIVA_BY_DOMANDA, $domandaMultiplaId));
        $alternative = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $alternativa = new Alternativa($obj['domanda_multipla_id'], $obj['testo'], $obj['percentuale_scelta'], $obj['corretta']);
                $alternativa->setId($obj['id']);
                $alternative[] = $alternativa;
            }
        }
        return $alternative;
    }

    /**
     * Restituisce l'alternativa corretta di una domanda multipla
     * @param int $domandaMultiplaId L'id della domanda multipla di cui si vuole conoscere l'alternativa corretta
     * @return Alternativa $alternativa L'alternativa corretta
     * @throws ApplicationException
     */
    public function getAlternativaCorrettaByDomanda($domandaMultiplaId) {
        $query = sprintf(self::$GET_ALTERNATIVA_CORRETTA_BY_DOMANDA, $domandaMultiplaId);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $alternativa = new Alternativa($obj['domanda_multipla_id'], $obj['testo'], $obj['percentuale_scelta'], $obj['corretta']);
            $alternativa->setId($obj['id']);
            return $alternativa;
        } else {
            throw new ApplicationException(Error::$ALTERNATIVA_NON_TROVATA);
        }
    }

}