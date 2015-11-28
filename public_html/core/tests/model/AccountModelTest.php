<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 26/11/15
 * Time: 17:34
 */
class AccountModelTest extends PHPUnit_Framework_TestCase {

    const MATRICOLA = "12312312";

    const TESTEMAIL_GMAIL_COM = "testemail@gmail.com";

    const TESTPASSWORD = "testpassword";

    public function testCreateUtente() {
        $model = new AccountModel();
        $model->removeUtente(self::MATRICOLA);

        $model->createUtente(new Utente(self::MATRICOLA, self::TESTEMAIL_GMAIL_COM, self::TESTPASSWORD, "Studente", "Sergio", "Sheva", "051212"));

        /** @var Utente $utente */
        $utente = $model->getUtente(self::TESTEMAIL_GMAIL_COM, self::TESTPASSWORD);
        $this->assertEquals(self::MATRICOLA, $utente->getMatricola());
        //completare i tests
    }

}
