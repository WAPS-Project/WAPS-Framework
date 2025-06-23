<?php

use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\Main;

try {
    // Initialisiere die Anwendung
    include 'core/loader/UI.loader.php';

    // Bereite die Rendering-Daten vor
    $language = defined('LANGUAGE') ? LANGUAGE : 'en';
} catch (\Throwable $e) {
    // Kritischer Fehler beim Laden der Core-Komponenten
    die('Kritischer Fehler: ' . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($language, ENT_QUOTES, 'UTF-8'); ?>" dir="ltr">
<?php
try {
    include 'page/view/head.php';
} catch (\Throwable $e) {
    ErrorHandler::FireError('Template Error', 'Could not load head template: ' . $e->getMessage());
}
?>

<body>
	<?php
	try {
	    include 'page/view/header.php';
	} catch (\Throwable $e) {
	    ErrorHandler::FireError('Template Error', 'Could not load header template: ' . $e->getMessage());
	}

	try {
		Main::main($pagePath, $pageName, $pageMap);
	} catch (JsonException $e) {
		ErrorHandler::FireError($e->getCode(), $e->getMessage());
	} catch (\Throwable $e) {
		ErrorHandler::FireError('Unhandled Exception', $e->getMessage());
	}

	try {
	    include 'page/view/footer.php';
	} catch (\Throwable $e) {
	    ErrorHandler::FireError('Template Error', 'Could not load footer template: ' . $e->getMessage());
	}
	?>
</body>

</html>
