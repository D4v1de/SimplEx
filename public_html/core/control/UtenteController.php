<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 30/11/15
 * Time: 20:59
 */
include_once BEAN_DIR . "Utente.php";
include_once MODEL_DIR . "AccountModel.php";
include_once CONTROL_DIR . "Controller.php";

class UtenteController extends Controller {

    public function getUtenteByMatricola($matricola) {
        $accModel = new AccountModel();
        return $accModel->getUtenteByMatricola($matricola);
    }

    /**
     * Restituisce i Docenti associati a un Corso
     * @param id del Corso
     * @return array con i Docenti associati al corso specificato
     */
    public function getDocenteAssociato($corsoID) {
        $accountModel = new AccountModel();
        return $accountModel->getAllDocentiByCorso($corsoID);
    }

    /**
     * Restituisce tutti gli Utenti
     * @return array con tutti gli Utenti
     */
    public function getUtenti() {
        $accountModel = new AccountModel();
        return $accountModel->getAllUtenti();
    }

    /**
     * Restituisce tutti gli Studenti
     * @return array con tutti gli Studenti
     */
    public function getStudenti() { //da vedere
        $accountModel = new AccountModel();
        return $accountModel->getAllStudenti();
    }

    /**
     * Restituisce tutti i Docenti
     * @return array con tutti i Docenti
     */
    public function getDocenti() {
        $accountModel = new AccountModel();
        return $accountModel->getAllDocenti();
    }

    public function modificaUtente($matricola, $fieldName, $value) {
        //TODO verifiche in più
        if (!is_numeric($matricola)) {
            throw new ApplicationException(Error::$MATRICOLA_INESISTENTE."sss");
        }
        $aModel = new AccountModel();
        $utente = $aModel->getUtenteByMatricola($matricola);

        //!!! CRAZY CODE START
        if ($fieldName == "matricola" && preg_match(Patterns::$MATRICOLA, $value)) {
            $utente->setMatricola($value);
        } else {
            throw new ApplicationException(Error::$MATRICOLA_INESISTENTE);
        }

        if ($fieldName == "username" && preg_match(Patterns::$EMAIL, $value)) {
            $utente->setUsername($value);
        } else {
            throw new ApplicationException(Error::$EMAIL_NON_VALIDA);
        }

        if ($fieldName == "nome" && preg_match(Patterns::$NAME_GENERIC, $value)) {
            $utente->setNome($value);
        } else {
            throw new ApplicationException(Error::$NOME_NON_VALIDO);
        }
        if ($fieldName == "cognome" && preg_match(Patterns::$NAME_GENERIC, $value)) {
            $utente->setCognome($value);
        } else {
            throw new ApplicationException(Error::$CONGNOME_NON_VALIDO);
        }

        if ($fieldName == "tipologia" && is_numeric($value)) {
            $utente->setCognome($value);
        } else {
            throw new ApplicationException(Error::$TIPO_UTENTE_ERRATO);
        }

        if($fieldName=="corsi_tenuti"){
            //todo settare i corsi
        }

        $aModel->updateUtente($matricola, $utente);
    }
}
