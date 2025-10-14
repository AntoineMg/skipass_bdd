<?php
/*
require_once __DIR__ . '/config.php';


    echo "Employé " . $first_name . " " .$last_name . " déconnecté";

session_destroy();

echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">";
echo "<a href=\"index.html\">Menu</a>";

echo "</div>";

exit;
*/
// logout.php - version simple et fiable

session_start();

// Vider les données de session
$_SESSION = [];

require_once __DIR__ . '/config.php';

if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}


session_destroy();

echo "<div class=\"message-container\">";
echo "Vous êtes déconnecté.<br>";

echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">";
echo "<a href=\"index.html\">Menu</a>";

echo "</div>";

exit;
