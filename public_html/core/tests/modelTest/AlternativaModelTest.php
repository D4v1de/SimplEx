<?php
/**
 * La classe effettua il test di tutti i metodi della classe AlternativaModel.php
 * @author Alina Korniychuk
 * @version 1.0
 * @since 29/11/15
 */




class AlternativaModelTest extends \PHPUnit_Framework_TestCase
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

        $model = new AlternativaModel();


        //testo la read
        $altern = $model->readAlternativa(self::IDALTERNATIVA);

        //crea un'alterntaiva
        $idAlt = $model->createAlternativa(new Alternativa(self::IDDOMMULTIPLA, self::TESTO, self::PERCSCELTA, self::CORRETTA));

        //legge l'arternativa creata
        $altern = $model->readAlternativa($idAlt);

        //confronta le due alternative
        $this->assertEquals(self::IDDOMMULTIPLA, $altern->getDomandaMultiplaId());
        $this->assertEquals(self::TESTO, $altern->getTesto());
        $this->assertEquals(self::PERCSCELTA, $altern->getPercentualeScelta());
        $this->assertEquals(self::CORRETTA, $altern->getCorretta());

        //modifico l'alternativa in questione
        $model->updateAlternativa($idAlt, (new Alternativa(self::IDDOMMULTIPLA, self::TESTO2, self::PERCSCELTA2, self::CORRETTA)));

        //leggo l'alternativa modificata
        $altMod = $model->readAlternativa($idAlt);

        //verifico la modifica
        $this->assertEquals(self::IDDOMMULTIPLA, $altMod->getDomandaMultiplaId());
        $this->assertEquals(self::TESTO2, $altMod->getTesto());
        $this->assertEquals(self::PERCSCELTA2, $altMod->getPercentualeScelta());
        $this->assertEquals(self::CORRETTA, $altMod->getCorretta());

        //cancello l'alternativa
        $model->deleteAlternativa($idAlt);

        //verifico la cancellazione
        $allAltern = $model->getAllAlternativa();
        print_r($allAltern);

        //leggo tutte le alternative della domanda multipla
        $allAltByDom = $model->getAllAlternativaByDomanda(self::IDDOMMULTIPLA);
        print_r($allAltByDom);

        //trovo l'alternativa corretta di una domanda
        $altCorretta = $model->getAlternativaCorrettaByDomanda(self::IDDOMMULTIPLA);
        print_r($altCorretta);

    }
}
