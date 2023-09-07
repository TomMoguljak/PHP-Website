create table
    user (
        id int primary key AUTO_INCREMENT,
        name varchar(30) not null,
        firstname varchar(30) not null,
        email varchar(40) not null unique,
        password varchar(256) not null
    );

create table
    poll (
        id varchar(50) primary key,
        title varchar(30) not null,
        description varchar(500),
        location varchar(40),
        owner int not null REFERENCES user(id),
        date DATETIME not null DEFAULT NOW(),
        active BOOLEAN not null DEFAULT TRUE
    );

create table
    option (
        id int primary key AUTO_INCREMENT,
        poll varchar(50) not null REFERENCES poll(id),
        start datetime,
        end datetime
);

create table
    entry (
        id int primary key AUTO_INCREMENT,
        option int not null REFERENCES option(id),
        name varchar(30) not null,
        firstname varchar(30) not null,
        available boolean not null
    );