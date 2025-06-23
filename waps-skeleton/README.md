# WAPS Skeleton

Ein Starter-Template für neue WAPS Framework Projekte.

## Features

-   **Modernes PHP Framework**: Basierend auf PHP 8.0+ mit PSR-4 Autoloading
-   **Frontend Build System**: Vite mit TypeScript und SASS
-   **Bootstrap 5**: Responsive UI Framework
-   **FontAwesome**: Icon Library
-   **Plugin System**: Erweiterbare Architektur
-   **Database Integration**: MySQL/MariaDB Support
-   **Twig Templates**: Template Engine

## Installation

```bash
# Repository klonen
git clone <repository-url>
cd waps-skeleton

# PHP Dependencies installieren
composer install

# Node.js Dependencies installieren
npm install

# Frontend Assets kompilieren
npm run build
```

## Entwicklung

### Frontend Development

```bash
# Development Server starten (Watch Mode)
npm run build-w

# Oder manuell kompilieren
npm run build
```

### Deployment

```bash
# Vollständiges Deployment (Sync + Build + Deploy)
npm run deploy

# Nur Konfiguration synchronisieren
npm run sync

# Datei-Watcher für automatisches Rebuilding
npm run watch
```

## Projektstruktur

```
waps-skeleton/
├── public/                 # Web-Root
│   └── index.php          # Entry Point
├── src/
│   ├── config/            # Konfigurationsdateien
│   ├── content/           # Statische Assets (CSS, JS, Images)
│   ├── frontend/          # Source Files (SASS, TypeScript)
│   ├── page/              # Seiten und Templates
│   └── plugin/            # Plugin-Verzeichnis
├── tools/                 # Build und Deployment Tools
├── vendor/                # Composer Dependencies
└── node_modules/          # NPM Dependencies
```

## Konfiguration

Die Hauptkonfiguration befindet sich in `src/config/config.json`. Wichtige Einstellungen:

-   **Database**: MySQL-Verbindungsdaten
-   **Meta**: SEO und Meta-Informationen
-   **Framework**: Framework-spezifische Einstellungen

## Plugins

Plugins können im `src/plugin/` Verzeichnis erstellt werden. Jedes Plugin benötigt:

-   `manifest.php`: Plugin-Metadaten
-   `config/config.json`: Plugin-Konfiguration
-   Hauptklasse (optional)

### Beispiel Plugin

```php
// src/plugin/MyPlugin/MyPlugin.php
namespace Plugin\MyPlugin;

class MyPlugin {
    public function run() {
        echo '<p>Mein Plugin läuft!</p>';
    }
}
```

## Build System

Das Projekt verwendet Vite für das Frontend-Build-System:

-   **TypeScript**: Moderne JavaScript-Entwicklung
-   **SASS**: CSS-Preprocessor
-   **Hot Reload**: Automatisches Neuladen bei Änderungen
-   **Optimization**: Automatische Optimierung für Production

## Lizenz

MIT License - siehe LICENSE Datei für Details.

## Support

-   **Homepage**: https://waps-framework.info
-   **Repository**: https://gitlab.com/waps/framework
-   **Issues**: https://gitlab.com/waps/framework/issues
