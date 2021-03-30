CREATE TABLE Właściciele (
  id_właściciel SERIAL PRIMARY KEY NOT NULL,
  imię varchar(30) NOT NULL,
  nazwisko varchar(30) NOT NULL,
  email varchar(30) NOT NULL,
  hasło varchar(30) NOT NULL,
  nr_tel int NOT NULL
);

CREATE TABLE Rasy (
  id_rasa SERIAL PRIMARY KEY NOT NULL,
  nazwa varchar(30) NOT NULL,
  wielkość varchar(30) NOT NULL
);

CREATE TABLE Gatunki (
  id_gatunek SERIAL PRIMARY KEY NOT NULL,
  nazwa varchar(30) NOT NULL,
  id_rasa int NOT NULL
);

CREATE TABLE Zwierzęta (
  id_zwierzę SERIAL PRIMARY KEY NOT NULL,
  imię varchar(30) NOT NULL,
  id_rasa int NOT NULL,
  id_właściciel int NOT NULL
);

CREATE TABLE Dolegliwości (
  id_dolegliwość SERIAL PRIMARY KEY NOT NULL,
  nazwa varchar(50)
);

CREATE TABLE Zwierzę_Dolegliwość (
  id_zwierzę int NOT NULL,
  id_dolegliwość int NOT NULL
);

CREATE TABLE Szczepienia (
  id_szczepienie SERIAL PRIMARY KEY NOT NULL,
  nazwa varchar(30) NOT NULL
);

CREATE TABLE Zwierzę_Szczepienie (
  id_zwierzę int NOT NULL,
  id_szczepienie int NOT NULL,
  data timestamp NOT NULL
);

CREATE TABLE Wizyta (
  id_wizyta SERIAL PRIMARY KEY NOT NULL,
  nazwa varchar NOT NULL
);

CREATE TABLE Rodzaj (
  id_wizyta int NOT NULL,
  cena int NOT NULL
 );

CREATE TABLE Zwierzę_Wizyta (
  id_zwierzę int NOT NULL,
  id_wizyta int NOT NULL,
  id_weterynarz int NOT NULL,
  data timestamp NOT NULL,
  id_gabinet int NOT NULL
);

CREATE TABLE Weterynarze (
  id_weterynarz SERIAL PRIMARY KEY NOT NULL,
  imię varchar(30) NOT NULL,
  nazwisko varchar(30) NOT NULL,
  email varchar(30) NOT NULL,
  hasło varchar(30) NOT NULL
);

CREATE TABLE Gabinety (
  id_gabinet SERIAL PRIMARY KEY NOT NULL,
  numer_gabinetu int NOT NULL,
  id_weterynarz int NOT NULL,
  id_budynek int NOT NULL
);

CREATE TABLE Budynki (
  id_budynek SERIAL PRIMARY KEY NOT NULL,
  miasto varchar(30) NOT NULL,
  ulica varchar(30) NOT NULL,
  numer_budynku int NOT NULL
);

CREATE TABLE statystyki (
  l_zwierząt integer ,
  l_weterynarzy integer,
  l_właścicieli integer,
  l_właścicieli2 integer,
  śr_cena money
);

ALTER TABLE Gatunki ADD FOREIGN KEY (id_rasa) REFERENCES Rasy (id_rasa);

ALTER TABLE Zwierzęta ADD FOREIGN KEY (id_rasa) REFERENCES Rasy (id_rasa);

ALTER TABLE Zwierzęta ADD FOREIGN KEY (id_właściciel) REFERENCES Właściciele (id_właściciel);

ALTER TABLE Zwierzę_Dolegliwość ADD FOREIGN KEY (id_zwierzę) REFERENCES Zwierzęta (id_zwierzę);

ALTER TABLE Zwierzę_Dolegliwość ADD FOREIGN KEY (id_dolegliwość) REFERENCES Dolegliwości (id_dolegliwość);

ALTER TABLE Zwierzę_Szczepienie ADD FOREIGN KEY (id_zwierzę) REFERENCES Zwierzęta (id_zwierzę);

ALTER TABLE Zwierzę_Szczepienie ADD FOREIGN KEY (id_szczepienie) REFERENCES Szczepienia (id_szczepienie);

ALTER TABLE Zwierzę_Wizyta ADD FOREIGN KEY (id_zwierzę) REFERENCES Zwierzęta (id_zwierzę);

ALTER TABLE Zwierzę_Wizyta ADD FOREIGN KEY (id_wizyta) REFERENCES Wizyta (id_wizyta);

ALTER TABLE Zwierzę_Wizyta ADD FOREIGN KEY (id_weterynarz) REFERENCES Weterynarze (id_weterynarz);

ALTER TABLE Gabinety ADD FOREIGN KEY (id_weterynarz) REFERENCES Weterynarze (id_weterynarz);

ALTER TABLE Gabinety ADD FOREIGN KEY (id_budynek) REFERENCES Budynki (id_budynek);

ALTER TABLE Rodzaj ADD FOREIGN KEY (id_wizyta) REFERENCES Wizyta (id_wizyta);

