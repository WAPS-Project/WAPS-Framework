<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Waps\Framework\Controller\ErrorHandler;
use Waps\Framework\Controller\Router;

try {
    // Initialisiere die Anwendung
    // Hier ggf. weitere Projekt-Initialisierung
    $language = defined('LANGUAGE') ? LANGUAGE : 'en';
} catch (\Throwable $e) {
    die('Kritischer Fehler: ' . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($language, ENT_QUOTES, 'UTF-8'); ?>" dir="ltr">
<?php
try {
    include __DIR__ . '/../src/page/view/head.php';
} catch (\Throwable $e) {
    ErrorHandler::FireError('Template Error', 'Could not load head template: ' . $e->getMessage());
}
?>
<body>
<?php
try {
    include __DIR__ . '/../src/page/view/header.php';
} catch (\Throwable $e) {
    ErrorHandler::FireError('Template Error', 'Could not load header template: ' . $e->getMessage());
}

$router = new Router();
$router->route();

try {
    include __DIR__ . '/../src/page/view/footer.php';
} catch (\Throwable $e) {
    ErrorHandler::FireError('Template Error', 'Could not load footer template: ' . $e->getMessage());
}
?>
</body>
</html>
