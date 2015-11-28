<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 26/11/15
 * Time: 17:34
 */
class AccountModelTest extends PHPUnit_Framework_TestCase {

    const MATRICOLA = "12312312";

    const EMAIL = "testemail@gmail.com";

    const PASS = "testpassword";

    const TIPO = "Studente";

    const NOME = "Sergio";

    const COGN = "Sheva";

    const CDL_MAT = "051210";

    const NOME2 = "Ss";

    public function testCreateRemoveEditUtente() {
        $model = new AccountModel();
        $model->removeUtente(self::MATRICOLA);

        $model->createUtente(new Utente(self::MATRICOLA, self::EMAIL, self::PASS, self::TIPO,
                                        self::NOME, self::COGN, self::CDL_MAT));

        /** @var Utente $utente */
        $utente = $model->getUtente(self::EMAIL, self::PASS);

        $this->assertEquals(self::MATRICOLA, $utente->getMatricola());
        $this->assertEquals(self::EMAIL, $utente->getUsername());
        $this->assertEquals(self::TIPO, $utente->getTipologia());
        $this->assertEquals(self::NOME, $utente->getNome());
        $this->assertEquals(self::COGN, $utente->getCognome());
        $this->assertEquals(self::CDL_MAT, $utente->getCdlMatricola());
        $this->assertEquals("39f68c04cc5849f3226fc9c4a5c8b8e2", $utente->getPassword());

        $utente2 = $model->getUtenteByMatricola(self::MATRICOLA);
        $this->assertEquals($utente, $utente2);

        $utente2 = $model->getUtenteByIdentity($utente->getPassword());
        $this->assertEquals($utente, $utente2);

        $utente->setNome(self::NOME2);
        $model->editUtente($utente->getMatricola(), $utente);

        $utente = $model->getUtenteByMatricola(self::MATRICOLA);
        $this->assertEquals(self::NOME2, $utente->getNome());

        $this->assertTrue($model->removeUtente(self::MATRICOLA));
    }

    public function testgetAllDocentiByCorso() {
        
    }


}
