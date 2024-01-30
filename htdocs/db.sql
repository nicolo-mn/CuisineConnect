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
    ImmagineProfilo VARCHAR(255)
);

-- Tabella Posts
CREATE TABLE IF NOT EXISTS Posts (
    PostID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    Titolo VARCHAR(255) NOT NULL,
    Descrizione TEXT,
    Foto VARCHAR(255),
    DataCreazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UserID) REFERENCES Utenti(UserID)
);

-- Tabella Ricette
CREATE TABLE IF NOT EXISTS Ricette (
    RecipeID INT PRIMARY KEY AUTO_INCREMENT,
    PostID INT,
    Nome VARCHAR(255) NOT NULL,
    Descrizione TEXT,
    FotoRealizzazione VARCHAR(255),
    Ingredienti TEXT,
    Procedimento TEXT,
    FOREIGN KEY (PostID) REFERENCES Posts(PostID)
);

-- Tabella Interazioni
CREATE TABLE IF NOT EXISTS Interazioni (
    InteractionID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    PostID INT,
    Tipo ENUM('Like', 'Commento') NOT NULL,
    Testo TEXT,
    DataInterazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UserID) REFERENCES Utenti(UserID),
    FOREIGN KEY (PostID) REFERENCES Posts(PostID)
);

-- Tabella Notifiche
CREATE TABLE IF NOT EXISTS Notifiche (
    NotificationID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    Testo TEXT,
    Link VARCHAR(255),
    DataNotifica TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Letta BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (UserID) REFERENCES Utenti(UserID)
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
VALUES ('admin', 'admin@email.com', 'Signor Admin', 'Ciao sono il signor Admin e sono il capo del dipartimento', '$2y$10$lZftLrWf7DjoyUVga25BM.OhZEPFwjsI9lO0alQ4tdHsiklsebbu.', 'path/media/ff25b63820574d47939e01c9bd54d490dd70e52a2339fde21ec1be8a9aac4071.jpeg');