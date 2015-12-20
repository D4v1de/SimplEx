<?php

/**
 * Si occupa di far interagire il model SessioneModel
 * con le views che richiedo le operazioni ad esso relative.
 *
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since 18/11/15 09:58
 */

include_once MODEL_DIR . "Model.php";
include_once MODEL_DIR . "SessioneModel.php";
include_once BEAN_DIR . "Sessione.php";
include_once CONTROL_DIR . "TestController.php";
include_once CONTROL_DIR . "UtenteController.php";

class SessioneController {


    private $sessioneModel;
    private $utenteController;
    private $testController;

    public function __construct() {
        $this->sessioneModel = new SessioneModel();
        $this->testController = new TestController();
        $this->utenteController = new UtenteController();

    }

    /**
     * Crea una nuova sessione
     * @param type $sessione ovvero Una Sessione
     */
    public function creaSessione($sessione) {
        return $this->sessioneModel->createSessione($sessione);
    }

    /**
     *
     * @param type $id E' l'id della sessione che è stata appena modificata
     * @param type $updatedSessione E' la nuova sessione appena creata
     */
    public function updateSessione($id, $updatedSessione) {
        $this->sessioneModel->updateSessione($id, $updatedSessione);
    }


    /**
     * Restiuisce i dati relativi ad una sessione
     * @param type $idSessione
     * @return type
     */
    public function readSessione($idSessione) {
        return $this->sessioneModel->readSessione($idSessione);
    }

    /**
     * Rimuove una sessione
     * @param type $idSessione
     */
    public function deleteSessione($idSessione) {
        $this->sessioneModel->deleteSessione($idSessione);
    }

    public function getAllSessioni() {
        return $this->sessioneModel->getAllSessioni();
    }

    public function getAllSessioniByCorso($idCorso) {
        return $this->sessioneModel->getAllSessioniByCorso($idCorso);
    }

    public function getAllSessioniByStudente($matricola) {
        return $this->sessioneModel->getAllSessioniByStudente($matricola);
    }

    public function associaTestASessione($idSes, $idTest) {
        $this->sessioneModel->associaTestSessione($idSes,$idTest);
    }

    public function deleteAllTestFromSessione($idSes) {
        $this->sessioneModel->deleteAllTestFromSessione($idSes);
    }

    public function disabilitaMostraRisposteCorrette($id) {
        $this->sessioneModel->disabilitaMostraRisposteCorrette($id);
    }

    public function abilitaMostraRisposteCorrette($id) {
        $this->sessioneModel->abilitaMostraRisposteCorrette($id);
    }

    public function disabilitaMostraEsito($id) {
        $this->sessioneModel->disabilitaMostraEsito($id);
    }

    public function abilitaMostraEsito($id) {
        $this->sessioneModel->abilitaMostraEsito($id);
    }

     /**Ritorna Si o No in caso si decida se Mostrare o meno le Rsisposte Corrette
     * @param $id
     * @return string La relativa Sessione
     * @throws ApplicationException
     */
    public function readMostraRisposteCorretteSessione($id) {
        return $this->sessioneModel->readMostraRisposteCorretteSessione($id);
    }

    /**Ritorna Si o No in caso si decida se Mostrare o meno gli Esiti
     * @param $id La relativa Sessione
     * @return string
     * @throws ApplicationException
     */
    public function readMostraEsitoSessione($id) {
       return  $this->sessioneModel->readMostraEsitoSessione($id);
    }

    /**Ritorna tutti gli studenti che stanno svolgendo una sessione d'esame
     * @param $idSes La relativa Sessione
     * @return Utente[]
     */
        public function getEsaminandiSessione($idSes) {
        return $this->utenteController->getEsaminandiSessione($idSes);
    }

    /**
     * Ritorna tutti gli studenti associati al id relativo alla sessione
     * @param type $idSessione
     * @return type array di Studenti
     */
    public function getAllStudentiBySessione($idSessione) {
        return  $this->utenteController->getAllStudentiSessione($idSessione);
    }

    public function abilitaStudenteASessione($idSessione, $studenteMatricola) {
        $this->utenteController->abilitaStudenteSessione($idSessione,$studenteMatricola);
    }

    public function disabilitaStudenteDaSessione($idSessione, $studenteMatricola) {
        $this->utenteController->disabilitaStudenteDaSessione($idSessione,$studenteMatricola);
    }

    public function getAllStudentiByCorso($idCorso) {
        return $this->utenteController->getAllStudentiByCorso($idCorso);
    }

    /**
     * Ritorna tutti i testi associati al id relativo alla sessione
     * @param type $idSessione
     * @return type array di Test
     */
    public function getAllTestBySessione($idSessione) {
        return $this->testController->getAllTestBySessione($idSessione);
    }

    public function getAllTestByCorso($idCorso) {
        return $this->testController->getAllTestbyCorso($idCorso);
    }


}