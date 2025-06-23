# WAPS Skeleton

Dies ist das offizielle Projekt-Skeleton für das WAPS PHP-Framework.

## Schnellstart

1. **Framework installieren**

    Stelle sicher, dass das Framework-Paket (`waps/framework`) über Composer verfügbar ist (z.B. via Packagist oder VCS).

2. **Projekt initialisieren**

    ```bash
    composer install
    ```

3. **Lokalen Webserver starten**

    ```bash
    php -S localhost:8000 -t public
    ```

    oder mit Apache/Nginx das `public/`-Verzeichnis als Webroot einrichten.

4. **Projektstruktur**

    - `public/index.php` – Einstiegspunkt (Front-Controller)
    - `src/config/config.json` – Konfiguration
    - `src/page/` – Seiten (open, static, view)
    - `src/plugin/` – Plugins (Beispiel: ExamplePlugin)
    - `src/frontend/sass/` – SASS-Quellcode (Beispiel: `main.sass`)
    - `src/frontend/ts/` – TypeScript-Quellcode (Beispiel: `index.ts`)
    - `templates/` – Twig-Templates

5. **Eigene Seiten und Controller**

    Lege neue Seiten in `src/page/open/` oder Controller im Framework an.

## Beispielseiten für Features

-   **Plugin-Demo:** `src/page/open/Example.page.php`
-   **Twig-Demo:** `src/page/open/TwigDemo.page.php`
-   **Request-Demo:** `src/page/open/RequestDemo.page.php`
-   **Response-Demo:** `src/page/open/ResponseDemo.page.php`
-   **Config-Demo:** `src/page/open/ConfigDemo.page.php`
-   **Session-Demo:** `src/page/open/SessionDemo.page.php`
-   **Error-Demo:** `src/page/open/ErrorDemo.page.php`

## Plugins

-   Beispiel-Plugin: `src/plugin/ExamplePlugin/`
    -   `ExamplePlugin.php` – Plugin-Klasse
    -   `manifest.php` – Plugin-Metadaten
    -   `config/config.json` – Plugin-Konfiguration

Plugins können einfach in das Verzeichnis `src/plugin/` gelegt werden und von Seiten oder dem Framework geladen werden.

## Frontend (SASS & TypeScript)

-   **SASS:**
    -   Beispiel: `src/frontend/sass/main.sass`
    -   Kompiliere SASS zu CSS (z.B. mit `sass src/frontend/sass/main.sass public/content/css/main.css`)
-   **TypeScript:**
    -   Beispiel: `src/frontend/ts/index.ts`
    -   Kompiliere TypeScript zu JavaScript (z.B. mit `tsc src/frontend/ts/index.ts --outDir public/content/js`)

## Hinweise

-   Das Framework wird per Composer als Abhängigkeit geladen.
-   Passe die Konfiguration und Views nach Bedarf an.

---

**Viel Spaß mit WAPS!**
