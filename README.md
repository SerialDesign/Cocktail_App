# Corona Blues - Cocktail APP

### Autor: Cyrill Wyrsch
### Version: 1.0.0

--- 

A Web Application specially created against the Corona Blues..
It's a Cocktail APP!
You can search through all kinds of Cocktails by Ingredient or Name
If you have an Account you can mark drinks as favourites, so you always have access to them and don't have to search then again


## Funktionen
---
**User ohne Login**: 
 - Home
 - Search a Drink
 - Search by Ingredient
 - Drink Detail Seite (Unterseite, wenn man über eine Suche auf einen Drink klickt)

**Eingeloggeter User**
 - Home
 - Search a Drink
 - Search by Ingredient
 - Drink Detail Seite (Unterseite, wenn man über eine Suche auf einen Drink klickt)
   --> Eingeloggter User kann mit Klick auf Herz Icon einen Drink favorisieren oder wieder von Favouriten entfernen 
 + Favourite Drinks Seite verfügbar ( = abgespeicherte / favorisierte Drinks in DB)


*****


## Setup und Login

1. **DB IMPORT: Datei /database/import_DB.sql**

2. Zugangssdaten - DB Connection Strings:

    DB Connection Strings in /inc/classes/db.class.php setzen (zuooberst):
    define("DBSERVER", 'localhost');
    define("DBNAME", 'cocktail_app');
    define("DBUSER", 'restrictedUser');
    define("DBPASSWORD", 'ENiIDLuABQSzBH6i!');


3. Die Daten für das Login:

    **User Login** (Zusätzlicher Zugriff auf 'Favourite Drinks' Seite - dem User wurden bereits Favouriten hinzugefügt)
    Email: cyrill@sae.ch
    Passwort: cyrillWyrsch
 
    (Ansonten kann auch ein neuer User erstellt werden auf register.php bzw. über 'Sign Up' Button & dann können Favouriten über die Drink Detail (drink.php) Seite hinzugefügt werden)


*****

###Datenbank
Die Datenbank wurde einfach gehalten (da die meisten Daten über die CocktailDB API abgerufen werden).
Sie besteht aus folgenden Tabellen:
**user** - Alle User abgespeichert mit user_id, username, email, password & reg_time (registered / am schluss wurden alle User entfernt und neue hinzugefügt(siehe user_id's))
**user_list_of_drinks** - User basierte Liste welche für Favouriten von Drinks gebraucht wird (Name wurde generell gehalten, falls die Tabelle später erweitert wird, z.B. list_ID hinzufügen und User kann mehrere Listen führen: Holiday Drinks etc. )

Für die Datenbank Zugriffe wurde **PDO** (weil es sicherer ist als mysqli :) ) mit prepared Statements verwendet 



###Vermerk:
Es wurde die **CocktailDB API** verwendet.
Hierfür wurden Globale API Endpoint Variablen definiert in der Datei:
'assets/jscocktailDB_endpoints_global.js' 

**Github**: Für Code Versionierung wurde Github verwendet






