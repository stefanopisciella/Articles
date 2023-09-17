drop database if exists articles;
create database if not exists articles;
use articles;

create table article (
    ID smallint primary key auto_increment,
    title varchar(50),
    content varchar(100)
);

INSERT INTO article(title, content) VALUES ("title article 1", "content article 1");
INSERT INTO article(title, content) VALUES ("title article 2", "content article 2");
INSERT INTO article(title, content) VALUES ("title article 3", "content article 3");
INSERT INTO article(title, content) VALUES ("title article 4", "content article 4");
INSERT INTO article(title, content) VALUES ("title article 5", "content article 5");
INSERT INTO article(title, content) VALUES ("title article 6", "content article 6");


