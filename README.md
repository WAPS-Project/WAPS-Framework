# WAPS Framework Repository

Dieses Repository enthält das WAPS Framework und das zugehörige Skeleton-Projekt.

## Struktur

```
├── waps-framework/     # Framework-Paket (Composer Package)
├── waps-skeleton/      # Projekt-Skeleton (Starter Template)
├── LICENSE            # Lizenz-Datei
├── CHANGELOG.md       # Änderungsprotokoll
├── CONTRIBUTING.md    # Beitragsrichtlinien
└── .gitignore         # Git-Ignore-Datei
```

## Framework-Paket (`waps-framework/`)

Das WAPS Framework als eigenständiges Composer-Paket mit:

-   PSR-4 Autoloading
-   Core-Controller und Router
-   API- und CLI-Framework
-   Database-Integration
-   Plugin-System
-   Tests und Dokumentation

**Installation:**

```bash
composer require waps/framework
```

## Skeleton-Projekt (`waps-skeleton/`)

Ein Starter-Template für neue WAPS-Projekte mit:

-   Beispiel-Seiten und Controller
-   Plugin-Beispiele
-   Frontend-Assets (SASS, TypeScript)
-   Build-Tools (Vite)
-   Deployment-Skripte

**Verwendung:**

```bash
# Projekt erstellen
composer create-project waps/skeleton my-project

# Oder manuell klonen und installieren
cd waps-skeleton
composer install
npm install
```

## Entwicklung

### Framework weiterentwickeln:

```bash
cd waps-framework
composer install
./vendor/bin/phpunit
```

### Skeleton anpassen:

```bash
cd waps-skeleton
composer install
npm install
npm run dev  # Frontend-Assets kompilieren
```

## Lizenz

Siehe LICENSE-Datei für Details.

## Beitragen

Siehe CONTRIBUTING.md für Richtlinien zur Mitarbeit.
