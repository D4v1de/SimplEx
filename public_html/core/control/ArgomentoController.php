<?php
/**.
 * User: Carlo Di Domenico
 * Date: 25/11/15
 * Time: 22:00
 */

include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Argomento.php";
include_once BEAN_DIR . "DomandaAperta.php";
include_once BEAN_DIR . "DomandaMultipla.php";
include_once BEAN_DIR . "Alternativa.php";
include_once MODEL_DIR . "ArgomentoModel.php";
include_once MODEL_DIR . "DomandaModel.php";
include_once MODEL_DIR . "AlternativaModel.php";
include_once MODEL_DIR . "CorsoModel.php";
include_once MODEL_DIR . "AccountModel.php";


class ArgomentoController {


    public function getArgomenti($corso_id) {
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->getAllArgomentoCorso($corso_id);
    }


    public function getAllDomandaMultipla($id,$corso_id){
        $domandaModel = new DomandaModel();
        return $domandaModel->getAllDomandaMultiplaByArgomento($id,$corso_id);
    }

    public function getAllDomandaAperta($id,$corso_id){
        $domandaModel = new DomandaModel();
        return $domandaModel->getAllDomandaApertaByArgomento($id,$corso_id);
    }


    /**
     * Restituisce i Docenti associati a un Corso
     * @param id del Corso
     * @return array con i Docenti associati al corso specificato
     *
     * NB. NECESSARIO CHE VENGA IMPLEMENTATA LA HOME DEL DOCENTE
     */

    public function getDocenteAssociato($corsoID) {
        $accountModel = new AccountModel();
        return $accountModel->getAllDocentiByCorso($corsoID);
    }

    public function readArgomento($id){
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->readArgomento($id); //ci andranno id_argomento e id_corso
    }

    public function creaArgomento($argomento){
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->createArgomento($argomento);
    }


    /**
     * Modifica un argomento nel database
     * @param int $id L'id dell'argomento da aggiornare
     * @param int $corsoId L'id del corso a cui appartiene l'argomento
     * @param Argomento $updatedArgomento L'argomento modificato da aggiornare nel database
     * @throws ApplicationException
     */

    public function modificaArgomento($id, $updatedArgomento){
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->updateArgomento($id, $updatedArgomento);
    }

    public function rimuoviArgomento($id, $corsoId){
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->deleteArgomento($id, $corsoId);
    }







}