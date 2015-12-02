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
        $domandaModel->createDomandaAperta($domandaAperta);
    }

    /**
     * Assegna una soglia massima ad una domanda aperta
     * @param DomandaAperta $domandaAperta Una domanda aperta a cui assegnare una soglia massima
     */
    public function assegnaSogliaMassima($domandaAperta)
    {
        /*Creare funzione nel model*/
    }

    /**
     * Crea una nuova domanda mutlipla
     * @param DomandaMultipla $domandaMultipla Una domanda mutlipla
     */
    public function creaDomandaMultipla($domandaMultipla)
    {
        $domandaModel = new DomandaModel();
        $domandaModel->createDomandaMultipla($domandaMultipla);
    }


    /*INUTILE?*/
    /**
     * Assegna i punteggi di default ad una domanda multipla
     * @param DomandaMultipla $domandaMultipla Una domanda mutlipla a cui assegnare punteggi default
     */
    public function assegnaPunteggioDefaultEsatta($domandaMultipla)
    {
        /*Creare funzione*/
    }

    /**
     * Assegna i punteggi di default ad una domanda multipla
     * @param DomandaMultipla $domandaMultipla Una domanda mutlipla a cui assegnare punteggi default
     */
    public function assegnaPunteggioDefaultErrata($domandaMultipla)
    {
        /*Creare funzione*/
    }

    /**
     * Cancella una domanda aperta nel database
     * @param int $id L'id della domanda aperta da cancellare
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     */
    public function rimuoviDomandaAperta($id, $argomentoId, $argomentoCorsoId)
    {
        $domandaModel = new DomandaModel();
        $domandaModel->deleteDomandaAperta($id, $argomentoId, $argomentoCorsoId);
    }

    /**
     * Cancella una domanda multipla nel database
     * @param int $id L'id della domanda multipla da cancellare
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     */
    public function rimuoviDomandaMultipla($id, $argomentoId, $argomentoCorsoId)
    {
        $domandaModel = new DomandaModel();
        $domandaModel->deleteDomandaMultipla($id, $argomentoId, $argomentoCorsoId);
    }

    /**
     * Modifica una domanda aperta nel database
     * @param int $id L'id della domanda aperta da modificare
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     * @param DomandaAperta $updatedDomandaAperta La domanda aperta aggiornata da modificare nel database
     */
    public function modificaDomandaAperta($id, $argomentoId, $argomentoCorsoId, $updatedDomandaAperta)
    {
        $domandaModel = new DomandaModel();
        $domandaModel->updateDomandaAperta($id, $argomentoId, $argomentoCorsoId, $updatedDomandaAperta);
    }

    /**
     * Modifica una domanda multipla nel database
     * @param int $id L'id della domanda multipla da modificare
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     * @param DomandaMultipla $updatedDomandaMultipla La domanda aperta aggiornata da modificare nel database
     */
    public function modificaDomandaMultipla($id, $argomentoId, $argomentoCorsoId, $updatedDomandaMultipla)
    {
        $domandaModel = new DomandaModel();
        $domandaModel->updateDomandaMultipla($id, $argomentoId, $argomentoCorsoId, $updatedDomandaMultipla);
    }

    public function getDomandaAperta($id, $argomentoId, $argomentoCorsoId){
        $domandaModel = new DomandaModel();
        return $domandaModel->readDomandaAperta($id,$argomentoId, $argomentoCorsoId);
    }

    public function getDomandaMultipla($id, $argomentoId, $argomentoCorsoId){
        $domandaModel = new DomandaModel();
        return $domandaModel->readDomandaMultipla($id,$argomentoId, $argomentoCorsoId);
    }

    /**
     * Restituisce una lista con tutte le domande aperte
     * @param $argomentoId L'id dell'argomento delle domande da restituire
     * @param $argomentoCorsoId L'id del corso.
     * @return DomandaAperta[] La lista di domande aperte
     */
    public function getAllAperte($argomentoId, $argomentoCorsoId)
    {
        $domandaModel = new DomandaModel();
        return $domandaModel->getAllDomandaApertaByArgomento($argomentoId, $argomentoCorsoId);
    }

    /**
     * Restituisce una lista con tutte le domande multiple
     * @param $argomentoId L'id dell'argomento delle domande da restituire
     * @param $argomentoCorsoId L'id del corso.
     * @return DomandaMultipla[] La lista di domande multiple
     */
    public function getAllMultiple($argomentoId, $argomentoCorsoId)
    {
        $domandaModel = new DomandaModel();
        return $domandaModel->getAllDomandaMultiplaByArgomento($argomentoId, $argomentoCorsoId);
    }

    //restituisce le domande multiple di uno specifico test
    public function getMultTest($id) {
        $domandaModel = new DomandaModel();
        return $domandaModel->getAllDomandeMultipleByTest($id);
    }

    //restituisce le domande aperte di uno specifico test
    public function getAperteTest($id) {
        $domandaModel = new DomandaModel();
        return $domandaModel->getAllDomandeAperteByTest($id);
    }
}