<?php
// Beispiel: Session verwenden
session_start();
if (!isset($_SESSION['demo'])) {
    $_SESSION['demo'] = 'Hallo Session!';
}
echo '<p>Session-Wert: ' . $_SESSION['demo'] . '</p>';
