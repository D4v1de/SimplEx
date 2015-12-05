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
    const STUDENTE_MATRICOLA = "0512102390";
    const TESTO = "cane";
    const TESTO2 = "gatto";
    const PUNTEGGIO = 2;
    const DAID = 4;
    const TEST_ID = 1;


    public function testCreateRemoveEditRispostaAperta() {
        $model = new RispostaApertaModel();

        $risId = $model->createRispostaAperta(new RispostaAperta(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DAID, self::TESTO,self::PUNTEGGIO));
        $ris = $model->readRispostaAperta(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DAID);
        $this->assertEquals(self::TESTO,$ris->getTesto());
        $this->assertEquals(self::DAID, $ris->getDomandaApertaId());
        $this->assertEquals(self::SESSIONE_ID,$ris->getElaboratoSessioneId());
        $this->assertEquals(self::STUDENTE_MATRICOLA,$ris->getElaboratoStudenteMatricola());

        $model->updateRispostaAperta(new RispostaAperta(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DAID, self::TESTO2,self::PUNTEGGIO), self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DAID);
        $ris2 = $model->readRispostaAperta(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DAID);
        $this->assertEquals(self::TESTO2,$ris2->getTesto());

        $model->deleteRispostaAperta(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DAID);

    }

    public function testGetRisposteByElaborato () {
        $model = new RispostaApertaModel();
        $all = $model->getAperteByElaborato(new Elaborato(self::STUDENTE_MATRICOLA,self::SESSIONE_ID,"","",self::TEST_ID));
        print_r($all);
    }
}
