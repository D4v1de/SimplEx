<?php

/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 29/11/2015
 * Time: 12:45
 */


class DomandaModelTest extends PHPUnit_Framework_TestCase
{


    const TESTODOM = "Domanda di prova";
    const ARGOMENTOID = 14;
    const CORSOID = 18;
    const PUNTEGGIOMAX = 10;
    const PERCENTUALESCELTA = 10;

    public function testDomandaAperta()
   {

       //da terminare

       $model = new DomandaModel();
       $idDom = $model->createDomandaAperta(new DomandaAperta(null, self::ARGOMENTOID, self::CORSOID, self::TESTODOM, self::PUNTEGGIOMAX, self::PERCENTUALESCELTA));
       $domA = $model->readDomandaAperta($idDom, self::ARGOMENTOID, self::CORSOID);
       $this->assertEquals(self::ARGOMENTOID, $domA->getArgomentoId());
       $model->deleteDomandaAperta($idDom, self::ARGOMENTOID, self::CORSOID);
       $allDom = $model->getAllDomandaAperta();
       print_r($allDom);

   }

}
