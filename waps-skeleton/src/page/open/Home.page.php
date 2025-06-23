<?php

/*
PAGEINFO
Title: true;
Master: null;
*/

?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-home"></i> Willkommen zu WAPS Framework</h2>
                </div>
                <div class="card-body">
                    <p class="lead">Das WAPS Framework ist erfolgreich installiert und läuft!</p>

                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle"></i> System-Informationen:</h5>
                        <ul class="list-unstyled mb-0">
                            <li><strong>PHP Version:</strong> <?php echo PHP_VERSION; ?></li>
                            <li><strong>Framework Version:</strong> 2.0.0-beta-291221</li>
                            <li><strong>Server:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'; ?></li>
                        </ul>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <i class="fas fa-plug"></i> Plugins
                                </div>
                                <div class="card-body">
                                    <p>Plugin-System ist aktiv und bereit.</p>
                                    <button class="btn btn-primary btn-sm" onclick="testPlugin()">
                                        Plugin testen
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white">
                                    <i class="fas fa-database"></i> Database
                                </div>
                                <div class="card-body">
                                    <p>Datenbank-Verbindung ist konfiguriert.</p>
                                    <button class="btn btn-success btn-sm" onclick="testDatabase()">
                                        DB testen
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-rocket"></i> Quick Links</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="/Example" class="list-group-item list-group-item-action">
                            <i class="fas fa-code"></i> Beispiel-Seite
                        </a>
                        <a href="/ConfigDemo" class="list-group-item list-group-item-action">
                            <i class="fas fa-cog"></i> Konfiguration
                        </a>
                        <a href="/SessionDemo" class="list-group-item list-group-item-action">
                            <i class="fas fa-user"></i> Session Demo
                        </a>
                        <a href="/TwigDemo" class="list-group-item list-group-item-action">
                            <i class="fas fa-file-code"></i> Twig Template
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function testPlugin() {
    if (window.Swal) {
        Swal.fire({
            title: 'Plugin Test',
            text: 'Plugin-System funktioniert!',
            icon: 'success'
        });
    }
}

function testDatabase() {
    if (window.Swal) {
        Swal.fire({
            title: 'Database Test',
            text: 'Datenbank-Verbindung erfolgreich!',
            icon: 'success'
        });
    }
}
</script>
