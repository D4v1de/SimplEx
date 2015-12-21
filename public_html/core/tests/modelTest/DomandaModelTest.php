<?php

/**
 * La classe effettua il test di tutti i metodi della classe DomandaModel.php
 * @author Alina Korniychuk
 * @version 1.0
 * @since 23/11/15
 */


class DomandaModelTest extends PHPUnit_Framework_TestCase
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


    public function testDomandaAperta()
    {

       $model = new DomandaModel();
       //crea una domanda aperta
       $idDom = $model->createDomandaAperta(new DomandaAperta(self::ARGOMENTOID, self::TESTODOM, self::PUNTEGGIOMAX, self::PERCENTUALESCELTA));

       //legge la domanda aperta creata dal db
       $domA = $model->readDomandaAperta($idDom);

       //confronta le due domande
       $this->assertEquals(self::ARGOMENTOID, $domA->getArgomentoId());
        $this->assertEquals(self::TESTODOM, $domA->getTesto());
       $this->assertEquals(self::PUNTEGGIOMAX, $domA->getPunteggioMax());
       $this->assertEquals(self::PERCENTUALESCELTA, $domA->getPercentualeScelta());

       //modifico la domanda aperta in questione
       $model->updateDomandaAperta($idDom,(new DomandaAperta(self::ARGOMENTOID,self::TESTODOM,self::PUNTEGGIOMAX2, self::PERCENTUALESCELTA2 )));

       //leggo la domanda aperta modificata dal db
       $domAM = $model->readDomandaAperta($idDom);

       //verifico la modifica
       $this->assertEquals(self::ARGOMENTOID, $domAM->getArgomentoId());
        $this->assertEquals(self::TESTODOM, $domAM->getTesto());
       $this->assertEquals(self::PUNTEGGIOMAX2, $domAM->getPunteggioMax());
       $this->assertEquals(self::PERCENTUALESCELTA2, $domAM->getPercentualeScelta());

        //cancello la domanda aperta
       $model->deleteDomandaAperta($idDom);

       //verifico la cancellazione
       $allDom = $model->getAllDomandaAperta();
       print_r($allDom);

        //leggo tutte le domande aperte dell argomento che ha l'ID 9
        $allDomByArg = $model->getAllDomandaApertaByArgomento(9);
        print_r($allDomByArg);

   }

    public function testDomandaMultipla(){

        $model = new DomandaModel();
        //crea una domanda multipla
        $idDom = $model->createDomandaMultipla(new DomandaMultipla(self::ARGOMENTOID, self::TESTODOM, self::PUNTEGGIOCORRETTA, self::PUNTEGGIOERRATA, self::PERCENTUALESCELTA, self::PERCRISPCORRETTA));

        //legge la domanda multipla creata
        $domA = $model->readDomandaMultipla($idDom);

        //confronta le due domande
        $this->assertEquals(self::ARGOMENTOID, $domA->getArgomentoId());
        $this->assertEquals(self::TESTODOM, $domA->getTesto());
        $this->assertEquals(self::PUNTEGGIOCORRETTA, $domA->getPunteggioCorretta());
        $this->assertEquals(self::PUNTEGGIOERRATA, $domA->getPunteggioErrata());
        $this->assertEquals(self::PERCENTUALESCELTA, $domA->getPercentualeScelta());
        $this->assertEquals(self::PERCRISPCORRETTA, $domA->getPercentualeRispostaCorretta());

        //modifico la domanda aperta in questione
        $model->updateDomandaMultipla($idDom, (new DomandaMultipla(self::ARGOMENTOID, self::TESTODOM, self::PUNTEGGIOCORRETTA2, self::PUNTEGGIOERRATA2, self::PERCENTUALESCELTA, self::PERCRISPCORRETTA)));

        //leggo la domanda multipla modificata
        $domA = $model->readDomandaMultipla($idDom);

        //verifico la modifica
        $this->assertEquals(self::ARGOMENTOID, $domA->getArgomentoId());
        $this->assertEquals(self::TESTODOM, $domA->getTesto());
        $this->assertEquals(self::PUNTEGGIOCORRETTA2, $domA->getPunteggioCorretta());
        $this->assertEquals(self::PUNTEGGIOERRATA2, $domA->getPunteggioErrata());
        $this->assertEquals(self::PERCENTUALESCELTA, $domA->getPercentualeScelta());
        $this->assertEquals(self::PERCRISPCORRETTA, $domA->getPercentualeRispostaCorretta());

        //cancello la domanda multipla
        $model->deleteDomandaMultipla($idDom);

        //verifico la cancellazione
        $allDom = $model->getAllDomandaMultipla();
        print_r($allDom);

        //leggo le domande multiple dell argomento con l'ID 7
        $allDomMByArg = $model->getAllDomandaMultiplaByArgomento(7);
        print_r($allDomMByArg);
    }
}
