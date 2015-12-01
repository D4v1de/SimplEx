<?php
/**
 * Created by PhpStorm.
 * User: Giuseppina
 * Date: 30/11/2015
 * Time: 10:00
 */


class SessioneModelTest extends \PHPUnit_Framework_TestCase
{

    const TIPOLOGIASESS = "Esercitativa";
    const TIPOLOGIASESS2 = "Valutativa";
    const MATRICOLA = "12341234";

    public function testSessione()
    {

        $model = new SessioneModel();


        

        //creo la sessione
        $idSess = $model->createSessione(new Sessione(null, null, null, null, null, self::TIPOLOGIASESS, null));

        //leggo dal db la sessione creata
        $sessione = $model->readSessione($idSess);

        //confronto se le sessioni sono equivalenti
        $this->assertEquals($idSess, $sessione->getId());
        $this->assertEquals(self::TIPOLOGIASESS, $sessione->getTipologia());


        //eseguo una modifica sulla sessione creato
        $model->updateSessione($idSess, new Sessione($idSess, null, null, null,  self::TIPOLOGIASESS2, null));

       //leggo la sessione modificata dal db
        $sessioneModificata = $model->readSessione($idSess);

        //confronto le modifiche
        $this->assertEquals(self::TIPOLOGIASESS2,$sessioneModificata->getTipologia());

        //elimino la sessione dal db
        $model->deleteSessione($idSess);

        //leggo tutte le sessioni e verifico se la sessione è stata eliminata
        $allSess = $model->getAllSessioni();
        print_r($allSess);

        //leggo tutte le sessioni di uno studente
        $allSbS = $model->getAllSessioniByStudente(self::MATRICOLA);
        print_r($allSbS);


    }




}
