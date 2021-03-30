--FUNKCJE--

CREATE OR REPLACE FUNCTION dodaj_zwierzę(varchar, varchar, varchar, varchar,id int ) RETURNS void  AS
    $$
    	WITH ins1 AS (
   		INSERT INTO projekt.rasy(nazwa, wielkość)
   		VALUES ($3, $4)
   		RETURNING id_rasa
   		)
   		, ins2 AS (
   		INSERT INTO projekt.gatunki (id_rasa, nazwa)
   		SELECT id_rasa, $2 FROM ins1
   		RETURNING id_rasa
   		)
		INSERT INTO projekt.zwierzęta (id_rasa, imię, id_właściciel)
		SELECT id_rasa, $1, id FROM ins2;
    $$
LANGUAGE 'sql';


CREATE OR REPLACE FUNCTION dodaj_wizyte_wet(varchar, int) RETURNS void  AS
    $$
    	WITH ins1 AS (
   		INSERT INTO projekt.wizyta(nazwa)
   		VALUES ($1)
   		RETURNING id_wizyta
   		)
   		INSERT INTO projekt.rodzaj (id_wizyta, cena)
   		SELECT id_wizyta, $2 FROM ins1;

    $$
LANGUAGE 'sql';


CREATE OR REPLACE FUNCTION dodaj_szczepienie(varchar, varchar, varchar, timestamp ) RETURNS void  AS $$
DECLARE
    id integer;
    kursor  REFCURSOR;
BEGIN
    OPEN kursor FOR SELECT * FROM projekt.znajdz_zwierze($1,$2);
    FETCH FIRST FROM kursor INTO id;
    WITH ins1 AS (
   		INSERT INTO projekt.szczepienia(nazwa)
   		VALUES ($3)
   		RETURNING id_szczepienie
   		)
		INSERT INTO projekt.Zwierzę_Szczepienie (id_zwierzę, id_szczepienie, data)
		SELECT id, id_szczepienie, $4 FROM ins1;
END;
$$
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION dodaj_wizyte_wlasc(varchar, varchar, int , int, varchar, timestamp,id_user int,varchar) RETURNS void  AS $$
DECLARE
    id_zw integer;
    id_wiz integer;
    id_wet integer;
    id_gab integer;

BEGIN
		id_zw := id_zwierzę
		FROM projekt.zwierzęta z JOIN projekt.właściciele w on w.id_właściciel = z.id_właściciel
		WHERE z.imię = $1 AND w.id_właściciel = id_user;

        id_wiz := id_wizyta
		FROM projekt.wizyta wiz WHERE wiz.nazwa = $5;

        id_wet := id_weterynarz
		FROM projekt.weterynarze w WHERE w.nazwisko = $2;

        id_gab := id_gabinet
		FROM projekt.gabinety g JOIN projekt.weterynarze w on w.id_weterynarz = g.id_weterynarz
        JOIN projekt.budynki b on b.id_budynek = g.id_budynek
		WHERE g.numer_gabinetu = $4 AND g.id_budynek = $3;

		INSERT INTO projekt.Zwierzę_wizyta (id_zwierzę, id_wizyta, id_weterynarz, data, id_gabinet)
		VALUES (id_zw, id_wiz, id_wet, $6, id_gab);

        	WITH ins1 AS (
            INSERT INTO projekt.dolegliwości(nazwa)
            VALUES ($8)
            RETURNING id_dolegliwość
            )
            INSERT INTO projekt.Zwierzę_Dolegliwość (id_zwierzę, id_dolegliwość)
            SELECT id_zw, id_dolegliwość FROM ins1;


END;
$$
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION moje_dane_wet (email varchar, haslo varchar)
RETURNS SETOF projekt.weterynarze
LANGUAGE plpgsql
AS '
BEGIN
   RETURN QUERY
		SELECT *
		FROM projekt.weterynarze w
		WHERE w.email = $1 AND w.hasło = $2;
END;
';


CREATE OR REPLACE FUNCTION moje_dane (email varchar, haslo varchar)
RETURNS SETOF projekt.Właściciele
LANGUAGE plpgsql
AS '
BEGIN
   RETURN QUERY
		SELECT *
		FROM projekt.Właściciele w
		WHERE w.email = $1 AND w.hasło = $2;
END;
';


