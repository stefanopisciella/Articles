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

INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 1", "content article 1", '2021-12-01 14:30:15', '2022-12-01 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 2", "content article 2", '2021-05-01 14:30:15', '2022-07-01 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 3", "content article 3", '2020-04-01 14:30:15', '2022-09-01 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 4", "content article 4", '2023-07-01 14:30:15', '2023-08-01 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 5", "content article 5", '2023-01-01 14:30:15', '2023-05-01 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 6", "content article 6", '2022-12-01 14:30:15', '2022-12-05 14:30:15');
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 7", "content article 7", '2017-07-01 14:30:15', NULL);
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 8", "content article 8", '2019-01-01 14:30:15', NULL);
INSERT INTO article(title, content, creation_datetime, last_update_datetime) VALUES ("title article 9", "content article 9", '2018-12-01 14:30:15', NULL);

