DROP DATABASE socialnetworkdb;
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
    ValoriNutrizionali TEXT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Utenti(UserID)
);

-- Tabella Posts
CREATE TABLE IF NOT EXISTS Posts (
    PostID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    Titolo VARCHAR(255) NOT NULL,
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
    FollowID INT PRIMARY KEY AUTO_INCREMENT,
    FollowedUserID INT NOT NULL,
    FollowingUserID INT NOT NULL,
    FOREIGN KEY (FollowedUserID) REFERENCES Utenti(UserID),
    FOREIGN KEY (FollowingUserID) REFERENCES Utenti(UserID)
);

-- Dati
-- password: password
INSERT INTO `utenti` (`UserID`, `Username`, `Email`, `Nome`, `Bio`, `Password`, `ImmagineProfilo`, `NumeroPost`, `NumeroFollower`, `NumeroFollowing`) VALUES
(1, 'nicolo02', 'nicolo@email.com', 'Nicolò', 'I\'m a computer science studente passioned about healthy cooking, follow me to discover new recipes!', '$2y$10$DLTg4scvzhOt3ISaiDZjY.xU5JPAUR3cy1/wJKkzeLyzyMSczdVIa', 'pub/media/8a37b6be299f785128dad441096f2dd93fbcf05a814cb2350046fcf684101418.jpg', 4, 4, 3),
(2, 'marcopresti', 'marco@email.com', 'Marco Presti', 'Hello! I\'m a student currently studying in Rome to become a chef', '$2y$10$EBJEulvgUqRGpMBPfU0eQef8Vm4yjuaaPrdle7cMHWTJtkHkewYES', 'pub/media/a57f1927e94c6f6263d2a4ff744556c0ba580754bf69927805510cee49fc48dc.jpg', 2, 1, 1),
(3, 'emilydoe', 'emily@gmail.com', 'Emily Doe', 'Follow me in my cooking journey, I\'ll make simple but tasty dishes', '$2y$10$dWdncIQBLfssH7VEP6ZHpezXxGQe1NR1NYB32a64qPrvPHI/CTT1G', 'pub/media/b2fc20161d67125832cea90af1df88f81c14aca5866c5aac1d5751afe615091d.jpg', 2, 1, 1),
(4, 'luisvilla', 'luis@email.com', 'Luis Villa', 'I\'m a exchange student from Mexico, currently in Milan', '$2y$10$DCnoNCDR7MrxL7pNyklNm.0jQBAjKYg0nFttCh1rAAIGzajsX7IY6', 'pub/media/1bf904ed86319c67989e30b34991d02c741392e7542c0087e809a7ad2159efe1.jpg', 1, 1, 1),
(5, 'emilysullivan', 'emily2@gmail.com', 'Emily Sullivan', 'I love cooking!', '$2y$10$Yn4qsdqvxTnWDEW99Y.BAuJKeMBRmUX369w37KnUDViUTxj7S/UV.', 'pub/media/538f8d45d46c52ca3b15f4d11b27d13e7b2dba1c1a08ac706aba99384a51eb8c.jpg', 0, 0, 1);

