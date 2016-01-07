<?php
/**
 * Controller modifica profilo
 *
 * @author Sergio Shevchenko
 * @version 1.2
 * @since 28/12/15
 */
include_once MODEL_DIR . "UtenteModel.php";
if (isset($_POST['nome'])) {
    /** @var Utente $victim */
    $victim = $_SESSION['user'];
    $matricola = $victim->getMatricola();
    $tipologia = $victim->getTipologia();
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $cdlMatricola = $victim->getCdlMatricola();

    $pass = $_POST['passifreq'];
    $pass2 = $_POST['pass2'];

    try {
        if ($pass != $pass2) throw new IllegalArgumentException("Le password non coincidono");
        modificaUtente($matricola, $nome, $cognome, $cdlMatricola, $email, $pass, $tipologia);
        header('location: /me?success=Utente modificato');
        exit;
    } catch (ApplicationException $ex) {
        $_SESSION['error'] = "Errore nella modifica del profilo: " . $ex->getMessage();
    } catch (IllegalArgumentException $ex) {
        $_SESSION['error'] = "Errore nella modifica del profilo: " . $ex->getMessage();
    }
} else {
    $_SESSION['error'] = "Post non settato";
}
header('Location: ' . $_SERVER['HTTP_REFERER']);

function modificaUtente($matricola, $nome, $cognome, $cdlMatricola, $email, $pass, $tipo) {
    if (!is_numeric($matricola)) {
        throw new ApplicationException(Error::$MATRICOLA_INESISTENTE);
    }
    $aModel = new UtenteModel();
    $utente = $aModel->getUtenteByMatricola($matricola);

    //!!! CRAZY CODE START
    if (preg_match(Patterns::$EMAIL, $email)) {
        $utente->setUsername($email);
    } else {
        throw new ApplicationException(Error::$EMAIL_NON_VALIDA);
    }

    if (preg_match(Patterns::$NAME_GENERIC, $nome)) {
        $utente->setNome($nome);
    } else {
        throw new ApplicationException(Error::$NOME_NON_VALIDO);
    }
    if (preg_match(Patterns::$NAME_GENERIC, $cognome)) {
        $utente->setCognome($cognome);
    } else {
        throw new ApplicationException(Error::$CONGNOME_NON_VALIDO);
    }
    if ($utente->getTipologia() == "Studente") {
        if ($cdlMatricola == null) {
            throw new ApplicationException(Error::$CDL_NON_TROVATO);
        } else {
            $utente->setCldMatricola($cdlMatricola);
        }
    } elseif ($utente->getTipologia() == "Docente") {
        $utente->setCldMatricola(null);
    }
    if (isset($pass) && strlen($pass) > 0 && strlen($pass) < Config::$MIN_PASSWORD_LEN) {
        throw new ApplicationException(Error::$PASS_CORTA);
    }
    if (strlen($pass) >= Config::$MIN_PASSWORD_LEN) {
        $ident = UtenteModel::createIdentity($email, $pass);
        $utente->setPassword($ident);
    }

    $aModel->updateUtente($matricola, $utente);
}