CREATE OR REPLACE FUNCTION moje_zwierzęta (id int)
RETURNS TABLE (imię varchar, gatunek varchar, rasa VARCHAR, wielkość VARCHAR)
LANGUAGE plpgsql
AS '
BEGIN
   RETURN QUERY
		SELECT  z.imię, g.nazwa, r.nazwa, r.wielkość FROM projekt.Właściciele w
		JOIN projekt.Zwierzęta z on z.id_właściciel = w.id_właściciel
		JOIN projekt.Rasy r on r.id_rasa = z.id_rasa
		JOIN projekt.Gatunki g on g.id_gatunek = r.id_rasa
		WHERE w.id_właściciel = id;

END;
';


CREATE OR REPLACE FUNCTION moi_pacjenci (id int)
RETURNS TABLE (imię varchar, gatunek varchar, rasa VARCHAR, wielkość VARCHAR, wlimie varchar, wlnazwisko varchar)
LANGUAGE plpgsql
AS '
BEGIN
   RETURN QUERY
		SELECT z.imię, g.nazwa, r.nazwa, r.wielkość, wl.imię, wl.nazwisko FROM projekt.weterynarze w
        JOIN projekt.zwierzę_wizyta zw on zw.id_weterynarz = w.id_weterynarz
        JOIN projekt.zwierzęta z on z.id_zwierzę = zw.id_zwierzę
		JOIN projekt.właściciele wl on wl.id_właściciel = z.id_właściciel
		JOIN projekt.Rasy r on r.id_rasa = z.id_rasa
		JOIN projekt.Gatunki g on g.id_gatunek = r.id_rasa
		WHERE w.id_weterynarz = id;

END;
';


CREATE OR REPLACE FUNCTION znajdz_zwierze (varchar,varchar) RETURNS integer AS $$
DECLARE
    id integer;
BEGIN
    id := id_zwierzę
		FROM projekt.zwierzęta z JOIN projekt.właściciele w on w.id_właściciel = z.id_właściciel
		WHERE z.imię = $1 AND w.nazwisko = $2;
    RETURN  id;
END;
$$
LANGUAGE 'plpgsql';


insert into statystyki values (0,0,0,0,0);

CREATE OR REPLACE FUNCTION updatestats() RETURNS void  AS $$
DECLARE
    l_zw integer;
    l_wet integer;
    l_wl integer;
    l_wl2 integer;
    śr_c money;

BEGIN
		l_zw :=  count(*) from projekt.zwierzęta;

		l_wet := count(*) from projekt.weterynarze;

        l_wl := count(*) from projekt.właściciele;
        
        l_wl2 := count(*) FROM (select w.imię, w.nazwisko  from projekt.właściciele w
				join projekt.zwierzęta z on z.id_właściciel = w.id_właściciel
				GROUP BY w.imię, w.nazwisko HAVING COUNT(*) >=2) as l;
                
        śr_c := avg(cena)::money from projekt.rodzaj;
			
        UPDATE projekt.statystyki SET l_zwierząt = l_zw,l_weterynarzy = l_wet, l_właścicieli = l_wl, l_właścicieli2 = l_wl2, śr_cena = śr_c;

END;
$$
LANGUAGE 'plpgsql';


--WIDOKI--

create view moje_wizyty as
SELECT wl.id_właściciel, z.imię, (w.imię || '  ' || w.nazwisko)as wet, zw.data, (b.miasto || ',  ' || b.ulica || '  ' || b.numer_budynku) as adres, g.numer_gabinetu, wiz.nazwa as cel, d.nazwa as dol FROM projekt.weterynarze w
JOIN projekt.Zwierzę_wizyta zw on zw.id_weterynarz = w.id_weterynarz
JOIN projekt.wizyta wiz on wiz.id_wizyta = zw.id_wizyta
JOIN projekt.gabinety g on g.id_weterynarz = w.id_weterynarz
JOIN projekt.budynki b on b.id_budynek = g.id_budynek
JOIN projekt.zwierzęta z on z.id_zwierzę = zw.id_zwierzę
JOIN projekt.zwierzę_dolegliwość zd on zd.id_zwierzę = z.id_zwierzę
JOIN projekt.właściciele wl on wl.id_właściciel = z.id_właściciel
JOIN projekt.dolegliwości d on d.id_dolegliwość = zd.id_dolegliwość
WHERE zw.id_gabinet = g.id_gabinet and wl.id_właściciel = z.id_właściciel;


