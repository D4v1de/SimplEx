<?php
/**
 * Created by PhpStorm.
 * User: Carlo
 * Date: 19/12/2015
 * Time: 12:09
 */


class ArgomentoControllerTest extends \PHPUnit_Framework_TestCase
{
    const IDARGOMENTO = 1;//CI DEVE ESSERE SEMPRE NEL DB UN ARGOMENTO CON QUESTO ID
    const NOMEARG = "Funzioni";
    const IDCORSO = 19;
    const NOMEARG2 = "Funzioni complesse";

    public function testArgomento()
    {

        $controller = new ArgomentoController();

        //testo la read
        $argomento = $controller->readArgomento(self::IDARGOMENTO);
        print_r($argomento);

        //creo l'argomento
        $idArg = $controller->creaArgomento(new Argomento(self::IDCORSO, self::NOMEARG));

        //leggo dal db l'argomento creato
        $argomento = $controller->readArgomento($idArg);

        //confronto se i due argomenti sono equivalenti
        $this->assertEquals($idArg, $argomento->getId());
        $this->assertEquals(self::IDCORSO, $argomento->getCorsoId());
        $this->assertEquals(self::NOMEARG, $argomento->getNome());

        //eseguo una modifica sull'argomento creato
        $controller->modificaArgomento($idArg, (new Argomento(self::IDCORSO,self::NOMEARG2)));

        //leggo l'argomento modificato dal db
        $argomentoModificato = $controller->readArgomento($idArg);

        //confronto i due argomenti
        $this->assertEquals(self::NOMEARG2,$argomentoModificato->getNome());

        //restituisco tutti gli argomenti di un corso
        $allArgC = $controller->getArgomenti(self::IDCORSO);
        print_r($allArgC);

        //elimino l'argomento dal db
        $controller->rimuoviArgomento($idArg);

    }
}


