<?php
// Beispiel: Zugriff auf Request-Parameter
if (isset($_GET['foo'])) {
    echo '<p>GET-Parameter foo: ' . htmlspecialchars($_GET['foo']) . '</p>';
} else {
    echo '<p>Kein GET-Parameter foo gesetzt.</p>';
}
