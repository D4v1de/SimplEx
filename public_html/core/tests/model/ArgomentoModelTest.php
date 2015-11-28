<?php
/**
 * Created by PhpStorm.
 * User: Alina
 * Date: 28/11/2015
 * Time: 13:04
 */




class ArgomentoModelTest extends \PHPUnit_Framework_TestCase
{


    public function testArgomento()
    {

        $model = new ArgomentoModel();

        //deleteArgomento non funziona
         // $model->deleteArgomento(16, 18);

        $model->createArgomento(new \Argomento(null, 18, "CVS"));
        $argomento = $model->readArgomento(17, 18);
        $this->assertEquals(17, $argomento->getId());
        $allAr = $model->getAllArgomento();
        print_r($allAr);



    }

    public function testDomandaAperta()
    {
        //mysql_insert_id()
        $model = new ArgomentoModel();
       // $model->deleteDomandaAperta(11, 17, 18);
       // $model->createDomandaAperta(new \DomandaAperta(null, 17, 18, "blablabla", 10, 1));
       // $domA = $model->readDomandaAperta(12, 17, 18);
       // $this->assertEquals(12, $domA->getId());
        $allDom = $model->getAllDomandaAperta();
        print_r($allDom);

    }


}


