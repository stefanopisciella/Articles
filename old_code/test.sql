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

INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 1", "content article 1", '2023-09-10 14:30:15','2018-09-11 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 2", "content article 2", '2022-08-15 14:30:15', '2019-08-16 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 3", "content article 3", '2021-05-14 14:30:15', '2020-05-15 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 4", "content article 4", '2020-12-10 14:30:15', '2021-12-11 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 5", "content article 5", '2019-08-13 14:30:15', '2022-08-14 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 6", "content article 6", '2018-04-10 14:30:15', '2023-04-11 14:30:15');







