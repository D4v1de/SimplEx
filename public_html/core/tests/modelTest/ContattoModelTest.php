<?php

/**
 * Created by PhpStorm.
 * User: Elvira
 * Date: 02/12/2015
 * Time: 08:30
 */


class ContattoModelTest extends \PHPUnit_Framework_TestCase
{

    const IDCONTATTO = 1; //ci deve essere questo id nel db
    const VALORE = "000000000";
    const VALORE2 = "000000000";
    const TIPOLOGIA = "Fax";
    const TIPOLOGIA2 = "Telefono";
    const MATRICOLAUTENTE = "0512109998";
    const MATRICOLAUTENTE2 = "0512109999";
    

    public function testContatto()
    {
        $model = new ContattoModel();

        //testo la read
        $contatto1 = $model->readContatto(self::IDCONTATTO);
        print_r($contatto1);

        //creo contatto
        $idContatto = $model->createContatto(new Contatto(self::VALORE, self::TIPOLOGIA, self::MATRICOLAUTENTE));

        //leggo dal db contatto creato
        $contatto = $model->readContatto($idContatto);
        print_r($contatto);

        //confronto se i contatti sono equivalenti
        $this->assertEquals(self::VALORE, $contatto->getValore());
        $this->assertEquals(self::TIPOLOGIA, $contatto->getTipologia());
        $this->assertEquals(self::MATRICOLAUTENTE, $contatto->getUtenteMatricola());

        //leggo tutti i contatti di un utente
        $allContattiUtente = $model->getAllContattiByUtente(self::MATRICOLAUTENTE);
        print_r($allContattiUtente);
        
        //eseguo una modifica sul contatto creato
        $model->updateContatto($idContatto, (new Contatto(self::VALORE2, self::TIPOLOGIA2, self::MATRICOLAUTENTE2)));

        //leggo il contatto modificato dal db
        $contattoModificato = $model->readContatto($idContatto);

        //confronto le modifiche
        $this->assertEquals(self::VALORE2, $contattoModificato->getValore());
        $this->assertEquals(self::TIPOLOGIA2, $contattoModificato->getTipologia());
        $this->assertEquals(self::MATRICOLAUTENTE2, $contattoModificato->getUtenteMatricola());

        //elimino il contatto dal db
        $model->deleteContatto($idContatto);

        //leggo tutti i contatti e verifico che il contatto sia stato eliminato
        $allContatti = $model->getAllContatti();
        print_r($allContatti);
    }
}