INSERT INTO `ricette` (`RecipeID`, `UserID`, `Nome`, `Ingredienti`, `Procedimento`, `ValoriNutrizionali`) VALUES
(1, 1, 'Caprese Salad', '[\"200g of Tomatoes\",\"150g of Mozzarella cheese\",\"10g of Basil leaves\",\"15g of Balsamic Glaze\"]', ' Slice tomatoes and mozzarella cheese , arrange them on a plate, sprinkle with basil leaves, and drizzle with balsamic glaze.', '{\"Carbs\":[14.3,\"g\"],\"Proteins\":[34.548500000000004,\"g\"],\"Fats\":[37.364000000000004,\"g\"],\"Calories\":[528.5,\"kcal\"]}'),
(2, 1, 'Honey Mustard Chicken', '[\"250g of Chicken breast\",\"30g of Honey\",\"20g of Mustard\"]', 'Marinate chicken breasts in a mixture of honey and mustard for 30 minutes, then grill or bake until cooked through.\r\n', '{\"Carbs\":[25.886000000000003,\"g\"],\"Proteins\":[57.088,\"g\"],\"Fats\":[7.218000000000001,\"g\"],\"Calories\":[403.2,\"kcal\"]}'),
(3, 1, 'Stir-Fried Vegetables', '[\"200g of Mixed vegetables\",\"15g of Sesame oil\",\"20g of Soy sauce\"]', 'Stir-fry mixed vegetables in a hot pan with sesame oil and soy sauce until tender', '{\"Carbs\":[19.506,\"g\"],\"Proteins\":[6.808,\"g\"],\"Fats\":[15.614,\"g\"],\"Calories\":[241.2,\"kcal\"]}'),
(4, 2, 'Pesto pasta', '[\"100g of Pasta\",\"50g of Pesto Sauce\",\"10g of Parmesan cheese\"]', 'Cook pasta according to package instructions, then toss with pesto sauce and parmesan cheese', '{\"Carbs\":[78.95458426966293,\"g\"],\"Proteins\":[19.08,\"g\"],\"Fats\":[19.740337078651685,\"g\"],\"Calories\":[576.4921348314607,\"kcal\"]}'),
(5, 2, 'Greek Yogurt Parfait', '[\"200g of Greek yogurt\",\"50g of Granola\",\"150g of Strawberries\"]', 'Layer Greek yogurt, granola, and strawberries in a glass or bowl, repeat layers if desired', '{\"Carbs\":[45.06999999999999,\"g\"],\"Proteins\":[22.455,\"g\"],\"Fats\":[23.2,\"g\"],\"Calories\":[466.5,\"kcal\"]}'),
(6, 3, 'Tomato Basil Bruschetta', '[\"250g of Bread\",\"200g of Tomatoes\",\"10g of Basil leaves\",\"10g of Olive oil\"]', 'Toast slices of bread until golden brown. Top with diced tomatoes mixed with chopped basil, add olive oil', '{\"Carbs\":[126.795,\"g\"],\"Proteins\":[28.825000000000003,\"g\"],\"Fats\":[21.789,\"g\"],\"Calories\":[811.6999999999999,\"kcal\"]}'),
(7, 3, 'Guacamole', '[\"200g of Avocado\",\"100g of Tomatoes\",\"10g of Lime juice\"]', 'Mash ripe avocados and mix with diced tomatoes and lime juice. Season with salt and pepper to taste', '{\"Carbs\":[21.791999999999998,\"g\"],\"Proteins\":[4.922,\"g\"],\"Fats\":[29.607,\"g\"],\"Calories\":[340.5,\"kcal\"]}'),
(8, 4, 'Prosciutto-Wrapped Melon', '[\"150g of Prosciutto\",\"200g of Melon\"]', 'Wrap thin slices of prosciutto around bite-sized pieces of melon. Serve chilled', '{\"Carbs\":[16.77,\"g\"],\"Proteins\":[43.38,\"g\"],\"Fats\":[12.860000000000001,\"g\"],\"Calories\":[360.5,\"kcal\"]}');

