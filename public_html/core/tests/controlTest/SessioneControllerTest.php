<?php

/**
 * La classe effettua il test di tutti i metodi della classe SessioneController.php
 * @author D'Avanzo Antonio Luca
 * @version 1.0
 * @since 21/12/15
 */


class SessioneControllerTest extends \PHPUnit_Framework_TestCase
{
    const IDSESSIONE = 170; // CI DEVE STARE QUESTO ID NEL DB
    const TIPOLOGIASESS = 'Esercitativa';
    const TIPOLOGIASESS2 = "Valutativa";
    const CORSOID  = 18;
    const STATO = 'Eseguita';
    const DATAI = '2015-02-28 10:00:00';
    const DATAF = '2015-02-28 10:00:00';
    const SOGLIAAMM = 10;
    const DATAI2 = '2015-10-28 10:00:00';
    const DATAF2 = '2015-11-28 10:00:00';
    const MATRICOLA = "0512109994";
    const IDTEST = 1;

    public function testSessione()
    {

        $control = new SessioneController();

        //testo la read
        $sessione1 = $control->readSessione(self::IDSESSIONE);
        print_r($sessione1);

        //creo la sessione
        $idSess = $control->creaSessione(new Sessione(self::DATAI, self::DATAF, self::SOGLIAAMM, self::STATO, self::TIPOLOGIASESS, self::CORSOID));

        //leggo dal db la sessione creata
        $sessione = $control->readSessione($idSess);
        print_r($sessione);

        //confronto se le sessioni sono equivalenti
        $this->assertEquals(self::DATAI, $sessione->getDataInizio());
        $this->assertEquals(self::DATAF, $sessione->getDataFine());
        $this->assertEquals(self::SOGLIAAMM, $sessione->getSogliaAmmissione());
        $this->assertEquals(self::STATO, $sessione->getStato());
        $this->assertEquals(self::TIPOLOGIASESS, $sessione->getTipologia());
        $this->assertEquals(self::CORSOID, $sessione->getCorsoId());


        //eseguo una modifica sulla sessione creata
        $control->updateSessione($idSess,(new Sessione(self::DATAI2, self::DATAF2, self::SOGLIAAMM, self::STATO, self::TIPOLOGIASESS, self::CORSOID)));

        //leggo la sessione modificata dal db
        $sessioneModificata = $control->readSessione($idSess);

        //confronto le modifiche
        $this->assertEquals(self::DATAI2, $sessioneModificata->getDataInizio());
        $this->assertEquals(self::DATAF2, $sessioneModificata->getDataFine());
        $this->assertEquals(self::SOGLIAAMM, $sessioneModificata->getSogliaAmmissione());
        $this->assertEquals(self::STATO, $sessioneModificata->getStato());
        $this->assertEquals(self::TIPOLOGIASESS, $sessioneModificata->getTipologia());
        $this->assertEquals(self::CORSOID, $sessioneModificata->getCorsoId());

        //elimino la sessione dal db
        $control->deleteSessione($idSess);

        //leggo tutte le sessioni e verifico se la sessione è stata eliminata
        $allSess = $control->getAllSessioni();
        print_r($allSess);

        //leggo tutte le sessioni di uno studente
        $allSbS = $control->getAllSessioniByStudente(self::MATRICOLA);
        print_r($allSbS);

        //leggo tutte le sessioni di un corso
        $allSC = $control ->getAllSessioniByCorso(self::CORSOID);
        print_r($allSC);


        //associo di nuovo il test per poi cancellare
        $control->associaTestASessione(self::IDSESSIONE, self::IDTEST);
        $control->deleteAllTestFromSessione(self::IDSESSIONE);
        //stampo tutti i test per verificare che il test non esiste piu
        $allTestsSessione = $control->getAllTestBySessione(self::IDSESSIONE);
        print("Stampo tutti i test di sessione per verificare se il test è stato eliminato");
        print_r($allTestsSessione);


        //associo test ad una sessione
        $control->associaTestASessione(self::IDSESSIONE, self::IDTEST);
        //controllo se è stato associato
        $allTestsSessione = $control->getAllTestBySessione(self::IDSESSIONE);
        print("Stampo tutti i test di sessione per verificare se il test è stato associato");
        print_r($allTestsSessione);


        //testo abilita mostra esiti
        $control->abilitaMostraEsito(self::IDSESSIONE);
        $mostraEsito = $control->readMostraEsitoSessione(self::IDSESSIONE);
        $this->assertEquals('Si', $mostraEsito);

        //testo disabilita mostra esiti
        $control->disabilitaMostraEsito(self::IDSESSIONE);
        $mostraEsito = $control->readMostraEsitoSessione(self::IDSESSIONE);
        $this->assertEquals('No', $mostraEsito);

        //testo abilita mostra risposte corrette
        $control->abilitaMostraRisposteCorrette(self::IDSESSIONE);
        $mostraEsito = $control->readMostraRisposteCorretteSessione(self::IDSESSIONE);
        $this->assertEquals('Si', $mostraEsito);

        //testo disabilita mostra risposte corrette
        $control->disabilitaMostraRisposteCorrette(self::IDSESSIONE);
        $mostraEsito = $control->readMostraRisposteCorretteSessione(self::IDSESSIONE);
        $this->assertEquals('No', $mostraEsito);

        //elimino la sessione dal db
        $control->deleteSessione($idSess);

        //leggo tutte le sessioni e verifico se la sessione è stata eliminata
        $allSess = $control->getAllSessioni();
        print_r($allSess);

        //leggo tutte le sessioni di uno studente
        $allSbS = $control->getAllSessioniByStudente(self::MATRICOLA);
        print_r($allSbS);

        //leggo tutte le sessioni di un corso
        $allSC = $control ->getAllSessioniByCorso(self::CORSOID);
        print_r($allSC);

        $studentiSess = $control->getEsaminandiSessione(self::IDSESSIONE);
        print("Restituisce tutti gli studenti che stanno sostenendo una sessione\n");
        print_r($studentiSess);

        
        $control->abilitaStudenteASessione(self::IDSESSIONE, self::MATRICOLA);
        
        $studentiSess = $control->getAllStudentiBySessione(self::IDSESSIONE);
        print("Restituisce tutti gli studenti abilitati ad una sessione\n");
        print_r($studentiSess);
        
        $control->disabilitaStudenteDaSessione(self::IDSESSIONE, self::MATRICOLA);

        //cerco tutti gli studenti di un corso
        $studenti = $control->getAllStudentiByCorso(self::CORSOID );
        print("Restituisce tutti gli studenti di un corso\n");
        print_r($studenti);

        //leggo tutti i test del corso
        $allTestsCorso = $control->getAllTestByCorso(self::CORSOID);
        $allTestsCorso = $control->getAllTestByCorso(self::CORSOID);
        print_r($allTestsCorso);

        //leggo tutti i test della sessione
        $allTestsSessione = $control->getAllTestBySessione(self::IDSESSIONE);
        print_r($allTestsSessione);

    }




}
