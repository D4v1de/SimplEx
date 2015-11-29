<?php
/**
 * Created by PhpStorm.
 * User: Alina
 * Date: 28/11/2015
 * Time: 13:04
 */


class ArgomentoModelTest extends \PHPUnit_Framework_TestCase
{

    const NOMEARG = "Funzioni";
    const IDCORSO = 18;
    const NOMEARG2 = "Funzioni complesse";

    public function testArgomento()
    {

        $model = new ArgomentoModel();

        //Funziona perfettamente

        //creo l'argomento
        $idArg = $model->createArgomento(new \Argomento(null, self::IDCORSO, self::NOMEARG));

        //leggo dal db l'argomento creato
        $argomento = $model->readArgomento($idArg, self::IDCORSO);

        //confronto se i due argomenti sono equivalenti
        $this->assertEquals($idArg, $argomento->getId());
        $this->assertEquals(self::IDCORSO, $argomento->getCorsoId());
        $this->assertEquals(self::NOMEARG, $argomento->getNome());

        //eseguo una modifica sull'argomento creato
        $model->updateArgomento($idArg, self::IDCORSO, (new Argomento(null, self::IDCORSO, self::NOMEARG2)));

       //leggo l'argomento modificato dal db
        $argomentoModificato = $model->readArgomento($idArg, self::IDCORSO);

        //confronto i due argomenti
        $this->assertEquals(self::NOMEARG2,$argomentoModificato->getNome());

        //elimino l'argomento dal db
        $model->deleteArgomento($idArg, self::IDCORSO);

        //leggo tutti gli argomenti e verifico se l'argomento in questione è stato eliminato
        $allAr = $model->getAllArgomento();
        print_r($allAr);



    }




}


