<?php

/**
 * La classe effettua il test di tutti i metodi della classe ArgomentoModel.php
 * @author Alina Korniychuk
 * @version 1.0
 * @since 28/11/15
 */


class ArgomentoModelTest extends \PHPUnit_Framework_TestCase
{
    const IDARGOMENTO = 1;//CI DEVE ESSERE SEMPRE NEL DB UN ARGOMENTO CON QUESTO ID
    const NOMEARG = "Funzioni4";
    const IDCORSO = 18;
    const NOMEARG2 = "Funzioni complesse4";

    public function testArgomento()
    {

        $model = new ArgomentoModel();

        //Funziona perfettamente

        $model->deleteArgomento(143);
        $model->deleteArgomento(144);
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
        print("Stampo tutti gli argomenti");
        print_r($allAr);
    }
}


