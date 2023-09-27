drop database if exists articles;
create database if not exists articles;
use articles;

create table article (
    ID smallint primary key auto_increment,
    title varchar(50),
    content varchar(100),
    creation_datetime datetime,
    last_update_datetime datetime
);

INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("1/43 BURAGO RED BULL", "F1 RB19 TEAM ORACLE RED BULL RACING N 1 SEASON 2023 MAX VERSTAPPEN", '2023-09-10 14:30:15','2023-09-11 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("1/18 MITICA-DIECAST LANCIA", "THEMA TURBO i.e. 1S 1984", '2023-08-15 14:30:15', '2023-08-16 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("1/18 BBR-MODELS FERRARI", " 296 GTS SPIDER 2022 - CON VETRINA - WITH SHOWCASE", '2023-05-14 14:30:15', '2023-05-15 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("1/43 ODEON RENAULT", "R310 TRUCK TELONATO CALBERSON 1986", '2022-12-10 14:30:15', '2022-12-11 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("1/18 CULT-SCALE MODELS LAND ROVER", "RANGE ROVER CLASSIC VOGUE 1990", '2022-08-13 14:30:15', '2022-08-14 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("1/18 CULT-SCALE MODELS LAND ROVER", "LAND 88 3 SERIES HARD-TOP 1971", '2022-04-10 14:30:15', '2022-04-11 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("1/43 MATRIX SCALE MODELS FORD ENGLAND", " AURORA COUNTRY SQUIRE SW STATION WAGON 1969", '2021-11-04 14:30:15', '2021-11-05 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("1/18 BURAGO FERRARI", "F1 SF-23 TEAM SCUDERIA FERRARI N 16 SEASON 2023 CHARLES LECLERC - EXCLUSIVE CARMODEL", '2021-07-11 14:30:15', '2021-07-12 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("1/18 CMC FERRARI", "250 GTO ch.4219 COUPE N 19 HISTORICAL RACE MONTEREY LAGUNA", '2021-02-09 14:30:15', '2021-02-10 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("1/43 EDICOLA FERRARI", "LAFERRARI APERTA SPIDER 2016 - CON VETRINA - WITH SHOWCASE", '2020-09-05 14:30:15', '2020-09-06 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("1/43 EDICOLA ASTON MARTIN", "ONE-77 2009 - CON VETRINA - WITH SHOWCASE", '2020-05-09 14:30:15', '2020-05-10 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("1/18 GREENLIGHTUsato DODGE", "CHALLENGER R/T COUPE 1971 - VANISHING POINT - WEATHERED", '2020-01-22 14:30:15', '2020-01-23 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("1/43 MATRIX SCALE MODELS FERRARI", "365 GTB/4 NART N 0 MICHELOTTI 1974", '2019-08-10 14:30:15', '2019-08-11 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("1/18 KYOSHO TOYOTA", "LAND CRUISER J60 1980", '2019-08-07 20:30:15', '2019-08-08 20:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("1/18 MAXIMA ALFA ROMEO", "ATL SPORT COUPE 2000 1968 – CHROMED WHEELS", '2019-08-07 14:30:15', '2019-08-08 14:30:15');







