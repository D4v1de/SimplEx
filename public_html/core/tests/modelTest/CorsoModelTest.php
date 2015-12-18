<?php

/**
 * La classe effettua il test di tutti i metodi della classe CorsoModel.php
 *
 * @author Elvira Zanin
 * @version 1.0
 * @since 30/11/15
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

        //creo il corso
        $idCorso = $model->createCorso(new Corso(self::MATRICOLA,self::NOME,self::TIPOLOGIA,self::CDLMATRICOLA));

        //leggo dal db corso creato
        $corso = $model->readCorso($idCorso);

        //confronto se i corsi sono equivalenti
        $this->assertEquals($idCorso,$corso->getId());
        $this->assertEquals(self::MATRICOLA,$corso->getMatricola());
        $this->assertEquals(self::NOME,$corso->getNome());
        $this->assertEquals(self::TIPOLOGIA,$corso->getTipologia());
        $this->assertEquals(self::CDLMATRICOLA,$corso->getCdlMatricola());

        //modifico il corso
        $model->updateCorso($idCorso,new Corso(self::MATRICOLA,self::NOME,self::TIPOLOGIA2,self::CDLMATRICOLA));
        //leggo il corso modificato dal db
        $corsoMod = $model->readCorso($idCorso);
        $this->assertEquals(self::TIPOLOGIA2,$corsoMod->getTipologia());

        //elimino il corso
        $model->deleteCorso($idCorso);

        //leggo tutti i corsi dal db
        $allCorsi = $model->getAllCorsi();
        print_r($allCorsi);

        //leggo tutti i corsi di un CdL
        $allCorsiCdl = $model->getAllCorsiByCdl(self::CDLMATRICOLA);
        print_r($allCorsiCdl);

        //leggo tutti i corsi insegnati da un docente
        $allCorsiDocente = $model->getAllCorsiByDocente(self::DOCENTEMATRICOLA);
        print_r($allCorsiDocente);

        //leggo tutti i corsi frequentati da uno studente
        $allCorsiStudente = $model->getAllCorsiByStudente(self::STUDENTEMATRICOLA);
        print_r($allCorsiStudente);




    }
}
