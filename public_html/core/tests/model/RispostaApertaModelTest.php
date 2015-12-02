<?php

/**
 * Created by PhpStorm.
 * User: Dario
 * Date: 02/12/2015
 * Time: 11:52
 */
class RispostaApertaModelTest extends PHPUnit_Framework_TestCase
{
    const SESSIONE_ID = 1;
    const STUDENTE_MATRICOLA = "0512102552";
    const TESTO = "cane";
    const TESTO2 = "gatto";
    const PUNTEGGIO = 2;
    const DAID = 1;
    const DAARGID = 9;
    const DAARGCORSOID = 20;
    const TEST_ID = 3;


    public function testCreateRemoveEditRispostaAperta() {
        $model = new RispostaApertaModel();

        $risId = $model->createRispostaAperta(new RispostaAperta(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::TESTO,self::PUNTEGGIO,self::DAID,self::DAARGID,self::DAARGCORSOID));
        $ris = $model->readRispostaAperta($risId,self::SESSIONE_ID, self::STUDENTE_MATRICOLA);
        $this->assertEquals(self::TESTO,$ris->getTesto());
        $this->assertEquals(self::DAID, $ris->getDomandaApertaId());
        $this->assertEquals(self::DAARGID, $ris->getDomandaApertaArgomentoId());
        $this->assertEquals(self::DAARGCORSOID, $ris->getDomandaApertaArgomentoCorsoId());
        $this->assertEquals(self::SESSIONE_ID,$ris->getElaboratoSessioneId());
        $this->assertEquals(self::STUDENTE_MATRICOLA,$ris->getElaboratoStudenteMatricola());

        $model->updateRispostaAperta(new RispostaAperta(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::TESTO2,self::PUNTEGGIO,self::DAID,self::DAARGID,self::DAARGCORSOID),$risId,self::SESSIONE_ID,self::STUDENTE_MATRICOLA);
        $ris2 = $model->readRispostaAperta($risId,self::SESSIONE_ID, self::STUDENTE_MATRICOLA);
        $this->assertEquals(self::TESTO2,$ris2->getTesto());

        $model->deleteRispostaAperta($risId,self::SESSIONE_ID,self::STUDENTE_MATRICOLA);

    }

    public function testGetRisposteByElaborato () {
        $model = new RispostaApertaModel();
        $all = $model->getAperteByElaborato(new Elaborato(self::STUDENTE_MATRICOLA,self::SESSIONE_ID,"","",self::TEST_ID));
        print_r($all);
    }
}
