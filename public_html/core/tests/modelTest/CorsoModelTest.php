<?php

/**
 * Created by PhpStorm.
 * User: Dario
 * Date: 30/11/2015
 * Time: 07:46
 */
class CorsoModelTest extends PHPUnit_Framework_TestCase
{
    const MATRICOLA = "12341234";
    const NOME = "Reti";
    const TIPOLOGIA = "Semestrale";
    const TIPOLOGIA2 = "Annuale";
    const CDLMATRICOLA = "051214";
    const STUDENTEMATRICOLA = "0512102396";
    const DOCENTEMATRICOLA = "0512109999";

    public function testCorso() {

        $model = new CorsoModel();

        $idCorso = $model->createCorso(new Corso(self::MATRICOLA,self::NOME,self::TIPOLOGIA,self::CDLMATRICOLA));
        $corso = $model->readCorso($idCorso);

        $this->assertEquals($idCorso,$corso->getId());
        $this->assertEquals(self::MATRICOLA,$corso->getMatricola());
        $this->assertEquals(self::NOME,$corso->getNome());
        $this->assertEquals(self::TIPOLOGIA,$corso->getTipologia());
        $this->assertEquals(self::CDLMATRICOLA,$corso->getCdlMatricola());

        $model->updateCorso($idCorso,new Corso(self::MATRICOLA,self::NOME,self::TIPOLOGIA2,self::CDLMATRICOLA));
        $corsoMod = $model->readCorso($idCorso);
        $this->assertEquals(self::TIPOLOGIA2,$corsoMod->getTipologia());

        $model->deleteCorso($idCorso);
        $allCorsi = $model->getAllCorsi();
        print_r($allCorsi);

        $allCorsiDocente = $model->getAllCorsiByDocente(self::DOCENTEMATRICOLA);
        print_r($allCorsiDocente);

        $allCorsiStudente = $model->getAllCorsiByStudente(self::STUDENTEMATRICOLA);
        print_r($allCorsiStudente);

    }
}
