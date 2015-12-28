<?php
/**
 * Gestione registrazione
 *
 * @author Sergio Shevchenko
 * @version 1.1
 * @since 25/11/15
 */
include_once MODEL_DIR . "UtenteModel.php";
try {
    $user = register($_POST['matricola'], $_POST['email'], $_POST['password'],
        "Studente", $_POST['name'], $_POST['surname'], $_POST['cdl_matricola']);
    $_SESSION['loggedin'] = true;
    $_SESSION['user'] = $user;

    switch (@$user->getTipologia()) {
        case 'Docente':
            $redirect = "/docente";
            break;
        case 'Studente':
            $redirect = "/studente";
            break;
        case 'Admin':
            $redirect = "/admin";
            break;
        default:
            $redirect = "/";
    }
    echo json_encode(array("status" => true, 'redirect' => $redirect));
} catch (IllegalArgumentException $ex) {
    echo json_encode(array("status" => false, "error" => $ex->getMessage()));
} catch (ApplicationException $ex) {
    Logger::error("Registrazione fallita ex=" . $ex);
    if ($ex->getMessage() == Error::$MATRICOLA_ESISTE) {
        echo json_encode(array("status" => false, "error" => Error::$MATRICOLA_ESISTE));
    } else
        echo json_encode(array("status" => false, "error" => "Errore interno del sistema, riprova più tardi"));
}

/**
 * @param $matricola
 * @param $email
 * @param $password
 * @param $tipologia
 * @param $nome
 * @param $cognome
 * @param $cdl
 * @return Utente registrato nel db
 * @throws IllegalArgumentException nel caso se i parametri sono errati
 * @throws RuntimeException violati constraint nel db (utente esistente, matricola duplicata, cdl inesistente)
 *
 */
function register($matricola, $email, $password, $tipologia, $nome, $cognome, $cdl) {
    if (!preg_match(Patterns::$EMAIL, $email)) {
        throw new IllegalArgumentException("Email non valido");
    }
    if (!preg_match(Patterns::$MATRICOLA, $matricola)) {
        throw new IllegalArgumentException("Matricola non valida");
    }
    if (strlen($password) < Config::$MIN_PASSWORD_LEN) {
        throw new IllegalArgumentException("Password è troppo corta");
    }
    if (!in_array($tipologia, Config::$TIPI_UTENTE) || $tipologia == "admin") {
        throw new IllegalArgumentException("Tipo utente errato");
    }
    if (!preg_match(Patterns::$NAME_GENERIC, $nome)) {
        throw new IllegalArgumentException("Nome assente oppure errato");
    }
    if (!preg_match(Patterns::$NAME_GENERIC, $cognome)) {
        throw new IllegalArgumentException("Cognome assente oppure errato");
    }
    if (!preg_match(Patterns::$MATRICOLA, $cdl) && $tipologia == "Studente") {
        throw new IllegalArgumentException("Cdl sbagliato o assente");
    }
    $accModel = new UtenteModel();
    return $accModel->createUtente(new Utente($matricola, $email, $password, $tipologia, $nome, $cognome, $cdl));
}