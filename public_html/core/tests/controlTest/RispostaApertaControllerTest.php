<?php

/**
 * La classe effettua il test di tutti i metodi della classe RispostaApertaModel.php
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 21/12/2015
 */
class RispostaApertaControllerTest extends PHPUnit_Framework_TestCase
{
    const SESSIONE_ID = 1;
    const STUDENTE_MATRICOLA = "0512102390";
    const TESTO = "cane";
    const TESTO2 = "gatto";
    const PUNTEGGIO = 2;
    const DAID = 4;
    const TEST_ID = 1;


    public function testCreateRemoveEditRispostaAperta() {
        $controller = new RispostaApertaController();

        $risId = $controller->createRispostaAperta(new RispostaAperta(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DAID, self::TESTO,self::PUNTEGGIO));
        $ris = $controller->readRispostaAperta(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DAID);
        $this->assertEquals(self::TESTO,$ris->getTesto());
        $this->assertEquals(self::DAID, $ris->getDomandaApertaId());
        $this->assertEquals(self::SESSIONE_ID,$ris->getElaboratoSessioneId());
        $this->assertEquals(self::STUDENTE_MATRICOLA,$ris->getElaboratoStudenteMatricola());

        $controller->updateRispostaAperta(new RispostaAperta(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DAID, self::TESTO2,self::PUNTEGGIO), self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DAID);
        $ris2 = $controller->readRispostaAperta(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DAID);
        $this->assertEquals(self::TESTO2,$ris2->getTesto());

        $controller->deleteRispostaAperta(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DAID);

    }

    public function testGetRisposteByElaborato () {
        $controller = new RispostaApertaModel();
        $all = $controller->getAperteByElaborato(new Elaborato(self::STUDENTE_MATRICOLA,self::SESSIONE_ID,"","",self::TEST_ID,""));
        print_r($all);
    }
}
