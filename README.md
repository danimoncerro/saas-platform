# saas-platform

SaaS Platform
🚀 Descriere:
Această platformă SaaS permite utilizatorilor să își creeze propriile magazine online, oferind atât o interfață de administrare pentru abonații SaaS (proprietarii magazinelor), cât și un sistem de autentificare pentru clienții magazinelor.

🛠️ Tehnologii utilizate:
PHP 8+
MySQL (pentru stocarea datelor)
Composer (pentru gestionarea dependențelor)
XAMPP (pentru rularea locală)
Bootstrap (pentru interfață)
Git & GitHub (pentru controlul versiunilor)
📂 Structura proiectului:
app/ → Conține logica aplicației (controlere, modele, view-uri).
public/ → Conține fișiere accesibile publicului (index.php, CSS, JS).
config/ → Configurațiile bazei de date și ale aplicației.
routes/ → Definirea rutelor aplicației.
views/ → Template-uri HTML pentru interfața utilizatorilor.
🚀 Instalare și rulare locală:
Clonează repository-ul:
bash
Copy
Edit
git clone https://github.com/danimoncerro/saas-platform.git
cd saas-platform
Instalează dependențele:
bash
Copy
Edit
composer install
Importă baza de date în MySQL:
Găsești fișierul saas_platform.sql în repository.
Rulează-l în phpMyAdmin sau MySQL CLI.
Configurare .env:
Creează un fișier .env și adaugă detalii despre baza de date:
ini
Copy
Edit
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=saas_platform
Rulează serverul local:
bash
Copy
Edit
php -S localhost:8000 -t public
Accesează platforma în browser:
arduino
Copy
Edit
http://localhost:8000
🔑 Funcționalități principale:
✅ Autentificare separată pentru adminii SaaS și clienții magazinelor
✅ Creare și administrare magazine online
✅ Gestionare utilizatori și comenzi
✅ Sesiuni securizate pentru utilizatori
✅ Dashboard personalizat pentru fiecare utilizator

⚠️ Notă importantă:
Asigură-te că fișierul .env NU este inclus în GitHub (adaugă-l în .gitignore).
Dacă întâmpini probleme, verifică logurile din php_error.log.
📬 Contribuții:
Orice contribuție este binevenită! Poți face un fork al repository-ului și trimite un pull request.

💡 Dacă ai întrebări sau feedback, deschide un issue pe GitHub!

🔗 Repo GitHub:
https://github.com/danimoncerro/saas-platform

test1 dn VCS
test2 din GitHub

Test modificare manuală pentru GitHub Actions

Sunt curios daca merge.
