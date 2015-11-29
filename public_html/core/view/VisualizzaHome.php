<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:19
 */
include_once BEAN_DIR . "Utente.php";

?>
<?php
if (!isset($_SESSION['loggedin'])) {
    echo "<h1 align='center'>NON TI CONOSCO!</h1>";
    echo "<center><br><img src='http://icons.iconarchive.com/icons/artdesigner/emoticons/128/angry-icon.png'/><br>";
    echo "<a href='/auth'>Login/Registrazione</a>";
} else {
    /** @var Utente $user */
    $user = $_SESSION['user'];
    echo "<h1 align='center'>CIAO, " . $user->getNome() . "</h1>";
    echo "<center><br><img src='http://icons.iconarchive.com/icons/artdesigner/emoticons/128/heeeeyyy-icon.png'/><br>";
    echo "<a href='/auth/logout'>Logout</a>";
}
?>
