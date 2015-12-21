<?php
/**
 * Created by PhpStorm.
 * User: fede_dr
 * Date: 21/12/15
 * Time: 09:25
 */

class CdlControllerTest extends \PHPUnit_Framework_TestCase
{
    const MATRICOLA = '0512345';
    const NOME = 'Nome corso';
    const TIPOLOGIA = 'Triennale';
    const NOME2 = 'Nome corso2';
    const TIPOLOGIA2 = 'Magistrale';
    const TIPOLOGIA3 = 'Annuale';
    const TIPOLOGIA4 = 'Semestrale';
    const CDLMATRICOLA = '051210';
    const STUDENTEMATRICOLA = '0512102360';
    const DOCENTEMATRICOLA = '0512102999';

    public function testCdlController() {

        $controller = new \CdlController();

        //creo cdl
        $cdl = new CdL(self::MATRICOLA, self::NOME, self::TIPOLOGIA);
        $controller->creaCdl($cdl);

        //leggo il cdl creato e confronto i valori
        $cdl2 = $controller->readCdl(self::MATRICOLA);
        print_r($cdl2);

        //confronto se i due cdl sono equivalenti
        $this->assertEquals(self::MATRICOLA, $cdl2->getMatricola());
        $this->assertEquals(self::NOME, $cdl2->getNome());
        $this->assertEquals(self::TIPOLOGIA, $cdl2->getTipologia());

        //modifico e leggo il cdl modificato
        $controller->modificaCdl(self::MATRICOLA, (new CdL(self::MATRICOLA, self::NOME2, self::TIPOLOGIA2)));
        $cdlmodificato = $controller->readCdl(self::MATRICOLA);
        print_r($cdlmodificato);

        //confronto se i due cdl sono equivalenti
        $this->assertEquals(self::MATRICOLA, $cdlmodificato->getMatricola());
        $this->assertEquals(self::NOME2, $cdlmodificato->getNome());
        $this->assertEquals(self::TIPOLOGIA2, $cdlmodificato->getTipologia());

        //elimino cdl
        $controller->eliminaCdl(self::MATRICOLA);

        //leggo tutti i cdl e verifico che sia stato eliminato
        $allCdl = $controller->getCdl();
        print_r($allCdl);

        



        //creo il corso
        $idCorso = $controller->creaCorso(new Corso(self::MATRICOLA,self::NOME,self::TIPOLOGIA3,self::CDLMATRICOLA));

        //leggo dal db corso creato
        $corso = $controller->readCorso($idCorso);

        //confronto se i corsi sono equivalenti
        $this->assertEquals($idCorso, $corso->getId());
        $this->assertEquals(self::MATRICOLA, $corso->getMatricola());
        $this->assertEquals(self::NOME, $corso->getNome());
        $this->assertEquals(self::TIPOLOGIA3, $corso->getTipologia());
        $this->assertEquals(self::CDLMATRICOLA, $corso->getCdlMatricola());

        //modifico il corso
        $controller->modificaCorso($idCorso, new Corso(self::MATRICOLA,self::NOME,self::TIPOLOGIA4,self::CDLMATRICOLA));
        //leggo il corso modificato dal db
        $corsomodificato = $controller->readCorso($idCorso);
        $this->assertEquals(self::TIPOLOGIA4, $corsomodificato->getTipologia());

        //elimino il corso
        $controller->eliminaCorso($idCorso);

        //leggo tutti i corsi dal db
        $allCorsi = $controller->getCorsi();
        print_r($allCorsi);

        //leggo tutti i corsi di un CdL
        $allCorsiCdl = $controller->getCorsiCdl(self::CDLMATRICOLA);
        print_r($allCorsiCdl);

        //creo una relazione insegnamento
        $controller->creaInsegnamento($idCorso, self::DOCENTEMATRICOLA);

        //leggo tutti i corsi insegnati da un docente
        $allCorsiDocente = $controller->getCoursesByMatricola(self::DOCENTEMATRICOLA);
        print_r($allCorsiDocente);

        //elimino la relazione insegnamento
        $controller->eliminaInsegnamento($idCorso, self::DOCENTEMATRICOLA);

        //leggo tutti i corsi insegnati da un docente
        $allCorsiDocente = $controller->getCoursesByMatricola(self::DOCENTEMATRICOLA);
        print_r($allCorsiDocente);

        //leggo tutti i corsi frequentati da uno studente
        $allCorsiStudente = $controller->getCorsiStudente(self::STUDENTEMATRICOLA);
        print_r($allCorsiStudente);

    }

}