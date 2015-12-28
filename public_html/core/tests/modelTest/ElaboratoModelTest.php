<?php

/**
 * La classe effettua il test di tutti i metodi della classe ElaboratoModel.php
 *
 * @author Elvira Zanin
 * @version 1.0
 * @since 02/12/15
 */

class ElaboratoModelTest extends PHPUnit_Framework_TestCase
{
    const SESSIONE_ID = 1;
    const CDLMATRICOLA = "051214";
    const STUDENTE_MATRICOLA = "0512102552";
    const ESITO_FINALE = 25.0;
    const ESITO_PARZIALE = 18.0;
    const ESITO_PARZIALE2 = 20.0;
    const ESITO_FINALE2 = 27.0;
    const TEST_ID = 3;

    public function testCreateRemoveEditElaborato() {
        $model = new ElaboratoModel();

        //testo delete
        $model->deleteElaborato(self::STUDENTE_MATRICOLA,self::SESSIONE_ID);

        //creo un elaborato
        $model->createElaborato(new Elaborato(self::STUDENTE_MATRICOLA,self::SESSIONE_ID,self::ESITO_PARZIALE, self::ESITO_FINALE,self::TEST_ID, null));

        //leggo l'elaborato creato
        $elaborato = $model->readElaborato(self::STUDENTE_MATRICOLA,self::SESSIONE_ID);
        //confronto gli elaborati
        $this->assertEquals(self::STUDENTE_MATRICOLA,$elaborato->getStudenteMatricola());
        $this->assertEquals(self::SESSIONE_ID,$elaborato->getSessioneId());
        $this->assertEquals(self::ESITO_FINALE,$elaborato->getEsitoFinale());
        $this->assertEquals(self::ESITO_PARZIALE,$elaborato->getEsitoParziale());
        $this->assertEquals(self::TEST_ID,$elaborato->getTestId());

        //eseguo una modifica sul cdl creato prima
        $model->updateElaborato(self::STUDENTE_MATRICOLA, self::SESSIONE_ID, new Elaborato(self::STUDENTE_MATRICOLA, self::SESSIONE_ID, self::ESITO_PARZIALE2, self::ESITO_FINALE2,self::TEST_ID, null ));

        //leggo cdl modificato dal db e verifico la correzione
        $elaboratoModificato = $model->readElaborato(self::STUDENTE_MATRICOLA, self::SESSIONE_ID);
        print_r($elaboratoModificato);

        //leggo tutti gli elaborati del db
        $allElab = $model->getAllElaborato();
        print_r($allElab);
        //leggo tutti gli elaborati di uno studente
        $allElab2 = $model->getElaboratiStudente(new Utente(self::STUDENTE_MATRICOLA,"","","","","",self::CDLMATRICOLA));
        print_r($allElab2);

        //leggo tutti gli elaborati di un test
        $allElab3 = $model->getAllElaboratiTest(self::TEST_ID);
        print_r($allElab3);
    }
}
