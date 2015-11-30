<?php
/**
 * Created by PhpStorm.
 * User: fede_dr
 * Date: 24/11/15
 * Time: 17:44
 */

include_once CONTROL_DIR . "Controller.php";
include_once BEAN_DIR . "CdL.php";
include_once BEAN_DIR . "Corso.php";
include_once MODEL_DIR . "CdLModel.php";
include_once MODEL_DIR . "CorsoModel.php";
include_once MODEL_DIR . "AccountModel.php";
include_once MODEL_DIR . "SessioneModel.php";

class CdlController extends Controller {

    /**
     * Restituisco tutti i CdL
     * @return array CdL
     */
    public function getCdl() {
        $cdlModel = new CdLModel();
        return $cdlModel->getAllCdL();
    }

    /**
     * Restituisco tutti i Corsi
     * @return array Corso
     */
    public function getCorsi() {
        $corsoModel = new CorsoModel();
        return $corsoModel->getAllCorsi();
    }

    /**
     * Crea un nuovo cdl
     * @param un CdL
     */
    public function creaCdl($cdl) {
        $cdlModel = new CdLModel();
        $cdlModel->createCdL($cdl);
    }

    /**
     * Crea un nuovo corso
     * @param un Corso
     */
    public function creaCorso($corso) {
        $corsoModel = new CorsoModel();
        $corsoModel->createCorso($corso);
    }

    /**
     * Modifica un cdl
     * @param la matricola del CdL da modificare
     * @param un CdL modificato
     */
    public function modificaCdl($matricola, $cdl){
        $cdlModel = new CdLModel();
        $cdlModel->updateCdL($matricola, $cdl);
    }

    /**
     * Restituisco un cdl
     * @param matricola CdL
     * @return CdL con la matricola specificata
     */
    public function readCdl($matricola) {
        $cdlModel = new CdLModel();
        return $cdlModel->readCdL($matricola);
    }

    /**
     * Elimino un Corso
     * @param ID di un Corso
     */
    public function eliminaCdl($matricola) {
        $cdlModel = new CdLModel();
        $cdlModel->deleteCdL($matricola);
    }

    /**
     * Modifica un corso
     * @param la matricola del Corso da modificare
     * @param un Corso
     */
    public function modificaCorso($id, $corso){
        $corsoModel = new CorsoModel();
        $corsoModel->updateCorso($id, $corso);
    }

    /**
     * Restituisco un Corso
     * @param matricola del Corso
     * @return il Corso con la matricola specificata
     */
    public function readCorso($id) {
        $corsoModel = new CorsoModel();
        return $corsoModel->readCorso($id);
    }

    /**
     * Restituisco un corso
     * @param un Corso
     */
    public function visualizzaCorso($corso) {
        $corsoModel = new CorsoModel();
        $corsoModel->readCorso($corso->getMatricola());
    }

    /**
     * Elimino un Corso
     * @param ID di un Corso
     */
    public function eliminaCorso($id) {
        $corsoModel = new CorsoModel();
        $corsoModel->deleteCorso($id);
    }

    /**
     * Restituisco i corsi di un Cdl
     * @param matricola del Cdl
     * @return array di Corsi di un Cdl
     */
    public function getCorsiCdl($cdl_matricola) {
        $corsoModel = new CorsoModel();
        return $corsoModel->getAllCorsiByCdl($cdl_matricola);
    }

    /**
     * Crea l'associazione insegnamento tra Corso e Docente
     * @param id Corso da associare
     * @param matricola Docente da associare
     */
    public function creaInsegnamento($corso_id, $docente_matricola) {
        $corsoModel = new CorsoModel();
        $corsoModel->createInsegnamento($corso_id, $docente_matricola);
    }

    /**
     * Elimina l'associazione insegnamento tra Corso e Docente
     * @param id Corso da disassociare
     * @param matricola Docente da disassociare
     */
    public function eliminaInsegnamento($corso_id, $docente_matricola) {
        $corsoModel = new CorsoModel();
        $corsoModel->deleteInsegnamento($corso_id, $docente_matricola);
    }

    /**
     * Restituisce tutti i Docenti
     * @return array con tutti i Docenti SSSTTTUUUBBBB ------->
     */
    public function getDocenti() {
        $accountModel = new AccountModel();
        return $accountModel->getAllDocenti();
    }

    /**
     * Restituisce i Docenti associati a un Corso
     * @param id del Corso
     * @return array con i Docenti associati al corso specificato SSSTTTUUUBBBB ------->
     */
    public function getDocenteAssociato($corsoID) {
        $accountModel = new AccountModel();
        return $accountModel->getAllDocentiByCorso($corsoID);
    }

    /**
     * Restituisce un Utente
     * @param matricola dell'Utente da cercare
     * @return Utente con la matricola specificata SSSTTTUUUBBBB ------->
     */
    public function getUtenteByMatricola($matricola) {
        $accountModel = new AccountModel();
        return $accountModel->getUtenteByMatricola($matricola);
    }

    /**
     * Restituisce tutte le Sessioni di un Corso
     * @param matricola dell'Utente da cercare
     * @return Utente con la matricola specificata SSSTTTUUUBBBB ------->
     */
    public function getSessioni() {
        $sessioneModel = new SessioneModel();
        //return $sessioneModel->getAllSessioniByCorso();
        return $sessioneModel->getAllSessioni();
    }
}