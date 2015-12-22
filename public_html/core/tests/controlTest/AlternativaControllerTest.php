<?php
/**
 * Created by PhpStorm.
 * User: Alina
 * Date: 29/11/2015
 * Time: 20:30
 */




class AlternativaControllerTest extends \PHPUnit_Framework_TestCase
{

    const IDALTERNATIVA = 2;//CI DEVE STARE NEL DB ALTERNATIVA CON QUESTO ID
    const IDDOMMULTIPLA =  5;
    const TESTO = "Risposta di prova";
    const PERCSCELTA = 10;
    const CORRETTA = 'No';
    const TESTO2 = "Risposta di prova2";
    const PERCSCELTA2 = 14;


    public function testAlternativa()
    {

        $controller = new AlternativaController();



        //crea un'alterntaiva
        $idAlt = $controller->creaAlternativa(new Alternativa(self::IDDOMMULTIPLA,self::TESTO,self::PERCSCELTA, self::CORRETTA));

        //legge l'arternativa creata
        $altern = $controller->readAlternativa($idAlt);

        //confronta le due alternative
        $this->assertEquals(self::IDDOMMULTIPLA, $altern->getDomandaMultiplaId());
        $this->assertEquals(self::TESTO, $altern->getTesto());
        $this->assertEquals(self::PERCSCELTA, $altern->getPercentualeScelta());
        $this->assertEquals(self::CORRETTA, $altern->getCorretta());

        //modifico l'alternativa in questione
        $controller->modificaAlternativa($idAlt, (new Alternativa(self::IDDOMMULTIPLA, self::TESTO2, self::PERCSCELTA2, self::CORRETTA)));

        //leggo l'alternativa modificata
        $altMod = $controller->readAlternativa($idAlt);

        //verifico la modifica
        $this->assertEquals(self::IDDOMMULTIPLA, $altMod->getDomandaMultiplaId());
        $this->assertEquals(self::TESTO2, $altMod->getTesto());
        $this->assertEquals(self::PERCSCELTA2, $altMod->getPercentualeScelta());
        $this->assertEquals(self::CORRETTA, $altMod->getCorretta());

        //cancello l'alternativa
        $controller->rimuoviAlternativa($idAlt);

        //leggo tutte le alternative della domanda multipla
        $allAltByDom = $controller->getAllAlternativaByDomanda(self::IDDOMMULTIPLA);
        print_r($allAltByDom);

        //trovo l'alternativa corretta di una domanda
        $altCorretta = $controller->getAlternativaCorrettaByDomanda(self::IDDOMMULTIPLA);
        print_r($altCorretta);

    }
}
