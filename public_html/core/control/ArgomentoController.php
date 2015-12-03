<?php
/**.
 * User: Alina
 * Date: 25/11/15
 * Time: 22:00
 */

include_once CONTROL_DIR . "Controller.php";
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


class ArgomentoController extends Controller {


    public function getArgomenti($corso_id) {
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->getAllArgomentoCorso($corso_id);
    }


    public function getNumArgomenti(){
        //  $argomentoModel = new ArgomentoModel();
        return 17; //$argomentoModel->getNumArgomenti();
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
     * Restituisco un Corso
     * @param matricola del Corso
     * @return il Corso con la matricola specificata
     */
    public function readCorso($id) {
        $corsoModel = new CorsoModel();
        return $corsoModel->readCorso($id);//qui ci sarà $id (riferito all'id del corso)
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

    public function readArgomento($id,$corso_id){
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->readArgomento($id,$corso_id); //ci andranno id_argomento e id_corso
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

    public function modificaArgomento($id, $corsoId, $updatedArgomento){
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->updateArgomento($id, $corsoId, $updatedArgomento);
    }

    public function rimuoviArgomento($id, $corsoId){
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->deleteArgomento($id, $corsoId);
    }







}