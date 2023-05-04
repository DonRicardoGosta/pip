Feladat:
•	Készíts natív PHP használatával egy C.R.U.D. végpontotokat az alábbiak szerint
o	POST metódusra létrehozunk a request bodyban kapott JSON objektum alapján egy detour rekordot
o	PUT metódusra frissítjük egy már adatbázisban létező detour rekord értékeit
o	DELETE metódusra az URL-ben megadott parcelnumber paraméter szerinti összes adatbázis rekordot töröljük a detour táblából
o	GET metódusra az URL-ben megadott parcelnumber paraméter szerinti időrendben legutolsó detour rekordot adjuk vissza
•	A requestekben küldött JSON egyszerre több detour adatait is tartalmazhatja
o	Egy detour az alábbi tulajdonságokkal rendelkezik, mindegyik kötelezően kitöltendő:
	parcel_number, type, delivery_day
•	Amennyiben a beküldött JSON nem felel meg a validálásnak, a végpont kizárólag a megfelelő http státusz küldésével válaszoljon a kliensnek
 
•	Az adatokat PostgreSQL adatbázisban tárold
o	A mezők a detour táblában a következők:
	parcel_number, type, delivery_day, insert_date
	A mezők típusait és hosszát szabadon meghatározhatod
•	A fenti összes endpointhoz készíts Postmanben teszt kéréseket 1-1 pozitív és negatív esetet is lefedve, ahol ez értelmezhető
 
•	Készíts egy perl scriptet, amely
o	Futási paraméterként kap egy csomagszámot, detour típust, kiszállítási napot, műveletet (create, update, delete)
o	A kapott paraméterek alapján állítson össze egy JSON objektumot és a kapott művelet paraméternek megfelelően küldje el a fent elkészült endpointok közül a megfelelőre
o	A requestre kapott válasz írja ki konzolba
 
•	A fenti kódokat dockerben vagy bármilyen, arra alkalmas környezetben tudod tesztelni, nincs megkötés
•	Az elkészült kódokat egy repóban, külön mappákba kell felpusholni

