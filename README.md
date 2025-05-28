# Stylung - Webapp-Projekt

Willkommen bei Stylung – deinem Online-Shop für Streetwear, die genau zu dir passt. Wir stehen für einen simplen und schlichten Stil, der ohne Kompromisse kommt: modern, urban und unverwechselbar.

Unsere Mission ist es, die jüngere Generation mit hochwertigen und authentischen Pieces zu versorgen, die nicht nur Trends folgen, sondern den individuellen Ausdruck unterstreichen. Egal ob Basic oder Statement – bei uns findest du das perfekte Outfit für deinen Streetstyle.

Stylung ist mehr als nur Mode. Es ist ein Lebensgefühl. Minimalistisch, zeitlos, stark.

Entdecke unseren Shop und werde Teil von Stylung.

# Anforderungen

- Sessionverwaltung                             -> erfüllt      
- Login-Logout                                  -> erfüllt       Login via Loginpage und Logout dann über Logout Button auf Profilseite
- automatischer Logout                          -> erfüllt       Egal welche Seite, automatischer Logout nach 5min Inaktivität
- Admin-Bereich mit Useraccount-Verwaltung      -> erfüllt       Profilseite eines Accounts mit Adminrolle (Kann Benutzer "admin" mit PW "admin" verwendet werden)        
- Passwort-Verwaltung                           ->
- Rechte-Verwaltung                             -> erfüllt       Profilseite eines Accounts mit Adminrolle 
- Dateneingabe Client- und Serverseitig prüfen  -> 
- Datensatzmanipulation in SQL-Server           -> erfüllt       Profilseite eines Accounts mit Adminrolle (Produktverwaltung)
- Konfigurationsinformationen via config Datei  ->
- Einbindung jQuery/jQuery UI o. Bootstrap      -> erfüllt
- Dynamisches Laden/Nachladen AJAX              -> erfüllt       Shopseite
- Meldungsfenster / Userbestätigung jQuery UI   -> erfüllt       Kontaktformular auf Kontaktseite
- Datenexport via JSON                          -> erfüllt       Profilseite eines accounts mit Adminrolle (Userexport JSON (mit aktuellem Suchfilter))
- Dynamische, responsive Menüstruktur           -> erfüllt       Navbar

# Restliche Features

## Aufbau

Stylung wird lokal wie xampp gehostet.
Unser Backend läuft auf PHP, Frontend mit HTML, CSS, jQuery und Ajax.
Unsere Datenbank ist eine SQL Datenbank und läuft ebenfalls in XAMPP

## Login Validation

Regex auf Frontendseite
uservalidation auf backend seite
sql injection
xss

## Datenbank
testproducts mit id, name, beschreibung, größe, geschlecht, preis, marke
users
cart

## Shopsite

Zeichenlimit für Produktnamen: 30 Zeichen -> Auch bei Adminpage (Anlegen neuer Produkte)

## Farbschemen

Türkis: #2cc9c2 <br>
Lila: #c580f7 <br>
Schwarztöne: #111;#222;#333

## Kontaktformular

Rückmelde Funktion mit email und Textfield <br>
wenn man aber eingeloggt ist muss man keine email ausfüllen

## Warenkorb

scatch ist im root dir. 2 tabellen pro user <br>
eine für den warenkorb und eine für den Kaufverlauf

## Login / Register

navbar reparieren <br>
gegen sql injections und dashboard für user und admin <br>
admin kriegt einen button dynamisch angezeigt um aufs admin portal zu kommen

## admin portal

produkte aus db löschen und aus pictures ordner <br>
ebenfalls rückmeldungen von Kunden lesen