create view moje_wizyty_wet as
SELECT w.id_weterynarz, z.imię, (wl.imię || '  ' || wl.nazwisko)as wlasc, zw.data, (b.miasto || ',  ' || b.ulica || '  ' || b.numer_budynku) as adres, g.numer_gabinetu, wiz.nazwa as cel, d.nazwa as dol FROM projekt.weterynarze w
JOIN projekt.Zwierzę_wizyta zw on zw.id_weterynarz = w.id_weterynarz
JOIN projekt.wizyta wiz on wiz.id_wizyta = zw.id_wizyta
JOIN projekt.gabinety g on g.id_weterynarz = w.id_weterynarz
JOIN projekt.budynki b on b.id_budynek = g.id_budynek
JOIN projekt.zwierzęta z on z.id_zwierzę = zw.id_zwierzę
JOIN projekt.zwierzę_dolegliwość zd on zd.id_zwierzę = z.id_zwierzę
JOIN projekt.właściciele wl on wl.id_właściciel = z.id_właściciel
JOIN projekt.dolegliwości d on d.id_dolegliwość = zd.id_dolegliwość
WHERE zw.id_gabinet = g.id_gabinet;


create view szczepienia_widok as
SELECT  z.imię, (w.imię || '  ' || w.nazwisko)as właściciel, s.nazwa, zs.data FROM projekt.właściciele w
JOIN projekt.zwierzęta z on z.id_właściciel = w.id_właściciel
JOIN projekt.zwierzę_szczepienie zs on zs.id_zwierzę = z.id_zwierzę
JOIN projekt.szczepienia s on s.id_szczepienie = zs.id_szczepienie;


create view wets as
SELECT w.imię, w.nazwisko, g.numer_gabinetu, b.miasto,b.ulica,b.numer_budynku, b.id_budynek FROM weterynarze w
JOIN gabinety g on g.id_weterynarz = w.id_weterynarz
JOIN budynki b on b.id_budynek = g.id_budynek
ORDER BY b.id_budynek;


create view wszystkie_zwierzęta as
SELECT z.imię, g.nazwa as gatunek, r.nazwa as rasa, r.wielkość, w.imię as wlimie, w.nazwisko as wlnazwisko FROM projekt.właściciele w
JOIN projekt.zwierzęta z on z.id_właściciel = w.id_właściciel
JOIN projekt.Rasy r on r.id_rasa = z.id_rasa
JOIN projekt.Gatunki g on g.id_gatunek = r.id_rasa;


--TRIGGERY--

CREATE OR REPLACE FUNCTION normalize_upper ()  RETURNS TRIGGER AS $$
    BEGIN
    	New.imię := initcap(New.imię);
    	New.nazwisko := initcap(New.nazwisko);
        IF NEW.email !~ ('@')  THEN
        RAISE EXCEPTION 'Nieprawidłowy e-mail';
    END IF;
    RETURN NEW;
    END;
    $$ LANGUAGE plpgsql;


CREATE TRIGGER upper_normal_for_users
    BEFORE INSERT ON projekt.właściciele
    FOR EACH ROW EXECUTE PROCEDURE normalize_upper();
	
	
CREATE TRIGGER upper_normal_for_vets
    BEFORE INSERT ON projekt.weterynarze
    FOR EACH ROW EXECUTE PROCEDURE normalize_upper();
	
	

CREATE OR REPLACE FUNCTION normalize_build ()  RETURNS TRIGGER AS $$
    BEGIN
    	New.miasto := initcap(New.miasto);
    	New.ulica := initcap(New.ulica);
    RETURN NEW;
    END;
    $$ LANGUAGE plpgsql;


CREATE TRIGGER upper_normal_for_buildings
    BEFORE INSERT ON projekt.budynki
    FOR EACH ROW EXECUTE PROCEDURE normalize_build();
	
	
	
CREATE OR REPLACE FUNCTION normalize_animals ()  RETURNS TRIGGER AS $$
    BEGIN
    	New.imię := initcap(New.imię);
    RETURN NEW;
    END;
    $$ LANGUAGE plpgsql;


CREATE TRIGGER upper_normal_for_animals
    BEFORE INSERT ON projekt.zwierzęta
    FOR EACH ROW EXECUTE PROCEDURE normalize_animals();
