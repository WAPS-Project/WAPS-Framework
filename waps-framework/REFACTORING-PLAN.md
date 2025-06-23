# WAPS Framework - Refactoring-Plan

## Sofortige Verbesserungen (Phase 1)

### 1. Spezifische Controller entfernen

Diese Controller gehören nicht ins Framework, sondern ins Skeleton:

**Zu entfernende Controller:**

-   `HomeController.php`
-   `Error404Controller.php`
-   `Error500Controller.php`
-   `ExampleController.php`
-   `GallerytestController.php`
-   `SettingsController.php`
-   `LoginController.php`
-   `ImpressumController.php`
-   `TermsofuseController.php`
-   `UserController.php`
-   `LchoiceController.php`
-   `LgController.php`
-   `PgController.php`

### 2. Core-Klassen neu organisieren

Diese Klassen gehören in spezifische Namespaces:

**HTTP-Layer (`Waps\Framework\Http`):**

-   `Request.php` → `Http\Request.php`
-   `Response.php` → `Http\Response.php`
-   `Router.php` → `Http\Router.php`

**Core (`Waps\Framework\Core`):**

-   `ErrorHandler.php` → `Core\ErrorHandler.php`
-   `Main.php` → `Core\Application.php`
-   `StartUp.php` → `Core\Bootstrap.php`

**Database (`Waps\Framework\Database`):**

-   `DatabaseHandler.php` → `Database\Connection.php`
-   `Migration.php` → `Database\Migration\Migration.php`

**Session (`Waps\Framework\Session`):**

-   `SessionTool.php` → `Session\SessionManager.php`

**Support (`Waps\Framework\Support`):**

-   `Helper.php` → `Support\Helper.php`
-   `ConfigLoader.php` → `Support\Config.php`
-   `DatatypeConverter.php` → `Support\DataConverter.php`

**Console (`Waps\Framework\Console`):**

-   `Cli.php` → `Console\Command.php`
-   `Build.php` → `Console\Commands\BuildCommand.php`

**View (`Waps\Framework\View`):**

-   `BaseController.php` → `Controller\Controller.php` (überarbeitet)

### 3. Neue Basis-Struktur erstellen

```
src/Waps/Framework/
├── Core/
│   ├── Application.php
│   ├── Bootstrap.php
│   └── ErrorHandler.php
├── Http/
│   ├── Request.php
│   ├── Response.php
│   └── Router.php
├── Controller/
│   ├── Controller.php
│   └── ControllerInterface.php
├── Database/
│   ├── Connection.php
│   └── Migration/
├── Session/
│   └── SessionManager.php
├── Support/
│   ├── Helper.php
│   └── Config.php
├── Console/
│   ├── Command.php
│   └── Commands/
└── View/
    └── ViewInterface.php
```

## Konkrete Schritte

### Schritt 1: Namespaces erstellen

```bash
mkdir -p src/Waps/Framework/{Core,Http,Controller,Database,Session,Support,Console,View}
```

### Schritt 2: Klassen verschieben

```bash
# HTTP-Layer
mv src/Waps/Framework/Controller/Request.php src/Waps/Framework/Http/
mv src/Waps/Framework/Controller/Response.php src/Waps/Framework/Http/
mv src/Waps/Framework/Controller/Router.php src/Waps/Framework/Http/

# Core
mv src/Waps/Framework/Controller/ErrorHandler.php src/Waps/Framework/Core/
mv src/Waps/Framework/Controller/Main.php src/Waps/Framework/Core/Application.php
mv src/Waps/Framework/Controller/StartUp.php src/Waps/Framework/Core/Bootstrap.php

# Database
mv src/Waps/Framework/Controller/DatabaseHandler.php src/Waps/Framework/Database/Connection.php
mv src/Waps/Framework/Controller/Migration.php src/Waps/Framework/Database/Migration.php

# Session
mv src/Waps/Framework/Controller/SessionTool.php src/Waps/Framework/Session/SessionManager.php

# Support
mv src/Waps/Framework/Controller/Helper.php src/Waps/Framework/Support/
mv src/Waps/Framework/Controller/ConfigLoader.php src/Waps/Framework/Support/Config.php
mv src/Waps/Framework/Controller/DatatypeConverter.php src/Waps/Framework/Support/DataConverter.php

# Console
mv src/Waps/Framework/Controller/Cli.php src/Waps/Framework/Console/Command.php
mv src/Waps/Framework/Controller/Build.php src/Waps/Framework/Console/Commands/BuildCommand.php
```

### Schritt 3: Namespaces aktualisieren

Alle verschobenen Klassen müssen ihre Namespaces entsprechend anpassen.

### Schritt 4: Composer autoload aktualisieren

```json
{
	"autoload": {
		"psr-4": {
			"Waps\\Framework\\": "src/Waps/Framework/"
		}
	}
}
```

## Vorteile der Umstrukturierung

1. **Klare Verantwortlichkeiten**: Jede Klasse hat einen logischen Platz
2. **Bessere Wartbarkeit**: Ähnliche Funktionalitäten sind gruppiert
3. **Einfachere Erweiterung**: Neue Features können in passende Namespaces
4. **PSR-Konformität**: Folgt modernen PHP-Standards
5. **Framework vs. Anwendung**: Klare Trennung zwischen Framework-Core und Anwendungslogik
