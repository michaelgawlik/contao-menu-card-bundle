# Contao Menu Card Bundle

Speisekarten-Verwaltung für Contao 5.7 — eine im Backend redaktionell pflegbare
Datenbasis für Karten (Haupt-/Nebenkarten), Kategorien, Positionen mit
mehreren Preisvarianten, Zusatzstoffen, Allergenen und Vegan/Vegetarisch-
Kennzeichnung. Zweisprachig (DE/EN, erweiterbar auf weitere Sprachen) über
dedizierte Übersetzungstabellen. Ausgabe als Web-Frontend-Modul/Content-
Element sowie als CSV/XML-Export für InDesign Data Merge.

Status: in aktiver Entwicklung. Aktueller Stand deckt das vollständige
Backend-Datenmodell ab (Karten → Kategorien → Positionen → Preise,
Zusatzstoffe/Allergene-Stammdaten, Übersetzungen). Web-Rendering und
Export folgen.

## Installation

In der `composer.json` des Contao-Projekts:

```json
"repositories": [
    { "type": "vcs", "url": "https://github.com/<user>/contao-menu-card-bundle" }
]
```

```bash
composer require diamonds-network/contao-menu-card-bundle:dev-main
php bin/console contao:migrate
php bin/console cache:clear
```

Danach im Backend die Modulgruppe "Speisekarten" den gewünschten
Benutzergruppen zuweisen (System → Benutzergruppen → Module).

## Sprachen

Aktive Sprachen werden über den Parameter `menu_card.languages` in
`config/services.yaml` konfiguriert (Standard: `['de', 'en']`). Eine neue
Sprache hinzuzufügen erfordert keine Schema-Änderung — nur den Parameter
erweitern und die entsprechenden Übersetzungszeilen im Backend anlegen.
