<?php

/**
 * La classe effettua il test di tutti i metodi della classe DomandaController.php
 * @author Pasqule
 * @version 1.0
 * @since 21/12/15
 * Time: 12.55
 */
class DomandaControllerTest extends PHPUnit_Framework_TestCase
{

    const TESTODOM = "Domanda di prova";
    const ARGOMENTOID = 1;
    const PUNTEGGIOMAX = 10;
    const PERCENTUALESCELTA = 10;
    const PUNTEGGIOMAX2 = 15;
    const PERCENTUALESCELTA2 = 20;
    const PUNTEGGIOCORRETTA = 5;
    const PUNTEGGIOERRATA = -1;
    const PERCRISPCORRETTA = 10;
    const PUNTEGGIOCORRETTA2 = 7;
    const PUNTEGGIOERRATA2 = 0;

    public function testDomandaAperta(){

        $controller = new DomandaController();

        /*Creo una domanda aperta*/
        $idDom = $controller->creaDomandaAperta(new DomandaAperta(self::ARGOMENTOID, self::TESTODOM, self::PUNTEGGIOMAX, self::PERCENTUALESCELTA));

        /*Leggo la domanda aperta appena creata dal DB*/
        $domA = $controller->getDomandaAperta($idDom);

        /*Confronto le domande*/
        $this->assertEquals(self::ARGOMENTOID, $domA->getArgomentoId());
        $this->assertEquals(self::TESTODOM, $domA->getTesto());
        $this->assertEquals(self::PUNTEGGIOMAX, $domA->getPunteggioMax());
        $this->assertEquals(self::PERCENTUALESCELTA, $domA->getPercentualeScelta());

        /*Modifico la domanda cercata*/
        $controller->modificaDomandaAperta($idDom,(new DomandaAperta(self::ARGOMENTOID,self::TESTODOM,self::PUNTEGGIOMAX2, self::PERCENTUALESCELTA2 )));

        /*Leggo la domanda aperta modificata dal db */
        $domAM = $controller->getDomandaAperta($idDom);

        /*Confronto la modifica*/
        $this->assertEquals(self::ARGOMENTOID, $domAM->getArgomentoId());
        $this->assertEquals(self::TESTODOM, $domAM->getTesto());
        $this->assertEquals(self::PUNTEGGIOMAX2, $domAM->getPunteggioMax());
        $this->assertEquals(self::PERCENTUALESCELTA2, $domAM->getPercentualeScelta());

        /*Cancello la domanda aperta*/
        $controller->rimuoviDomandaAperta($idDom);

        //Verifico l'eliminazione della domanda stamapando tutte le domande presenti nell'argomento
        $allDomByArg = $controller->getAllAperte(self::ARGOMENTOID);
        print_r($allDomByArg);

    }

    public function testDomandaMultipla(){

        $controller = new DomandaController();

        /*Creo una domanda multipla*/
        $idDom = $controller->creaDomandaMultipla(new DomandaMultipla(self::ARGOMENTOID, self::TESTODOM, self::PUNTEGGIOCORRETTA, self::PUNTEGGIOERRATA, self::PERCENTUALESCELTA, self::PERCRISPCORRETTA));

        /*Leggo la domanda multipla appena creata dal DB*/
        $domA = $controller->getDomandaMultipla($idDom);

        /*Confronto le domande*/
        $this->assertEquals(self::ARGOMENTOID, $domA->getArgomentoId());
        $this->assertEquals(self::TESTODOM, $domA->getTesto());
        $this->assertEquals(self::PUNTEGGIOCORRETTA, $domA->getPunteggioCorretta());
        $this->assertEquals(self::PUNTEGGIOERRATA, $domA->getPunteggioErrata());
        $this->assertEquals(self::PERCENTUALESCELTA, $domA->getPercentualeScelta());
        $this->assertEquals(self::PERCRISPCORRETTA, $domA->getPercentualeRispostaCorretta());

        /*Modifico la domanda cercata*/
        $controller->modificaDomandaMultipla($idDom, (new DomandaMultipla(self::ARGOMENTOID, self::TESTODOM, self::PUNTEGGIOCORRETTA2, self::PUNTEGGIOERRATA2, self::PERCENTUALESCELTA, self::PERCRISPCORRETTA)));

        /*Leggo la domanda aperta modificata dal db */
        $domA = $controller->getDomandaMultipla($idDom);

        /*Confronto la modifica*/
        $this->assertEquals(self::ARGOMENTOID, $domA->getArgomentoId());
        $this->assertEquals(self::TESTODOM, $domA->getTesto());
        $this->assertEquals(self::PUNTEGGIOCORRETTA2, $domA->getPunteggioCorretta());
        $this->assertEquals(self::PUNTEGGIOERRATA2, $domA->getPunteggioErrata());
        $this->assertEquals(self::PERCENTUALESCELTA, $domA->getPercentualeScelta());
        $this->assertEquals(self::PERCRISPCORRETTA, $domA->getPercentualeRispostaCorretta());

        /*Cancello la domanda multipla*/
        $controller->rimuoviDomandaMultipla($idDom);

        //Verifico l'eliminazione della domanda stamapando tutte le domande presenti nell'argomento
        $allDomByArg = $controller->getAllMultiple(self::ARGOMENTOID);
        print_r($allDomByArg);

    }

}
