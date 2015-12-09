<?php

/**
 * Created by PhpStorm.
 * User: Dario
 * Date: 02/12/2015
 * Time: 11:28
 */
class ElaboratoModelTest extends PHPUnit_Framework_TestCase
{
    const SESSIONE_ID = 1;
    const CDLMATRICOLA = "051214";
    const STUDENTE_MATRICOLA = "0512102552";
    const ESITO_FINALE = 25.0;
    const ESITO_PARZIALE = 18.0;
    const TEST_ID = 3;

    public function testCreateRemoveEditElaborato() {
        $model = new ElaboratoModel();

        $model->deleteElaborato(self::STUDENTE_MATRICOLA,self::SESSIONE_ID);

        $model->createElaborato(new Elaborato(self::STUDENTE_MATRICOLA,self::SESSIONE_ID,self::ESITO_PARZIALE, self::ESITO_FINALE,self::TEST_ID, null));

        $elaborato = $model->readElaborato(self::STUDENTE_MATRICOLA,self::SESSIONE_ID);

        $this->assertEquals(self::STUDENTE_MATRICOLA,$elaborato->getStudenteMatricola());
        $this->assertEquals(self::SESSIONE_ID,$elaborato->getSessioneId());
        $this->assertEquals(self::ESITO_FINALE,$elaborato->getEsitoFinale());
        $this->assertEquals(self::ESITO_PARZIALE,$elaborato->getEsitoParziale());
        $this->assertEquals(self::TEST_ID,$elaborato->getTestId());

        $elaborato2 = $model->readElaborato(self::STUDENTE_MATRICOLA,self::SESSIONE_ID);
        $this->assertEquals($elaborato,$elaborato2);

        $allElab = $model->getAllElaborato();
        $allElab2 = $model->getElaboratiStudente(new Utente(self::STUDENTE_MATRICOLA,"","","","","",self::CDLMATRICOLA));
        print_r($allElab);
        print_r($allElab2);

        $model->deleteElaborato(self::STUDENTE_MATRICOLA,self::SESSIONE_ID);



    }
}
