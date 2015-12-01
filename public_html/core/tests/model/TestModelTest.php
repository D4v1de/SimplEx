<?php

/**
 * Created by PhpStorm.
 * User: Giuseppina
 * Date: 30/11/2015
 * Time: 12:00
 */


class TestModelTest extends PHPUnit_Framework_TestCase
{


    const NMULTIPLETEST = 8;
    const NMULTIPLETEST2 = 7;

    public function testTest()
    {

        $model = new TestModel();


        //Funziona perfettamente

        //creo test
        $idTest = $model->createTest(new Test(null, null, null, self::NMULTIPLETEST, null, null, null));

        //leggo dal db test creato
        $test = $model->readTest($idTest);

        //confronto se i test sono equivalenti
        $this->assertEquals($idTest, $test->getId());
        $this->assertEquals(self::NMULTIPLETEST, $test->getNumeroMultiple());


        //eseguo una modifica sul test creato
        $model->updatetest($idTest, new Sessione($idTest, null, null, null,  self::NMULTIPLETEST2, null));

        //leggo il test modificato dal db
        $testModificato = $model->readTest($idTest);

        //confronto le modifiche
        $this->assertEquals(self::TIPOLOGIASESS2,$testModificato->getNumeroMultiple());

        //elimino il test dal db
        $model->deleteTest($idTest);

        //leggo tutti i test
        $allTests = $model->getAllTest();
        print_r($allTests);

        //leggo tutti i test del corso
        $allTestsCorso = $model->getAllTestByCorso();
        print_r($allTestsCorso);

        //leggo tutti i test della sessione
        $allTestsSessione = $model->getAllTestBySessione();
        print_r($allTestsSessione);

        //leggo tutte le domande aperte  del test
        $allDomandeAperte = $model->getAllDomandeAperteByTest();
        print_r($allDomandeAperte);

        //leggo tutte le domande multiple del test
        $allDomandeMultiple = $model->getAllDomandeMultipleByTest();
        print_r($allDomandeMultiple);
    }




}
