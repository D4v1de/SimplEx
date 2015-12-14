<?php
/**.
 * User: Pasquale
 * Date: 30/11/15
 * Time: 07:00
 */

include_once CONTROL_DIR . "Controller.php";
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Argomento.php";
include_once BEAN_DIR . "DomandaAperta.php";
include_once BEAN_DIR . "DomandaMultipla.php";
include_once BEAN_DIR . "Alternativa.php";
include_once MODEL_DIR . "ArgomentoModel.php";
include_once MODEL_DIR . "DomandaModel.php";


class DomandaController extends Controller
{

    /*NUOVE FUNZIONI*/

    /**
     * Crea una nuova domanda aperta
     * @param DomandaAperta $domandaAperta Una domanda aperta
     */
    public function creaDomandaAperta($domandaAperta)
    {
        $domandaModel = new DomandaModel();
        return $domandaModel->createDomandaAperta($domandaAperta);
    }

    /**
     * Crea una nuova domanda mutlipla
     * @param DomandaMultipla $domandaMultipla Una domanda mutlipla
     */
    public function creaDomandaMultipla($domandaMultipla)
    {
        $domandaModel = new DomandaModel();
        return $domandaModel->createDomandaMultipla($domandaMultipla);
    }

    /**
     * Cancella una domanda aperta nel database
     * @param int $id L'id della domanda aperta da cancellare
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     */
    public function rimuoviDomandaAperta($id)
    {
        $domandaModel = new DomandaModel();
        $domandaModel->deleteDomandaAperta($id);
    }

    /**
     * Cancella una domanda multipla nel database
     * @param int $id L'id della domanda multipla da cancellare
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     */
    public function rimuoviDomandaMultipla($id)
    {
        $domandaModel = new DomandaModel();
        $domandaModel->deleteDomandaMultipla($id);
    }

    /**
     * Modifica una domanda aperta nel database
     * @param int $id L'id della domanda aperta da modificare
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     * @param DomandaAperta $updatedDomandaAperta La domanda aperta aggiornata da modificare nel database
     */
    public function modificaDomandaAperta($id,$updatedDomandaAperta)
    {
        $domandaModel = new DomandaModel();
        $domandaModel->updateDomandaAperta($id, $updatedDomandaAperta);
    }

    /**
     * Modifica una domanda multipla nel database
     * @param int $id L'id della domanda multipla da modificare
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     * @param DomandaMultipla $updatedDomandaMultipla La domanda aperta aggiornata da modificare nel database
     */
    public function modificaDomandaMultipla($id, $updatedDomandaMultipla)
    {
        $domandaModel = new DomandaModel();
        $domandaModel->updateDomandaMultipla($id, $updatedDomandaMultipla);
    }

    public function getDomandaAperta($id){
        $domandaModel = new DomandaModel();
        return $domandaModel->readDomandaAperta($id);
    }

    public function getDomandaMultipla($id){
        $domandaModel = new DomandaModel();
        return $domandaModel->readDomandaMultipla($id);
    }

    /**
     * Restituisce una lista con tutte le domande aperte
     * @param $argomentoId L'id dell'argomento delle domande da restituire
     * @param $argomentoCorsoId L'id del corso.
     * @return DomandaAperta[] La lista di domande aperte
     */
    public function getAllAperte($argomentoId)
    {
        $domandaModel = new DomandaModel();
        return $domandaModel->getAllDomandaApertaByArgomento($argomentoId);
    }

    /**
     * Restituisce una lista con tutte le domande multiple
     * @param $argomentoId L'id dell'argomento delle domande da restituire
     * @param $argomentoCorsoId L'id del corso.
     * @return DomandaMultipla[] La lista di domande multiple
     */
    public function getAllMultiple($argomentoId)
    {
        $domandaModel = new DomandaModel();
        return $domandaModel->getAllDomandaMultiplaByArgomento($argomentoId);
    }

    //restituisce le domande multiple di uno specifico test
    public function getAllDomandeMultipleByTest($id) {
        $domandaModel = new DomandaModel();
        return $domandaModel->getAllDomandeMultipleByTest($id);
    }

    //restituisce le domande aperte di uno specifico test
    public function getAllDomandeAperteByTest($id) {
        $domandaModel = new DomandaModel();
        return $domandaModel->getAllDomandeAperteByTest($id);
    }
    
    public function associaAperTest($idDomanda, $idTest, $punteggioMaxAlternativo){
        $domandaModel = new DomandaModel();
        if($punteggioMaxAlternativo == NULL){$domanda=$this->getDomandaAperta($idDomanda);
        $punteggioMaxAlternativo=(int)$domanda->getPunteggioMax();
        }
        return $domandaModel->associaDomandaApertaTest($idDomanda, $idTest, $punteggioMaxAlternativo);
    }
    
    public function associaMultTest($idDomanda, $idTest, $punteggioCorrettaAlternativo, $punteggioErrataAlternativo){
        $domandaModel = new DomandaModel();
        if($punteggioCorrettaAlternativo == NULL){$domanda=$this->getDomandaMultipla($idDomanda);
        $punteggioCorrettaAlternativo=(int)$domanda->getPunteggioCorretta();
        }
        if($punteggioErrataAlternativo == NULL){$domanda=$this->getDomandaMultipla($idDomanda);
        $punteggioErrataAlternativo=(int)$domanda->getPunteggioErrata();
        }
        return $domandaModel->associaDomandaMultiplaTest($idDomanda, $idTest, $punteggioCorrettaAlternativo, $punteggioErrataAlternativo);
    }
    
    public function readPunteggioCorrettaAlternativo($idDomandaMultipla, $idTest){
        $domandaModel = new DomandaModel();
        return $domandaModel->readPunteggioCorrettaAlternativo($idDomandaMultipla, $idTest);
    }
    
    public function readPunteggioErrataAlternativo($idDomandaMultipla, $idTest){
        $domandaModel = new DomandaModel();
        return $domandaModel->readPunteggioErrataAlternativo($idDomandaMultipla, $idTest);
    }
    
    public function readPunteggioMaxAlternativo($idDomandaAperta, $idTest){
        $domandaModel = new DomandaModel();
        return $domandaModel->readPunteggioMaxAlternativo($idDomandaAperta, $idTest);
    } 
    
    
    
}