<?php
/**
 * CdlController classe che si occupa di creare un'interfaccia tra tra i model CdL e Corso e le rispettive view
 * @author Federico De Rosa, Christian De Blasio
 * @version 1
 * @since 18/11/15 09:58
 */

include_once BEAN_DIR . "CdL.php";
include_once BEAN_DIR . "Corso.php";
include_once MODEL_DIR . "CdLModel.php";
include_once MODEL_DIR . "CorsoModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "SessioneModel.php";
include_once BEAN_DIR . "Utente.php";

class CdlController {

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
        return $corsoModel->createCorso($corso);
    }

    /**
     * Modifica un cdl
     * @param la matricola del CdL da modificare
     * @param un CdL modificato
     */
    public function modificaCdl($matricola, $cdl) {
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
    public function modificaCorso($id, $corso) {
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
     * Restituisce tutti i Corsi a cui lo Studente è iscritto
     * @param matricola dello Studente
     * @return Corsi a cui lo Studente è iscritto
     */
    public function getCorsiStudente($studente_matricola) {
        $corsoModel = new CorsoModel();
        return $corsoModel->getAllCorsiByStudente($studente_matricola);
    }
}