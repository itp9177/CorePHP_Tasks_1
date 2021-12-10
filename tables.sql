CREATE TABLE Providers (
    id int NOT NULL AUTO_INCREMENT,
    Name varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Emails (
    id int NOT NULL AUTO_INCREMENT,
    Email varchar(255) NOT NULL,
    providerID int NOT NULL,
    FOREIGN KEY (providerID) REFERENCES Providers(id),
    Created DATE NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO  Providers (Name) VALUES (gmail.com);
INSERT INTO  Emails (Email,ProviderID) VALUES ('indu@gmail.com','1');