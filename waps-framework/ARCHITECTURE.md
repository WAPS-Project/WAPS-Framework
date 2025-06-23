# WAPS Framework - Architektur-Optimierung

## Aktuelle Probleme

### 1. Vermischte Verantwortlichkeiten

-   Controller-Ordner enthält sowohl MVC-Controller als auch Core-Klassen
-   Keine klare Trennung zwischen Framework-Core und Anwendungslogik

### 2. Flache Namespace-Struktur

-   Alles unter `Waps\Framework\Controller`
-   Keine logische Gruppierung nach Funktionalität

### 3. Inkonsistente Architektur

-   Spezifische Controller (HomeController, Error404Controller) gehören nicht ins Framework
-   Generische Klassen (BaseController) sind zu minimalistisch

## Optimierte Struktur

```
src/
├── Waps/
│   └── Framework/
│       ├── Core/                    # Framework-Core
│       │   ├── Application.php      # Hauptanwendung
│       │   ├── Container.php        # Dependency Injection Container
│       │   ├── ServiceProvider.php  # Service Provider Interface
│       │   └── Bootstrap.php        # Framework-Bootstrap
│       │
│       ├── Http/                    # HTTP-Layer
│       │   ├── Request.php          # HTTP Request
│       │   ├── Response.php         # HTTP Response
│       │   ├── Router.php           # Routing
│       │   └── Middleware/          # Middleware
│       │       ├── MiddlewareInterface.php
│       │       └── MiddlewareStack.php
│       │
│       ├── Controller/              # MVC Controller
│       │   ├── Controller.php       # Base Controller
│       │   ├── AbstractController.php
│       │   └── ControllerInterface.php
│       │
│       ├── Database/                # Database Layer
│       │   ├── Connection.php
│       │   ├── QueryBuilder.php
│       │   ├── Model.php
│       │   └── Migration/
│       │
│       ├── Session/                 # Session Management
│       │   ├── SessionManager.php
│       │   └── SessionInterface.php
│       │
│       ├── Cache/                   # Caching
│       │   ├── CacheInterface.php
│       │   └── FileCache.php
│       │
│       ├── Logging/                 # Logging
│       │   ├── LoggerInterface.php
│       │   └── FileLogger.php
│       │
│       ├── Validation/              # Validation
│       │   ├── Validator.php
│       │   └── Rule/
│       │
│       ├── Security/                # Security
│       │   ├── Auth.php
│       │   ├── Csrf.php
│       │   └── Hash.php
│       │
│       ├── View/                    # View Layer
│       │   ├── ViewInterface.php
│       │   ├── TwigView.php
│       │   └── Template/
│       │
│       ├── Exception/               # Exceptions
│       │   ├── FrameworkException.php
│       │   ├── HttpException.php
│       │   └── DatabaseException.php
│       │
│       ├── Support/                 # Utilities
│       │   ├── Helper.php
│       │   ├── Config.php
│       │   └── Str.php
│       │
│       └── Console/                 # CLI
│           ├── Command.php
│           ├── CommandInterface.php
│           └── Commands/
│
├── API.php                          # API Entry Point
└── CLI.php                          # CLI Entry Point
```

## Implementierungsplan

### Phase 1: Core-Struktur

1. Dependency Injection Container
2. Service Provider System
3. Bootstrap-Klasse
4. Grundlegende Interfaces

### Phase 2: HTTP-Layer

1. Request/Response-Objekte
2. Router mit Middleware-Support
3. Controller-Basis

### Phase 3: Database & Services

1. Database-Abstraktion
2. Session-Management
3. Caching-System

### Phase 4: Security & Validation

1. Authentication
2. CSRF-Protection
3. Input-Validation

### Phase 5: View & Console

1. View-Engine-Integration
2. CLI-Command-System
3. Template-System

## Vorteile der neuen Struktur

1. **Klare Trennung**: Jede Komponente hat ihre eigene Verantwortlichkeit
2. **Erweiterbarkeit**: Service Provider ermöglichen einfache Erweiterungen
3. **Testbarkeit**: Dependency Injection macht Testing einfacher
4. **Wartbarkeit**: Logische Gruppierung erleichtert die Wartung
5. **PSR-Konformität**: Folgt PSR-Standards für Interoperabilität
