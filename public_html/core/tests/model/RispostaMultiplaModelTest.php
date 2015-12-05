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
    const ALT_ID = 1;
    const TEST_ID = 1;

    public function testCreateRemoveEditRispostaMultipla()
    {
        $model = new RispostaMultiplaModel();

        $risId = $model->createRispostaMultipla(new RispostaMultipla(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::PUNTEGGIO, self::ALT_ID));
        $ris = $model->readRispostaMultipla($risId);
        $this->assertEquals(self::SESSIONE_ID,$ris->getElaboratoSessioneId());
        $this->assertEquals(self::STUDENTE_MATRICOLA,$ris->getElaboratoStudenteMatricola());
        $this->assertEquals(self::PUNTEGGIO,$ris->getPunteggio());
        $this->assertEquals(self::ALT_ID,$ris->getAlternativaId());

        $model->updateRispostaMultipla(new RispostaMultipla(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::PUNTEGGIO2, self::ALT_ID),$risId);
        $ris2 = $model->readRispostaMultipla($risId,self::SESSIONE_ID,self::STUDENTE_MATRICOLA);
        $this->assertEquals(self::PUNTEGGIO2,$ris2->getPunteggio());

        $model->deleteRispostaMultipla($risId);
    }

    public function testGetRisposteByElaborato () {
        $model = new RispostaMultiplaModel();
        $all = $model->getMultipleByElaborato(new Elaborato(self::STUDENTE_MATRICOLA,self::SESSIONE_ID,"","",self::TEST_ID));
        print_r($all);
    }
}