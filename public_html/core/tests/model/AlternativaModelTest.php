<?php
/**
 * Created by PhpStorm.
 * User: Alina
 * Date: 29/11/2015
 * Time: 20:30
 */




class AlternativaModelTest extends \PHPUnit_Framework_TestCase
{

    const IDDOMMULTIPLA =  2;
    const IDARGOMENTO = 2;
    const CORSOID = 19;
    const TESTO = "Risposta di prova";
    const PERCSCELTA = 10;
    const CORRETTA = 'No';
    const TESTO2 = "Risposta di prova2";
    const PERCSCELTA2 = 14;


    public function testAlternativa()
    {

        $model = new AlternativaModel();
        //crea un'alterntaiva
        $idAlt = $model->createAlternativa(new Alternativa(null, self::IDDOMMULTIPLA, self::IDARGOMENTO, self::CORSOID, self::TESTO, self::PERCSCELTA, self::CORRETTA));

        //legge l'arternativa creata
        $altern = $model->readAlternativa($idAlt, self::IDDOMMULTIPLA,self::IDARGOMENTO, self::CORSOID);

        //confronta le due alternative
        $this->assertEquals(self::IDDOMMULTIPLA, $altern->getDomandaMultiplaId());
        $this->assertEquals(self::IDARGOMENTO, $altern->getDomandaMultiplaArgomentoId());
        $this->assertEquals(self::CORSOID, $altern->getDomandaMultiplaArgomentoCorsoId());
        $this->assertEquals(self::TESTO, $altern->getTesto());
        $this->assertEquals(self::PERCSCELTA, $altern->getPercentualeScelta());
        $this->assertEquals(self::CORRETTA, $altern->getCorretta());

        //modifico l'alternativa in questione
        $model->updateAlternativa($idAlt, self::IDDOMMULTIPLA,self::IDARGOMENTO, self::CORSOID, (new Alternativa(null, self::IDDOMMULTIPLA, self::IDARGOMENTO, self::CORSOID, self::TESTO2, self::PERCSCELTA2, self::CORRETTA)));

        //leggo l'alternativa modificata
        $altMod = $model->readAlternativa($idAlt, self::IDDOMMULTIPLA,self::IDARGOMENTO, self::CORSOID);

        //verifico la modifica
        $this->assertEquals(self::IDDOMMULTIPLA, $altMod->getDomandaMultiplaId());
        $this->assertEquals(self::IDARGOMENTO, $altMod->getDomandaMultiplaArgomentoId());
        $this->assertEquals(self::CORSOID, $altMod->getDomandaMultiplaArgomentoCorsoId());
        $this->assertEquals(self::TESTO2, $altMod->getTesto());
        $this->assertEquals(self::PERCSCELTA2, $altMod->getPercentualeScelta());
        $this->assertEquals(self::CORRETTA, $altMod->getCorretta());

        //cancello l'alternativa
        $model->deleteAlternativa($idAlt, self::IDDOMMULTIPLA,self::IDARGOMENTO, self::CORSOID);

        //verifico la cancellazione
        $allAltern = $model->getAllAlternativa();
        print_r($allAltern);

        //leggo tutte le alternative della domanda multipla
        $allAltByDom = $model->getAllAlternativaByDomanda(self::IDDOMMULTIPLA, self::IDARGOMENTO, self::CORSOID);
        print_r($allAltByDom);

        //trovo l'alternativa corretta di una domanda
        $altCorretta = $model->getAlternativaCorrettaByDomanda(self::IDDOMMULTIPLA, self::IDARGOMENTO, self::CORSOID);
        print_r($altCorretta);

    }
}
