# E-Note

Diese Website soll als persönliches Todo-List dienen. Nachdem man sich registriert hat, wird man die Möglichkeit haben, Kategorien zu erstellen, die eine ausgewählten Signaturfarbe und Name hat. In diesen Kategorien kann man nun Tasks erstellen. Beim Erstellen von einem Task, wird es mit einer kurzen Beschreibung und ein fälliges Datum vermerkt. Die eingetragenen Daten werden immer in der dazugehörigen Kategorie angezeigt. Sobald man diesen Task erledigt hat, kann man dies jeder Zeit anklicken, um es zu den Completed Tasks zu vershieben. Auf dem All-Categorie Ansicht hat man einen Überblick über sämtliche vorhandene Tasks oder Kategorien, wie z.B welcher Task auf den aktuellen und nächsten Tag fällig ist.


# Zielgruppe

Diese Website hat ein minimalistisches Design, welches die jüngere Altersgruppe zwischen 16-25 Jahre alt besonders anziehen wird. Momentan bietet diese Website nur die englische Sprache und ist somit für die englische Sprachgruppe geeignet. Es ist einfach zu benutzen, Region unabhängig und braucht nicht spezielle Kompetenz im Umgang mit Website. Die Website wird am Morgen (08:00-10:00) und am Abend (19:00-21:00) am häufigsten besucht. Denn am Morgen wäre die beste Zeit, um sich die Tasks anzuschauen, damit man weiss, was an diesem Tag zu erledigen ist. Am Abend wäre die beste Zeit Punkt, zum Kontrollieren, was man an diesem Tag erreicht.

