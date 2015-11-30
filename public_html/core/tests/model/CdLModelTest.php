<?php
/**
 * Created by PhpStorm.
 * User: Alina
 * Date: 30/11/2015
 * Time: 12:12
 */




class CdLModelTest extends \PHPUnit_Framework_TestCase
{

    const MATRICOLA = '051234949';
    const NOME = 'Nome corso';
    const TIPOLOGIA = 'Triennale';
    const NOME2 = 'Nome corso2';
    const TIPOLOGIA2 = 'Magistrale';

    public function testCdl()
    {

        $model = new \CdLModel();
        //creo cdl
        $model->createCdL(new CdL(self::MATRICOLA, self::NOME, 'Triennale'));

        //leggo dal db cdl creato
        $cdl = $model->readCdL(self::MATRICOLA);

        //confronto se i due cdl sono equivalenti
        $this->assertEquals(self::MATRICOLA, $cdl->getMatricola());
        $this->assertEquals(self::NOME, $cdl->getNome());
        $this->assertEquals(self::TIPOLOGIA, $cdl->getTipologia());

        //eseguo una modifica sul cdl creato prima
        $model->updateCdL(self::NOME2, self::TIPOLOGIA2);

        //leggo cdl modificato dal db
        $cdlModificato = $model->readCdL(self::MATRICOLA);

        //confronto i due cdl
        $this->assertEquals(self::MATRICOLA, $cdlModificato->getMatricola());
        $this->assertEquals(self::NOME2, $cdlModificato->getNome());
        $this->assertEquals(self::TIPOLOGIA2, $cdlModificato->getTipologia());

        //elimino cdl creato
        $model->deleteCdL(self::MATRICOLA);

        //leggo tutti i cdl e verifico che il cdl in questione è stato eliminato
        $allCdl = $model->getAllCdL();
        print_r($allCdl);


    }
}
