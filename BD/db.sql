CREATE TABLE usuario(
    id int primary key auto_increment,
    username varchar(50) unique,
    complete_name varchar(50),
    password varchar(255)
);
CREATE TABLE Blog(
    Id int primary key auto_increment,
    Nombre varchar(50),
);
CREATE TABLE Post_De_Blog(
    Id_Blog int,
    Id_Post int,
    FOREIGN KEY (Id_Blog) REFERENCES Blog(Id),
    FOREIGN KEY (Id_Post) REFERENCES Post(Id),
    PRIMARY KEY(Id_Blog, Id_Post)
);
CREATE TABLE Post(
    Id int primary key auto_increment,
    Titulo VARCHAR(50) not null,
    Contenido VARCHAR(255) not null
);
CREATE TABLE Comentario_De_Blog(
    Id_Post int,
    Id_Comentario int,
    FOREIGN KEY (Id_Post) REFERENCES Post(Id),
    FOREIGN KEY (Id_Comentario) REFERENCES Comentario(Id),
    PRIMARY KEY (Id_Blog, Id_Comentario)
);
CREATE TABLE Comentario(
    Id int primary key auto_increment,
    Id_Usuario int,
    Fecha DATETIME not null,
    Contenido VARCHAR(255) not null,
    FOREIGN KEY (Id_Usuario) REFERENCES usuario(id),
);
