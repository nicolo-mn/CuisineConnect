-- Creazione del database
CREATE DATABASE IF NOT EXISTS SocialNetworkDB;
USE SocialNetworkDB;

-- Tabella Utenti
CREATE TABLE IF NOT EXISTS Utenti (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Nome VARCHAR(255) NOT NULL,
    Bio TEXT,
    Password VARCHAR(255) NOT NULL,
    ImmagineProfilo VARCHAR(255),
    NumeroPost INT DEFAULT 0,
    NumeroFollower INT DEFAULT 0,
    NumeroFollowing INT DEFAULT 0
);

-- Tabella Ricette
CREATE TABLE IF NOT EXISTS Ricette (
    RecipeID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    Nome VARCHAR(255) NOT NULL,
    Descrizione TEXT,
    Ingredienti TEXT,
    Procedimento TEXT,
    FOREIGN KEY (UserID) REFERENCES Utenti(UserID)
);

-- Tabella Posts
CREATE TABLE IF NOT EXISTS Posts (
    PostID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    Titolo VARCHAR(255) NOT NULL,
    Descrizione TEXT,
    Foto VARCHAR(255),
    RecipeID INT,
    DataCreazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UserID) REFERENCES Utenti(UserID),
    FOREIGN KEY (RecipeID) REFERENCES Ricette(RecipeID)
);

-- Tabella Notifiche
CREATE TABLE IF NOT EXISTS Notifiche (
    NotificationID INT PRIMARY KEY AUTO_INCREMENT,
    UserIDUtenteNotificato INT,
    UserIDUtenteNotificante INT,
    Testo TEXT,
    PostID INT,
    Tipo ENUM('Like', 'Commento', 'Segui', 'Menzione') NOT NULL,
    DataNotifica TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Letta BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (UserIDUtenteNotificato) REFERENCES Utenti(UserID),
    FOREIGN KEY (UserIDUtenteNotificante) REFERENCES Utenti(UserID)
);

-- Tabella Followers
CREATE TABLE IF NOT EXISTS Followers (
    FollowerID INT PRIMARY KEY AUTO_INCREMENT,
    FollowerUserID INT,
    FollowingUserID INT,
    FOREIGN KEY (FollowerUserID) REFERENCES Utenti(UserID),
    FOREIGN KEY (FollowingUserID) REFERENCES Utenti(UserID)
);

-- Dati
-- user: admin password: pass
INSERT INTO Utenti (Username, Email, Nome, Bio, Password, ImmagineProfilo)
VALUES ('admin', 'admin@email.com', 'Signor Admin', 'Ciao sono il signor Admin e sono il capo del dipartimento', '$2y$10$lZftLrWf7DjoyUVga25BM.OhZEPFwjsI9lO0alQ4tdHsiklsebbu.', 'pub/media/ff25b63820574d47939e01c9bd54d490dd70e52a2339fde21ec1be8a9aac4071.jpeg');

-- Posts
INSERT INTO Posts (UserID, Titolo, Descrizione, Foto)
VALUES (1, 'Titolo del Post', 'Ciao sono il direttore di dipartimento', 'pub/media/ff25b63820574d47939e01c9bd54d490dd70e52a2339fde21ec1be8a9aac4071.jpeg');