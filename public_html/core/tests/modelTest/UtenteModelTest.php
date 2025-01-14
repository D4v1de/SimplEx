<?php

/**
 * La classe effettua il test di tutti i metodi della classe UtenteModel.php
 *
 * @author Elvira Zanin
 * @version 1.0
 * @since 26/11/15
 */

class UtenteModelTest extends PHPUnit_Framework_TestCase {

    const MATRICOLA = "12312312";
    const EMAIL = "testemail@gmail.com";
    const PASS = "testpassword";
    const TIPO = "Studente";
    const NOME = "Sergio";
    const COGN = "Sheva";
    const CDL_MAT = "051210";
    const NOME2 = "Ss";
    const IDCORSO = 18;
    const MATRICOLACDL = "051211";
    const IDSESSIONE = 1;

    public function testUtente() {
        $model = new UtenteModel();

        //Nel caso se l'utente già esiste nel db lo rimuovo
        $model->deleteUtente(self::MATRICOLA);


        // Siamo sicuri che l'utente non esiste, quindi ora lo creiamo
        $model->createUtente(new Utente(self::MATRICOLA, self::EMAIL, self::PASS, self::TIPO,
                                        self::NOME, self::COGN, self::CDL_MAT));

        //Leggo dal db utente creato
        $utente = $model->getUtente(self::EMAIL, self::PASS);

        //Confronto tutti i campi
        $this->assertEquals(self::MATRICOLA, $utente->getMatricola());
        $this->assertEquals(self::EMAIL, $utente->getUsername());
        $this->assertEquals(self::TIPO, $utente->getTipologia());
        $this->assertEquals(self::NOME, $utente->getNome());
        $this->assertEquals(self::COGN, $utente->getCognome());
        $this->assertEquals(self::CDL_MAT, $utente->getCdlMatricola());
        $this->assertEquals("39f68c04cc5849f3226fc9c4a5c8b8e2", $utente->getPassword()); //la pass è cifrata

        //Leggo dal db utente data la matricola
        $utente2 = $model->getUtenteByMatricola(self::MATRICOLA);
        $this->assertEquals($utente, $utente2); //E verifico se è uguale a quello letto prima

        //Leggo dal db utente con identità (in pratica è la password criptata)
        $utente2 = $model->getUtenteByIdentity($utente->getPassword());
        $this->assertEquals($utente, $utente2);

        //Modifico l'utente
        $utente->setNome(self::NOME2);
        //ed applico le modifiche al db
        $model->updateUtente($utente->getMatricola(), $utente);

        //Rileggo di nuovo l'utente dal db
        $utente = $model->getUtenteByMatricola(self::MATRICOLA);
        //confronto i nomi
        $this->assertEquals(self::NOME2, $utente->getNome());

        //restituisco tutti gli studenti
        $allStudenti = $model->getAllStudenti();
        print("Restituisce tutti gli studenti\n");
        print_r($allStudenti);

        //restituisco tutti i docenti
        $allDocenti = $model->getAllDocenti();
        print("Restituisce tutti i docenti\n");
        print_r($allDocenti);

        //cerco tutti gli studenti di un corso
        $studenti = $model->getAllStudentiByCorso(self::IDCORSO);
        print("Restituisce tutti gli studenti di un corso\n");
        print_r($studenti);

        //cerco tutti i docenti di un corso
        $docenti = $model->getAllDocentiByCorso(self::IDCORSO);
        print("Restituisce tutti i docenti di un corso\n");
        print_r($docenti);

        $studenteCdl = $model->getAllStudentiByCdl(self::MATRICOLACDL);
        print("Restituisce tutti gli studenti di un cdl\n");
        print_r($studenteCdl);

        $model->iscriviStudenteCorso(self::MATRICOLA, self::IDCORSO);

        $model->abilitaStudenteSessione(self::IDSESSIONE, self::MATRICOLA);

        $studentiSess = $model->getAllStudentiSessione(self::IDSESSIONE);
        print("Restituisce tutti gli studenti abilitati ad una sessione\n");
        print_r($studentiSess);

        $model->disabilitaStudenteSessione(self::IDSESSIONE, self::MATRICOLA);

        $studentiSess = $model->getAllStudentiSessione(self::IDSESSIONE);
        print("Restituisce tutti gli studenti abilitati ad una sessione\n");
        print_r($studentiSess);

        $studentiSess = $model->getEsaminandiSessione(self::IDSESSIONE);
        print("Restituisce tutti gli studenti che stanno sostenendo una sessione\n");
        print_r($studentiSess);

        $model->disiscriviStudenteCorso(self::MATRICOLA, self::IDCORSO);

        //cancello (ovviamente verificando se mi restituisce TRUE)
        $model->deleteUtente(self::MATRICOLA);

        //cancello di nuovo, la seconda volta dovrebbe restituire false (utente non esiste)
        $model->deleteUtente(self::MATRICOLA);
    }
}
