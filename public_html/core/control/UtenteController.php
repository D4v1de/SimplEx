<?php

/**
 * Controller dell'utente
 *
 * @author Sergio Shevchenko
 * @version 1.0
 * @since 30/11/15
 */
include_once BEAN_DIR . "Utente.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
include_once UTILS_DIR . "StringUtils.php";

die("INCLUSIONE DEL CONTROLLER UTENTE.... questo controller verrà rimosso a breve! Usa il model");

class UtenteController {

    const PERMA_COOKIE = "permaCookie";


//    /**
//     * Iscrive uno studente ad un Corso
//     * @param matricola dello Studente
//     * @param id del Corso
//     */
//    public function iscrizioneStudente($matricola_studente, $id_corso) {
//        $accountModel = new UtenteModel();
//        $accountModel->iscriviStudenteCorso($matricola_studente, $id_corso);
//    }
//
//    /**
//     * Disiscrive uno studente ad un Corso
//     * @param matricola dello Studente
//     * @param id del Corso
//     */
//    public function disiscrizioneStudente($matricola_studente, $id_corso) {
//        $accountModel = new UtenteModel();
//        $accountModel->disiscriviStudenteCorso($matricola_studente, $id_corso);
//    }


}
