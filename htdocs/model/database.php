<?php

class Database
{
    private $db;
    private static $instance;

    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            $envVariables = parse_ini_file('.env');
            self::$instance = new self(
                $envVariables["DB_HOST"],
                $envVariables["DB_USER"],
                $envVariables["DB_PASSWORD"],
                $envVariables["DB_NAME"],
                $envVariables["DB_PORT"],);
        }

        return self::$instance;
    }

    public function insertUser($username, $email, $password)
    {
        $query = "INSERT INTO Utenti (Username, Email, Password, ImmagineProfilo) VALUES (?, ?, ?, '/pub/media/default-profile-pic.jpg')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $username, $email, $password);
        return $stmt->execute();
    }

    public function login($username)
    {
        $query = "SELECT UserID, Username, Password FROM Utenti WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertPost($UserID, $Titolo, $Descrizione, $ricetta, $Foto)
    {
        $query = "INSERT INTO Posts (UserID, Titolo, Descrizione, RecipeID, Foto) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('issis', $UserID, $Titolo, $Descrizione, $ricetta, $Foto);
        return $stmt->execute();
    }

    public function getUser($Username)
    {
        $query = "SELECT UserID, Username, Email, Nome, Bio, ImmagineProfilo, NumeroPost, NumeroFollowing, NumeroFollower FROM Utenti WHERE Username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserPosts($UserID)
    {
        $query = "SELECT PostID, Foto FROM Posts WHERE UserID = ? ORDER BY DataCreazione DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPosts($userID)
    {
        $query = "SELECT p.*, u.Username, u.ImmagineProfilo, (SELECT count(*) from Notifiche 
                                                            WHERE UtenteNotificanteUserID = ? 
                                                              and Tipo = \"like\" 
                                                              and PostID = p.PostID) as isLike 
FROM Posts p, Utenti u 
WHERE p.UserID in (SELECT FollowedUserID from Followers where FollowingUserID=?) 
  and u.UserID = p.UserID;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $userID, $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowers($UserID)
    {
        $query = "SELECT NumeroFollower FROM Utenti WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowing($UserID)
    {
        $query = "SELECT NumeroFollowing FROM Utenti WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostsNumber($UserID)
    {
        $query = "SELECT NumeroPost FROM Utenti WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowID($followingUserID, $followedUserID)
    {
        $query = "SELECT * FROM Followers WHERE FollowingUserID = ? AND FollowedUserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $followingUserID, $followedUserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function followUser($followingUserID, $followedUserID)
    {
        $query = "INSERT INTO Followers (FollowingUserID, FollowedUserID) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $followingUserID, $followedUserID);
        $stmt->execute();

        $query = "UPDATE Utenti SET NumeroFollower = NumeroFollower + 1 WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $followedUserID);
        $stmt->execute();

        $query = "UPDATE Utenti SET NumeroFollowing = NumeroFollowing + 1 WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $followingUserID);
        $stmt->execute();
    }

    public function unfollowUser($followingUserID, $followedUserID)
    {
        $query = "DELETE FROM Followers WHERE FollowingUserID = ? AND FollowedUserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $followingUserID, $followedUserID);
        $stmt->execute();

        $query = "UPDATE Utenti SET NumeroFollower = NumeroFollower - 1 WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $followedUserID);
        $stmt->execute();

        $query = "UPDATE Utenti SET NumeroFollowing = NumeroFollowing - 1 WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $followingUserID);
        $stmt->execute();
    }

    public function updateProfile($UserID, $Nome, $Bio)
    {
        $query = "UPDATE Utenti SET Nome = ?, Bio = ? WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssi', $Nome, $Bio, $UserID);
        return $stmt->execute();
    }

    public function updateProfileImage($UserID, $Image)
    {
        $query = "UPDATE Utenti SET ImmagineProfilo = ? WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $Image, $UserID);
        return $stmt->execute();
    }

    public function getCommentsFromPost($postID)
    {

        $query = "SELECT Notifiche.*, Utenti.Username, Utenti.ImmagineProfilo 
FROM Notifiche, Utenti WHERE Tipo='Commento' and PostID=? AND UtenteNotificanteUserID = Utenti.UserID";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function searchUserFromString($searchString, $username)
    {
        $query = "SELECT Username, ImmagineProfilo FROM Utenti WHERE Username LIKE ? AND Username != ?";
        $stmt = $this->db->prepare($query);
        $searchString = "%" . $searchString . "%";
        $stmt->bind_param('ss', $searchString, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function notifyFollow($followingUserID, $followedUserID)
    {
        $query = "INSERT INTO Notifiche (UtenteNotificatoUserID, UtenteNotificanteUserID, Tipo, PostID) VALUES (?, ?, 'Segui', NULL)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $followedUserID, $followingUserID);
        return $stmt->execute();
    }

    public function getNotifications($UserID)
    {
        $query = "(
    SELECT Notifiche.*, Utenti.Nome, Utenti.Username, Utenti.ImmagineProfilo, Posts.PostID, Posts.Foto
    FROM Notifiche
    JOIN Utenti ON Utenti.UserID = Notifiche.UtenteNotificanteUserID
    LEFT JOIN Posts ON Notifiche.PostID = Posts.PostID
    WHERE Notifiche.UtenteNotificatoUserID = ?
      AND Notifiche.Letta = 0
)
UNION ALL
(
    SELECT Notifiche.*, Utenti.Nome, Utenti.Username, Utenti.ImmagineProfilo, Posts.PostID, Posts.Foto
    FROM Notifiche
    JOIN Utenti ON Utenti.UserID = Notifiche.UtenteNotificanteUserID
    LEFT JOIN Posts ON Notifiche.PostID = Posts.PostID
    WHERE Notifiche.UtenteNotificatoUserID = ?
      AND Notifiche.Letta = 1
    ORDER BY Notifiche.DataNotifica DESC
    LIMIT 10
)
ORDER BY DataNotifica DESC;
";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $UserID, $UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function readNotifications($UserID)
    {
        $query = "UPDATE Notifiche 
                  SET Letta = 1
                  WHERE UtenteNotificatoUserID = ?;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $UserID);
        return $stmt->execute();
    }

    public function getMentionedPosts($UserID)
    {
        $query = "SELECT Posts.*
                  FROM Posts, Notifiche
                  WHERE Posts.PostID = Notifiche.PostID
                  AND Notifiche.UtenteNotificatoUserID = ?
                  AND Notifiche.Tipo = 'Menzione'";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserRecipes($UserID)
    {
        $query = "SELECT * FROM Ricette WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserRecipesIDs($UserID)
    {
        $query = "SELECT RecipeID, Nome FROM Ricette WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function likePost($post, $sessionUserID)
    {
        $queryNotification = "INSERT into Notifiche (UtenteNotificatoUserID, UtenteNotificanteUserID, PostID, Tipo) 
values((SELECT Posts.UserID FROM Posts WHERE PostID = ? LIMIT 1 ), ?, ?, \"Like\");";
        $queryPost = "UPDATE Posts SET NumeroLike = NumeroLike + 1 WHERE PostID = ?;";
        $stmt1 = $this->db->prepare($queryNotification);
        $stmt2 = $this->db->prepare($queryPost);
        $stmt1->bind_param('iii', $post, $sessionUserID, $post);
        $stmt2->bind_param('i', $post);
        return $stmt1->execute() && $stmt2->execute();
    }

    public function removeLike($post, $sessionUserID)
    {
        $queryNotification = "DELETE from Notifiche WHERE PostID = ? and UtenteNotificanteUserID = ? and Tipo = \"Like\";";
        $queryPost = "UPDATE Posts SET NumeroLike = NumeroLike - 1 WHERE PostID = ?;";
        $stmt1 = $this->db->prepare($queryNotification);
        $stmt2 = $this->db->prepare($queryPost);
        $stmt1->bind_param('ii', $post, $sessionUserID);
        $stmt2->bind_param('i', $post);
        return $stmt1->execute() && $stmt2->execute();
    }


    public function addComment($notifyingUserID, $text, $postID)
    {
        $query = "INSERT INTO Notifiche (UtenteNotificatoUserID, UtenteNotificanteUserID, Testo, PostID, Tipo) 
VALUES ((SELECT Posts.UserID FROM Posts WHERE PostID = ? LIMIT 1 ), ?, ?, ?, \"Commento\")";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iisi', $postID, $notifyingUserID, $text, $postID);
        return $stmt->execute();
    }

    public function updateComment($commentID, $userID, $newText)
    {
        $query = "UPDATE Notifiche SET Testo = ? WHERE NotificationID = ? 
                                 and UtenteNotificanteUserID = ? 
                                 and Tipo = \"Commento\"";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sii', $newText, $commentID, $userID);
        return $stmt->execute();
    }

    public function removeComment($commentID, $userID)
    {
        $query = "DELETE FROM Notifiche WHERE NotificationID = ? 
                                 and UtenteNotificanteUserID = ? 
                                 and Tipo = \"Commento\"";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $commentID, $userID);
        return $stmt->execute();
    }

    public function likeList($post)
    {
        $query = "SELECT Utenti.Username, Utenti.ImmagineProfilo
              FROM Notifiche
              JOIN Utenti ON Notifiche.UtenteNotificanteUserID = Utenti.UserID
              WHERE Notifiche.PostID = ?
                AND Notifiche.Tipo = 'Like'";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $post);
        $stmt->execute();
        $result = $stmt->get_result();
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    }

    public function getPostFullInfo($postID, $userID)
    {
        $query = "SELECT p.*, (SELECT count(*) from Notifiche 
                                                            WHERE UtenteNotificanteUserID = ? 
                                                              and Tipo = \"like\" 
                                                              and PostID = p.PostID) as isLike
                                                              FROM Posts p
              WHERE p.PostID = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $userID, $postID);
        $stmt->execute();
        $result = $stmt->get_result();

        $post = $result->fetch_all(MYSQLI_ASSOC)[0];
        $post["Commenti"] = InteractionController::getInstance()->getCommentsFromPost($postID);

        foreach ($post["Commenti"] as &$item) {
            $item["owner"] = $item["UtenteNotificanteUserID"] == SessionController::getInstance()->getSessionUserID();
        }

        return json_encode($post);
    }

    public function addRecipe($UserID, $RecipeName, $RecipeProcess, $RecipeIngredients, $RecipeNutrients)
    {
        $query = "INSERT INTO Ricette (UserID, Nome, Procedimento, Ingredienti, ValoriNutrizionali) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('issss', $UserID, $RecipeName, $RecipeProcess, $RecipeIngredients, $RecipeNutrients);
        return $stmt->execute();
    }

    public function getRecipeByID($recipeID)
    {
        $query = "SELECT * FROM Ricette WHERE RecipeID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $recipeID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteRecipe($recipeID)
    {
        $query = "DELETE FROM Ricette WHERE RecipeID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $recipeID);
        return $stmt->execute();
    }

    public function getFollowersList($UserID)
    {
        $query = "SELECT Utenti.Username, Utenti.ImmagineProfilo
              FROM Followers
              JOIN Utenti ON Followers.FollowingUserID = Utenti.UserID
              WHERE Followers.FollowedUserID = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowingList($UserID)
    {
        $query = "SELECT Utenti.Username, Utenti.ImmagineProfilo
              FROM Followers
              JOIN Utenti ON Followers.FollowedUserID = Utenti.UserID
              WHERE Followers.FollowingUserID = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