## Farbkonzept
![e-note ERM](README_Images/color_theme.png?raw=true)
schriftart: Roboto (https://fonts.google.com/specimen/Roboto?preview.text_type=custom)<br>
Mit Diesen Farben und Schriftart soll ein minimalistischer Eindruck hinterlassen.

## GUI

### Log-in
![e-note login_Screen](README_Images/login.png?raw=true)

### Sign-up
![e-note signup_Screen](README_Images/signup.png?raw=true)

### Example-Site
![e-note example_site](README_Images/example_site.png?raw=true)

### Specific Category
![e-note specific_category](README_Images/specific category.png?raw=true)

### Add Category
![e-note add_catefory](README_Images/add category.png?raw=true)

### New User Default Look
![e-note empty](README_Images/empty.png?raw=true)

### Profile
![e-note profile](README_Images/profile.png?raw=true)

## ERM:
![e-note color_palette](README_Images/ERM.png?raw=true)

# Installationsanleitung

## Systemanforderungen/Verwendete Technologien

-	Apache Version: 2.4.46
-	PHP-Version: PHP 8.0.2
-	HTML Version: HTML 5
-	CSS-Version: CSS 3
-   JavaScript-Version: V8 8.9.255.20
-	Bootstrap Version: Bootstrap 4
-	Browser Version: Google Chrome (Version 89.0.4389.90)
-	MySQL-Server-Version: 8.0.19
-   Composer-Version: 2.0.11

## Installation

### Apache Konfiguration
Im C:\xampp\apache\conf\extra\httpd-vhosts.conf (Default Path) muss folgende Zeile hinzugefügt werden:<br>
```apache
# [...]

# Wird benötigt um VirtualHosts für alle Requests auf Port 80 zu aktivieren
NameVirtualHost *:80

# [...]

# Eigentliche VHost Konfiguration
<VirtualHost 127.0.0.1>
    # DNS Name auf den der VHost hören soll
    ServerName e-note

    # Ort an dem Das Projekt zu finden ist
    DocumentRoot "C:/xampp/htdocs/e-note/ENote/public"

    # Nochmals
    <Directory "C:/xampp/htdocs/e-note/ENote/public">
        Options Indexes FollowSymLinks
        Options +Includes
        AllowOverride All
        Order allow,deny
        Require all granted
        Allow from All
        DirectoryIndex index.php
    </Directory>
</VirtualHost>
```


### Windows Konfiguration
Im C:\Windows\System32\drivers\etc\hosts (Default Path) muss folgende Zeile hinzugefügt werden:<br>
```
127.0.0.1    e-note
```
[Link zur genauere Anleitung](https://git.bbcag.ch/inf-bl/zh/2020/applikationsentwicklung/andreas/webentwicklung/e-note/-/blob/master/ENote/README.md "MVC Anleitung")<br>

### PHP Konfiguration
1. PHP Web Page als Konfiguration hinzufügen
2. Bei Server Host «e-Note» eingeben

### Datenbank Setup
[schema.sql](https://git.bbcag.ch/inf-bl/zh/2020/applikationsentwicklung/andreas/webentwicklung/e-note/-/blob/master/ENote/data/schema.sql "Schema") in MySQL Workbench ausführen.

# Benutzerhandbuch
Der Benutzer wird als erstes zur Login Seite weitergeleitet. Nachdem Registrieren und Einloggen wird der Benutzer zur Startseite seines Accounts gebracht. Auf dem Navbar ist das Logo und der Home Button zu sehen. Sie führen beide zur Starseite. Ausserdem noch das User-Icon, das ein Dropdown-Menu anzeigt, wenn man mit dem Cursor darüber hovered. Im Dropdown-Menu kann man Einstellung auswählen oder sich abmelden. Auf der Side-Navigation sind zwei default Menupunkte, nämlich «New Category» und «All Category». Unter «New Category» kann man eigene Kategorien erstellen. «All Category» ist die Startseite aller Benutzer, dort werden alle Kategorien der Benutzer angezeigt. Zusätzlich sieht man auch welche Tasks auf den aktuellen oder nächsten Tag fällig sind.
## CRUD
- Der Benutzer kann ein Accout unter Sign-In site erstellen. User Informationen werden in Einstellungen ersichtlich sein. Dort kann man ebenfalls Password oder E-Mail ändern.
- Der Benutzer kann eigene Kategorien unter «New Category» erstellen und löschen kann man diese unter der Kategorie selbst.
- Der Benutzer kann Tasks unter Kategorien erstellen und anschauen. Wenn man sie in der Task-Section anklickt, kann man sie erledigen(update). Wenn man sie in der completed-Section anklickt, kann man sie endgültig löschen(delete).
 
# Fazit 
Mit dem Endergebnis bin ich sehr zufrieden. Für die Planung habe ich mir genug Zeit genommen, sodass ich bei der Umsetzung nicht viel daran ändern musste. Das hat sich definitiv gelohnt. Ich konnte mein Design zu 95% umsetzen und nötige Änderungen unternehmen. Das was entstanden ist, entspricht meiner Vorstellung. Ganz am Anfang war der Umgang mit MVC eine Schwierigkeit. Es dauerte etwas Zeit, bis ich es im Griff hatte. Danach bin ich aber schnell vorwärtsgekommen. PHP war einfach anzuwenden, denn es von der Syntax her viel nach JAVA ähnelt. Für mich war es besonders interessant, mich mit der Security Seite einer Website zu beschäftigen. Ich konnte vieles lernen, beispielsweise wie man eine Website gegen SQL-Injections oder Cross-Site Scripting schützt. Viele Validierungen brauchte meine Website auch, den der User per URL vieles machen konnte, was er nicht können sollte (z.B Random Value als Query-String mitgeben). Beim Programmieren der Validierung wurde meine Website temporär zerstört, was eine mühsame Sache war. Nebstdem lief alles gut beim Projekt. Alle Muss-Ziele konnte ich umsetzten, die 2 Kann-Ziele konnte ich leider wegen der Zeit nicht umsetzen.

## Link to Issues:
[GitLab Issues](https://git.bbcag.ch/inf-bl/zh/2020/applikationsentwicklung/andreas/webentwicklung/e-note/-/issues?scope=all&utf8=%E2%9C%93&state=all "GitHub Issues")

## Author

Oliver Achermann