INSERT INTO `posts` (`PostID`, `UserID`, `Titolo`, `Descrizione`, `Foto`, `RecipeID`, `DataCreazione`, `NumeroLike`) VALUES
(1, 1, 'My Caprese!', 'Had lots of fun cooking this dish', 'pub/media/1346880ac8e3da0358ba3b88f39a5324b7a9428ed52d8ecf3d8f58a4bfad66c6.jpg', 1, '2024-02-14 09:38:50', 1),
(2, 1, 'Mixed Vegetables', 'My micronutrients source of choice!', 'pub/media/e1d4693870ded1d3a42bf04f93a9430d0a9c50e31b18ecf47f8ccd9d63aa3607.jpeg', 3, '2024-02-14 09:47:32', 1),
(3, 1, 'Today\'s dessert!', 'Found this recipe on the internet, had to try it', 'pub/media/ca3b8f014e89da699266e02d586bb71b7c07c1088065fee3c13916412dc56b5f.jpeg', NULL, '2024-02-14 09:48:23', 2),
(4, 1, 'Here\'s my lunch!', 'Gotta get my proteins in for the workout.', 'pub/media/473cf67f2f5f708de5f47fc0d062160139580fc84d49127e2d21c466497a9820.jpeg', 2, '2024-02-14 09:52:26', 1),
(5, 2, 'My usual breakfast', 'My go-to breakfast for my typical day', 'pub/media/24c998fd56657b8603a845ccf88d27f3a25be514e2b52fbd856595cc7f5d1ced.jpeg', 5, '2024-02-14 10:07:13', 0),
(6, 2, 'Today\'s Lunch', 'A lunch I made with my best friend Nicolò!', 'pub/media/5b36dce3ef4737ac06f1cd4420a284ac0ae836880706b4aae065693ab3fefa17.jpeg', 4, '2024-02-14 10:08:25', 0),
(7, 3, 'My best bruschetta', 'The bruschetta I made for my family yesterday!', 'pub/media/a38e0ffc726fb9c90be350f32b25b978f80b02a9f4c49c84a4032420b0b5f1c8.jpeg', 6, '2024-02-14 10:26:23', 0),
(8, 3, 'Learning new stuff', 'Today I did my first Guacamole', 'pub/media/8de4f6b2e0d19b586a0dcdcb03c03cf9ebeb7fa543236cf1364ee9d81a441495.jpeg', 7, '2024-02-14 10:28:02', 0),
(9, 3, 'Homemade Pizza', 'A recipe I saw in a magazine inspired to make this pizza with my colleague', 'pub/media/d832d113237c0f85aff37f781ee83c9607db00e52f3608608a3719c7446e1a3e.jpeg', NULL, '2024-02-14 10:31:52', 0),
(10, 4, 'A fast summer dinner', 'Didn\'t have much time today, so I did this fast dish!', 'pub/media/eccd315c4074820424fcef96abc6ebb32ce001ad866fa3692704e7f71f78f8d8.jpeg', 8, '2024-02-14 10:41:01', 0);

INSERT INTO `notifiche` (`NotificationID`, `UtenteNotificatoUserID`, `UtenteNotificanteUserID`, `Testo`, `PostID`, `Tipo`, `DataNotifica`, `Letta`) VALUES
(1, 1, 2, NULL, NULL, 'Segui', '2024-02-14 10:07:35', 1),
(2, 1, 2, NULL, 6, 'Menzione', '2024-02-14 10:08:25', 1),
(3, 1, 2, 'So tasty!', 4, 'Commento', '2024-02-14 10:09:01', 1),
(4, 1, 2, NULL, 4, 'Like', '2024-02-14 10:09:05', 1),
(5, 1, 2, NULL, 3, 'Like', '2024-02-14 10:09:08', 1),
(6, 1, 2, 'Love it', 3, 'Commento', '2024-02-14 10:09:13', 1),
(7, 1, 2, NULL, 2, 'Like', '2024-02-14 10:09:16', 1),
(8, 2, 1, NULL, NULL, 'Segui', '2024-02-14 10:09:52', 0),
(9, 2, 1, 'That\'s really nice!', 5, 'Commento', '2024-02-14 10:10:08', 0),
(10, 1, 3, NULL, NULL, 'Segui', '2024-02-14 10:31:04', 1),
(11, 1, 3, NULL, 9, 'Menzione', '2024-02-14 10:31:52', 1),
(12, 1, 4, NULL, NULL, 'Segui', '2024-02-14 10:35:26', 1),
(13, 1, 4, 'Wow!', 4, 'Commento', '2024-02-14 10:42:07', 1),
(14, 1, 4, NULL, 3, 'Like', '2024-02-14 10:42:11', 1),
(15, 1, 4, 'Amazing mate!', 3, 'Commento', '2024-02-14 10:42:20', 1),
(16, 1, 4, NULL, 1, 'Like', '2024-02-14 10:42:24', 1),
(17, 1, 4, 'Simple but tasty!', 1, 'Commento', '2024-02-14 10:42:36', 1),
(18, 3, 1, NULL, NULL, 'Segui', '2024-02-14 10:46:32', 0),
(19, 4, 1, NULL, NULL, 'Segui', '2024-02-14 10:46:38', 0),
(20, 1, 5, NULL, NULL, 'Segui', '2024-02-14 10:53:42', 0);

INSERT INTO `followers` (`FollowID`, `FollowedUserID`, `FollowingUserID`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 1, 3),
(4, 1, 4),
(5, 3, 1),
(6, 4, 1),
(7, 1, 5);