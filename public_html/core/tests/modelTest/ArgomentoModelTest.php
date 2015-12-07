<?php
/**
 * Created by PhpStorm.
 * User: Alina
 * Date: 28/11/2015
 * Time: 13:04
 */


class ArgomentoModelTest extends \PHPUnit_Framework_TestCase
{
    const IDARGOMENTO = 1;//CI DEVE ESSERE SEMPRE NEL DB UN ARGOMENTO CON QUESTO ID
    const NOMEARG = "Funzioni";
    const IDCORSO = 19;
    const NOMEARG2 = "Funzioni complesse";

    public function testArgomento()
    {

        $model = new ArgomentoModel();

        //Funziona perfettamente

        //testo la read
        $argomento = $model->readArgomento(self::IDARGOMENTO);
        print_r($argomento);

        //creo l'argomento
        $idArg = $model->createArgomento(new Argomento(self::IDCORSO, self::NOMEARG));

        //leggo dal db l'argomento creato
        $argomento = $model->readArgomento($idArg);

        //confronto se i due argomenti sono equivalenti
        $this->assertEquals($idArg, $argomento->getId());
        $this->assertEquals(self::IDCORSO, $argomento->getCorsoId());
        $this->assertEquals(self::NOMEARG, $argomento->getNome());

        //eseguo una modifica sull'argomento creato
        $model->updateArgomento($idArg, (new Argomento(self::IDCORSO, self::NOMEARG2)));

       //leggo l'argomento modificato dal db
        $argomentoModificato = $model->readArgomento($idArg);

        //confronto i due argomenti
        $this->assertEquals(self::NOMEARG2,$argomentoModificato->getNome());

        //restituisco tutti gli argomenti di un corso
        $allArgC = $model->getAllArgomentoCorso(self::IDCORSO);
        print_r($allArgC);

        //elimino l'argomento dal db
        $model->deleteArgomento($idArg);

        //leggo tutti gli argomenti e verifico se l'argomento in questione è stato eliminato
        $allAr = $model->getAllArgomento();
        print_r($allAr);
    }
}


