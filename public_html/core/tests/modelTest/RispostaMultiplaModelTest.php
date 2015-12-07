<?php

/**
 * Created by PhpStorm.
 * User: Dario
 * Date: 02/12/2015
 * Time: 12:27
 */
class RispostaMultiplaModelTest extends PHPUnit_Framework_TestCase
{
    const SESSIONE_ID = 1;
    const STUDENTE_MATRICOLA = "0512102390";
    const PUNTEGGIO2 = 5;
    const PUNTEGGIO = 2;
    const DOMANDAMULTIPLAID = 12;
    const ALT_ID = 1;
    const TEST_ID = 1;

    public function testCreateRemoveEditRispostaMultipla()
    {
        $model = new RispostaMultiplaModel();

        $model->createRispostaMultipla(new RispostaMultipla(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DOMANDAMULTIPLAID, self::PUNTEGGIO, null));
        print_r($model->readRispostaMultipla(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DOMANDAMULTIPLAID));

        $ris = $model->readRispostaMultipla(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DOMANDAMULTIPLAID);
        $this->assertEquals(self::SESSIONE_ID,$ris->getElaboratoSessioneId());
        $this->assertEquals(self::STUDENTE_MATRICOLA,$ris->getElaboratoStudenteMatricola());
        $this->assertEquals(self::PUNTEGGIO,$ris->getPunteggio());

        $model->updateRispostaMultipla(new RispostaMultipla(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DOMANDAMULTIPLAID, self::PUNTEGGIO2, self::ALT_ID), self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DOMANDAMULTIPLAID);
        $ris2 = $model->readRispostaMultipla(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DOMANDAMULTIPLAID);
        $this->assertEquals(self::PUNTEGGIO2,$ris2->getPunteggio());

        $model->deleteRispostaMultipla(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DOMANDAMULTIPLAID);
    }

    public function testGetRisposteByElaborato () {
        $model = new RispostaMultiplaModel();
        $all = $model->getMultipleByElaborato(new Elaborato(self::STUDENTE_MATRICOLA,self::SESSIONE_ID,"","",self::TEST_ID));
        print_r($all);
    }
}