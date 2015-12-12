<?php

/**
 * User: Dario
 * Date: 24/11/15
 * Time: 19:38
 */
class Error {
    public static $INSERIMENTO_FALLITO = "Impossibile inserire nel database";
    public static $AGGIORNAMENTO_FALLITO = "Impossibile aggiornare il database";
    public static $CANCELLAZIONE_FALLITA = "Impossibile cancellare dal database";
    public static $CONTATTO_NON_TROVATO = "Nessun contatto trovato";
    public static $ELABORATO_NON_TROVATO = "Nessun elaborato trovato";
    public static $RISPOSTA_NON_TROVATA = "Nessuna risposta trovata";
    public static $NO_APERTE = "L'elaborato non ha risposte aperte";
    public static $CDL_NON_TROVATO = "Nessun corso di laurea trovato";
    public static $CORSO_NON_TROVATO = "Nessun corso trovato";
    public static $INSEGNAMENTO_NON_TROVATO = "Nessun insegnamento trovato";
    public static $SESSIONE_NON_TROVATA = "Nessuna sessione trovata";
    public static $STUDENTE_NON_TROVATO = "Nessuno studente trovato";
    public static $TEST_NON_TROVATO = "Nessun test trovato";
    public static $ARGOMENTO_NON_TROVATO = "Nessun argomento trovato";
    public static $DOMANDA_APERTA_NON_TROVATA = "Nessuna domanda aperta trovata";
    public static $DOMANDA_MULTIPLA_NON_TROVATA = "Nessuna domanda mutlipla trovata";
    public static $ALTERNATIVA_NON_TROVATA = "Nessuna alternativa trovata";


    /*
     * Account model exceptions
     */

    public static $UTENTE_NON_TROVATO = "Utente non trovato";
    public static $EMAIL_NON_VALIDA = "Email non è valida";
    public static $PASS_CORTA = "La password inserita è troppo corta";
    public static $MATRICOLA_INESISTENTE = "Matricola inesistente";
    public static $NOME_NON_VALIDO = "Nome non valido";
    public static $CONGNOME_NON_VALIDO = "Cognome non valido";
    public static $TIPO_UTENTE_ERRATO = "Tipo utente errato";
    public static $MATRICOLA_ESISTE = "Utente con questa matricola esiste già";
}

?>
