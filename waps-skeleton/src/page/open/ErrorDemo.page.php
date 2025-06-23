<?php
// Beispiel: Fehlerbehandlung
try {
    throw new Exception('Dies ist ein Beispiel-Fehler!');
} catch (Exception $e) {
    echo '<p>Fehler: ' . $e->getMessage() . '</p>';
}
