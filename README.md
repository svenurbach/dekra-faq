# Dekra-FAQ
Die Aufgabe war eine FAQ-Landingpage mit Backend für Verwaltungsaufgaben umzusetzen. Verwendete Technologien sind Laravel, Vue und Inertia.

## Lokale Installation
Nach dem klonen/herunterladen des Projektes folgende Schritte durchführen:

### Datenbank konfigurieren
1. MySQL starten
1. `.env.example` in `.env` umbenennen (`cp .env.example .env`)
1. Datenbank Einstellungen in der `.env` hinterlegen
1. `php artisan key:generate` ausführen

### Abhängigkeiten installieren
1. `composer install` ausführen
1. `npm install` ausführen

### Datenbank befüllen
1. `php artisan migrate` ausführen
1. `php artisan db:seed` ausführen

### Laravel starten
`php artisan serve`

### Frontend starten
`npm run dev`

### Projekt aufrufen
Wenn alles läuft. kann das Projekt unter `http://127.0.0.1:8000` im Browser aufgerufen werden.
Es gibt zwei User:
* Admin mit Verwaltungsrechten (Login: admin, Passwort: admin)
* Benutzer ohne Verwaltungsrechte (Login: test, Passwort: test)

## Extra hinzugefügte Abhängigkeiten
* Um die mitgelierferten SVG-Dateien besser verarbeiten zu können wurde der **vite-svg-loader** installiert
* Um benannte Routen von Laravel unter Vue ansteuern zu können wurde **Ziggy** installiert
