-- Creazione del database
CREATE DATABASE IF NOT EXISTS SocialNetworkDB;
USE SocialNetworkDB;

-- Tabella Utenti
CREATE TABLE IF NOT EXISTS Utenti (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(255) NOT NULL UNIQUE,
    Email VARCHAR(255) NOT NULL,
    Nome VARCHAR(255) NOT NULL,
    Bio TEXT,
    Password VARCHAR(255) NOT NULL,
    ImmagineProfilo VARCHAR(255) NOT NULL,
    NumeroPost INT DEFAULT 0,
    NumeroFollower INT DEFAULT 0,
    NumeroFollowing INT DEFAULT 0
);

-- Tabella Ricette
CREATE TABLE IF NOT EXISTS Ricette (
    RecipeID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    Nome VARCHAR(255) NOT NULL,
    Ingredienti TEXT NOT NULL,
    Procedimento TEXT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Utenti(UserID)
);

-- Tabella Posts
CREATE TABLE IF NOT EXISTS Posts (
    PostID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    Descrizione TEXT,
    Foto VARCHAR(255) NOT NULL,
    RecipeID INT,
    DataCreazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    NumeroLike INT DEFAULT 0,
    FOREIGN KEY (UserID) REFERENCES Utenti(UserID),
    FOREIGN KEY (RecipeID) REFERENCES Ricette(RecipeID)
);

-- Tabella Notifiche
CREATE TABLE IF NOT EXISTS Notifiche (
    NotificationID INT PRIMARY KEY AUTO_INCREMENT,
    UtenteNotificatoUserID INT NOT NULL,
    UtenteNotificanteUserID INT NOT NULL,
    Testo TEXT,
    PostID INT,
    Tipo ENUM('Like', 'Commento', 'Segui', 'Menzione') NOT NULL,
    DataNotifica TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Letta BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (UtenteNotificatoUserID) REFERENCES Utenti(UserID),
    FOREIGN KEY (UtenteNotificanteUserID) REFERENCES Utenti(UserID)
);

-- Tabella Followers
CREATE TABLE IF NOT EXISTS Followers (
    FollowerID INT PRIMARY KEY AUTO_INCREMENT,
    FollowedUserID INT NOT NULL,
    FollowingUserID INT NOT NULL,
    FOREIGN KEY (FollowedUserID) REFERENCES Utenti(UserID),
    FOREIGN KEY (FollowingUserID) REFERENCES Utenti(UserID)
);

-- Dati
-- password: pass
INSERT INTO Utenti (Username, Email, Nome, Bio, Password, ImmagineProfilo, NumeroPost, NumeroFollower, NumeroFollowing)
VALUES ('user1', 'user1@email.com', 'Signor user1', 'Ciao sono il signor user1 e sono il capo del dipartimento', '$2y$10$lZftLrWf7DjoyUVga25BM.OhZEPFwjsI9lO0alQ4tdHsiklsebbu.', '/pub/media/ff25b63820574d47939e01c9bd54d490dd70e52a2339fde21ec1be8a9aac4071.jpeg', 1, 2, 0),
       ('user2', 'user2@email.com', 'Signor user2', 'Ciao sono il signor user2', '$2y$10$lZftLrWf7DjoyUVga25BM.OhZEPFwjsI9lO0alQ4tdHsiklsebbu.', '/pub/media/ff25b63820574d47939e01c9bd54d490dd70e52a2339fde21ec1be8a9aac4071.jpeg', 1, 1, 1),
       ('user3', 'user3@email.com', 'Signor user3', 'Ciao sono il signor user3', '$2y$10$lZftLrWf7DjoyUVga25BM.OhZEPFwjsI9lO0alQ4tdHsiklsebbu.', '/pub/media/ff25b63820574d47939e01c9bd54d490dd70e52a2339fde21ec1be8a9aac4071.jpeg', 1, 0, 2);

-- Posts
INSERT INTO Posts (UserID, Descrizione, Foto, NumeroLike)
VALUES (1, 'Ciao sono user1', '/pub/media/ff25b63820574d47939e01c9bd54d490dd70e52a2339fde21ec1be8a9aac4071.jpeg', 2),
       (2, 'Ciao sono user2', '/pub/media/ff25b63820574d47939e01c9bd54d490dd70e52a2339fde21ec1be8a9aac4071.jpeg', 0),
       (3, 'Ciao sono user3', '/pub/media/ff25b63820574d47939e01c9bd54d490dd70e52a2339fde21ec1be8a9aac4071.jpeg', 0);

-- Followers
INSERT INTO Followers (FollowedUserID, FollowingUserID)
VALUES (1, 2),
       (1, 3),
       (2, 3);

-- Notifiche
INSERT INTO Notifiche (UtenteNotificatoUserID, UtenteNotificanteUserID, Tipo)
VALUES (1, 2, 'Segui'),
       (1, 3, 'Segui'),
       (2, 3, 'Segui');

INSERT INTO Notifiche (UtenteNotificatoUserID, UtenteNotificanteUserID, Testo, Tipo, PostID)
VALUES (1, 2, 'Ciao sono user2', 'Commento', 1);

INSERT INTO Notifiche (UtenteNotificatoUserID, UtenteNotificanteUserID, Tipo, PostID)
VALUES (1, 2, 'Like', 1),
       (1, 3, 'Like', 1);


