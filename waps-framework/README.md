# WAPS Framework

Ein modernes PHP-Framework mit PSR-4 Autoloading, Composer-Integration und modernen Standards.

## Installation

```bash
composer require waps/framework
```

## Verwendung

### Web-Anwendung

Das Framework stellt die Core-Komponenten bereit. Für eine Web-Anwendung verwenden Sie das `waps-skeleton` Projekt als Basis.

### API-Endpoints

Das Framework stellt einen API-Entry-Point bereit:

```php
// In Ihrer Anwendung
require_once 'vendor/waps/framework/src/API.php';
```

API-Endpoints werden über den `apiMode` Parameter aufgerufen:

```
https://your-domain.com/api.php?apiMode=yourEndpoint
```

### CLI-Befehle

Das Framework stellt einen CLI-Entry-Point bereit:

```bash
php vendor/waps/framework/src/CLI.php
```

Verfügbare CLI-Befehle werden automatisch erkannt und angezeigt.

## Struktur

```
src/
├── Waps/Framework/Controller/  # Core Controller-Klassen
├── core/                       # Core-Komponenten
│   ├── API/                   # API-Endpoints
│   ├── CLI/                   # CLI-Befehle
│   ├── database/              # Database-Komponenten
│   └── loader/                # Loader-Komponenten
├── model/                     # Model-Klassen
├── API.php                    # API-Entry-Point
└── CLI.php                    # CLI-Entry-Point
```

## Features

-   PSR-4 Autoloading
-   Composer-Integration
-   Router-System
-   Request/Response-Handling
-   Error-Handling
-   Session-Management
-   Database-Integration
-   Plugin-System
-   API-Framework
-   CLI-Framework

## Lizenz

Siehe LICENSE-Datei für Details.
