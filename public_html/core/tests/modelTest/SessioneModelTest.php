<?php

/**
 * La classe effettua il test di tutti i metodi della classe SessioneModel.php
 * @author Giuseppina Tufano
 * @version 1.0
 * @since 30/11/15
 */


class SessioneModelTest extends \PHPUnit_Framework_TestCase
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

        $model = new SessioneModel();

        //testo la read
        $sessione1 = $model->readSessione(self::IDSESSIONE);
        print_r($sessione1);

        //creo la sessione
        $idSess = $model->createSessione(new Sessione(self::DATAI, self::DATAF, self::SOGLIAAMM, self::STATO, self::TIPOLOGIASESS, self::CORSOID));

        //leggo dal db la sessione creata
        $sessione = $model->readSessione($idSess);
        print_r($sessione);

        //confronto se le sessioni sono equivalenti
        $this->assertEquals(self::DATAI, $sessione->getDataInizio());
        $this->assertEquals(self::DATAF, $sessione->getDataFine());
        $this->assertEquals(self::SOGLIAAMM, $sessione->getSogliaAmmissione());
        $this->assertEquals(self::STATO, $sessione->getStato());
        $this->assertEquals(self::TIPOLOGIASESS, $sessione->getTipologia());
        $this->assertEquals(self::CORSOID, $sessione->getCorsoId());


        //eseguo una modifica sulla sessione creata
        $model->updateSessione($idSess,(new Sessione(self::DATAI2, self::DATAF2, self::SOGLIAAMM, self::STATO, self::TIPOLOGIASESS, self::CORSOID)));

       //leggo la sessione modificata dal db
        $sessioneModificata = $model->readSessione($idSess);

        //confronto le modifiche
        $this->assertEquals(self::DATAI2, $sessioneModificata->getDataInizio());
        $this->assertEquals(self::DATAF2, $sessioneModificata->getDataFine());
        $this->assertEquals(self::SOGLIAAMM, $sessioneModificata->getSogliaAmmissione());
        $this->assertEquals(self::STATO, $sessioneModificata->getStato());
        $this->assertEquals(self::TIPOLOGIASESS, $sessioneModificata->getTipologia());
        $this->assertEquals(self::CORSOID, $sessioneModificata->getCorsoId());

        //associo test ad una sessione
        $model->associaTestSessione(self::IDSESSIONE, self::IDTEST);
        //controllo se è stato associato
        $allTestsSessione = $model->getAllTestBySessione(self::IDSESSIONE);
        print("Stampo tutti i test di sessione per verificare se il test è stato associato");
        print_r($allTestsSessione);

        //dissocio test ad una sessione
        $model->dissociaTestSessione(self::IDSESSIONE, self::IDTEST);
        //controllo se è stato dissociato
        $allTestsSessione = $model->getAllTestBySessione(self::IDSESSIONE);
        print("Stampo tutti i test di sessione per verificare se il test è stato dissociato");
        print_r($allTestsSessione);


        //associo di nuovo il test per poi cancellare
        $model->associaTestSessione(self::IDSESSIONE, self::IDTEST);
        $model->deleteAllTestFromSessione(self::IDSESSIONE);
        //stampo tutti i test per verificare che il test non esiste piu
        $allTestsSessione = $model->getAllTestBySessione(self::IDSESSIONE);
        print("Stampo tutti i test di sessione per verificare se il test è stato eliminato");
        print_r($allTestsSessione);


        //testo abilita mostra esiti
        $model->abilitaMostraEsito(self::IDSESSIONE);
        $mostraEsito = $model->readMostraEsitoSessione(self::IDSESSIONE);
        $this->assertEquals('Si', $mostraEsito);

        //testo disabilita mostra esiti
        $model->disabilitaMostraEsito(self::IDSESSIONE);
        $mostraEsito = $model->readMostraEsitoSessione(self::IDSESSIONE);
        $this->assertEquals('No', $mostraEsito);

        //testo abilita mostra risposte corrette
        $model->abilitaMostraRisposteCorrette(self::IDSESSIONE);
        $mostraEsito = $model->readMostraRisposteCorretteSessione(self::IDSESSIONE);
        $this->assertEquals('Si', $mostraEsito);

        //testo disabilita mostra risposte corrette
        $model->disabilitaMostraRisposteCorrette(self::IDSESSIONE);
        $mostraEsito = $model->readMostraRisposteCorretteSessione(self::IDSESSIONE);
        $this->assertEquals('No', $mostraEsito);

        //elimino la sessione dal db
        $model->deleteSessione($idSess);

        //leggo tutte le sessioni e verifico se la sessione è stata eliminata
        $allSess = $model->getAllSessioni();
        print_r($allSess);

        //leggo tutte le sessioni di uno studente
        $allSbS = $model->getAllSessioniByStudente(self::MATRICOLA);
        print_r($allSbS);

        //leggo tutte le sessioni di un corso
        $allSC = $model ->getAllSessioniByCorso(self::CORSOID);
        print_r($allSC);


    }




}
