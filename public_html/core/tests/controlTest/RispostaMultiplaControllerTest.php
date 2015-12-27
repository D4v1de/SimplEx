<?php

/**
 * La classe effettua il test di tutti i metodi della classe RispostaMultiplaModel.php
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 21/12/2015
 */
class RispostaMultiplaControllerTest extends PHPUnit_Framework_TestCase
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
        $controller = new RispostaMultiplaController();

        //creo una risposta
        $controller->createRispostaMultipla(new RispostaMultipla(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DOMANDAMULTIPLAID, self::PUNTEGGIO, null));
        //leggo una risposta
        $ris = $controller->readRispostaMultipla(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DOMANDAMULTIPLAID);
        $this->assertEquals(self::SESSIONE_ID,$ris->getElaboratoSessioneId());
        $this->assertEquals(self::STUDENTE_MATRICOLA,$ris->getElaboratoStudenteMatricola());
        $this->assertEquals(self::PUNTEGGIO,$ris->getPunteggio());
        //aggiorno una risposta
        $controller->updateRispostaMultipla(new RispostaMultipla(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DOMANDAMULTIPLAID, self::PUNTEGGIO2, self::ALT_ID), self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DOMANDAMULTIPLAID);
        $ris2 = $controller->readRispostaMultipla(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DOMANDAMULTIPLAID);
        $this->assertEquals(self::PUNTEGGIO2,$ris2->getPunteggio());
        //rimuovo una risposta
        $controller->deleteRispostaMultipla(self::SESSIONE_ID, self::STUDENTE_MATRICOLA, self::DOMANDAMULTIPLAID);
    }

    //testo la funzionalità di recupero risposte dato un elaborato
    public function testGetRisposteByElaborato () {
        $controller = new RispostaMultiplaModel();
        $all = $controller->getMultipleByElaborato(new Elaborato(self::STUDENTE_MATRICOLA,self::SESSIONE_ID,"","",self::TEST_ID,""));
        print_r($all);
    }

    //testo la funzionalità di recupero risposte data una domanda
    public function testGetRisposteByDomanda () {
        $controller = new RispostaMultiplaModel();
        $all = $controller->getAllRisposteMultipleByDomanda(self::DOMANDAMULTIPLAID);
        print_r($all);
    }
}