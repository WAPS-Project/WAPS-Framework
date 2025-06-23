<?php
/** @var string|null $userId */
?>
<h1>User-Seite</h1>
<?php if ($userId): ?>
    <p>User-ID: <?php echo htmlspecialchars($userId, ENT_QUOTES, 'UTF-8'); ?></p>
<?php else: ?>
    <p>Keine User-ID angegeben.</p>
<?php endif; ?>
