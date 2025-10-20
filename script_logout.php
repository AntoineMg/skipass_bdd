<?php
require_once __DIR__ . '/config.php';
session_start();

// Vider les données de session
$_SESSION = [];


// TODO
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

echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$cssFile\">";
echo "<a href=\"index.php\">Menu</a>";

echo "</div>";

exit;
