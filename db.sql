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

INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 1", "content article 1", '2023-09-10 14:30:15','2023-09-11 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 2", "content article 2", '2023-08-15 14:30:15', '2023-08-16 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 3", "content article 3", '2023-05-14 14:30:15', '2023-05-15 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 4", "content article 4", '2022-12-10 14:30:15', '2022-12-11 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 5", "content article 5", '2022-08-13 14:30:15', '2022-08-14 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 6", "content article 6", '2022-04-10 14:30:15', '2022-04-11 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 7", "content article 7", '2021-11-04 14:30:15', '2021-11-05 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 8", "content article 8", '2021-07-11 14:30:15', '2021-07-12 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 9", "content article 9", '2021-02-09 14:30:15', '2021-02-10 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 10", "content article 10", '2020-09-05 14:30:15', '2020-09-06 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 11", "content article 11", '2020-05-09 14:30:15', '2020-05-10 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 12", "content article 12", '2020-01-22 14:30:15', '2020-01-23 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 13", "content article 13", '2019-08-10 14:30:15', '2019-08-11 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 14", "content article 14", '2019-08-07 20:30:15', '2019-08-08 20:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 15", "content article 15", '2019-08-07 14:30:15', '2019-08-08 14:30:15');







