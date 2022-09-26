# ScreenFlow
Ki ne szeretne sorozatokat nézni? Egyetemistaként azonban talán erre kevesebb idő jut, mint amennyit szeretnénk, így mire legközelebb a képernyő elé jutunk, már el is felejtettük, hogy hol tartottunk... kivéve, ha van egy olyan webes alkalmazásunk, ahol követni tudjuk a sorozatnézési folyamatot. Pontosan egy ilyen oldal a ScreenFlow.

## Főoldal
- A listaoldalon, avagy a főoldalon statikus szöveggel megjelenik a cím és egy rövid ismertetés az oldalról.
- A főoldal elérhető azonosítatlan felhasználók számára is, akik szabadon tudják böngészni az itt megjelenő tartalmakat.
- Az oldalon kilistázva vannak a rendszerben létező sorozatok.
- Minden sorozathoz tartozik egy link, amellyel az adott sorozat részletező oldalára lehet lépni.
![Main page](https://github.com/ozoli99/ScreenFlow/blob/main/Media/ScreenFlow.png)
![Main page](https://github.com/ozoli99/ScreenFlow/blob/main/Media/ScreenFlow2.png)
## Részletező oldal
- A részletező oldalon megjelennek az adott sorozathoz kapcsolódó információk, pl. címe, első sugárzás éve, epizódok száma, leírása, stb.
- A sorozat minden epizódjához tartozik egy-egy dátum és egy néhány mondatos leírás a cselekményről.
- Bejelentkezett felhasználóknak az egyes epizódoknál az is látható, hogy megnézték-e a sorozat adott részét. Amennyiben még nem, akkor egy gomb segítségével megtekintettnek jelölhetik a következő epizódot.
![Details page](https://github.com/ozoli99/ScreenFlow/blob/main/Media/ScreenFlow-StrangerThings.png)
![Details page](https://github.com/ozoli99/ScreenFlow/blob/main/Media/ScreenFlow-StrangerThings2.png)
![Login page](https://github.com/ozoli99/ScreenFlow/blob/main/Media/ScreenFlow-Loggedin.png)
## Hitelesítési oldalak
- A főoldalról van lehetőség elérni a bejelentkező és regisztrációs oldalt.
- Regisztráció során meg kell adni a felhasználónevet, egy email címet és a jelszót kétszer. Mindegyik megadása kötelező, az email címnek email formátumúnak kell lennie, a kétszer beírt jelszóknak pedig egyeznie kell. Regisztrációs hiba esetén hibaüzenetek jelennek meg. Az űrlap állapottartó. Sikeres regisztráció után a bejelentkező oldalra kerülünk.
- A bejelentkezés során a felhasználói névvel és jelszóval tudjuk azonosítani magunkat. A bejelentkezés során előforduló hibák az űrlap fölött vannak jelezve. Sikeres belépés után a főoldalra kerülünk
![Login page](https://github.com/ozoli99/ScreenFlow/blob/main/Media/ScreenFlow-Login.png)
## Admin funkciók
- Van egy speciális felhasználó, admin néven és admin jelszóval, aki a következő funkciókat éri el:
- Fel tud venni új sorozatot, illetve a meglévő sorozatokhoz hozzá tud adni új epizódot.
- Szerkeszteni tudja a már felvett sorozatok és epizódok adatait.
- Törölni tudja a teljes sorozatokat vagy az egyes epizódokat.

## Adatok
- A feladatban háromféle adat van: sorozatok, epizódok és felhasználók.
- A sorozatoknál tárolva van a sorozat címe, bemutatásának éve (1900 és 2022 közötti egész szám), egy rövid ismertető és a borítóképére mutató érvényes URL. Mentéskor vagy módosításkor ellenőrizve van, hogy minden mező a feltételeknek megfelelően kitöltésre került-e.
- Az epizódoknál tárolva van az epizód címe, egy rövid leírás, a sugárzás dátuma és az epizód értékelése. Az epizódokat vetítési sorrendben rögzítjük, így a dátumokkal számolni nem kell, minden dátum egyszerű szöveges adatnak tekinthető. Az értékelés mindig egy 0 és 10 közötti lebegőpontos szám. Mentéskor vagy módosításkor ellenőrizve van, hogy minden mező a feltételeknek megfelelően kitöltésre került-e.
- A felhasználóknak három kötelező adata van: felhasználónév, email cím, jelszó. Emellett tárolva van még, hogy az adott felhasználó mely sorozatból hány epizódot tekintett meg.
