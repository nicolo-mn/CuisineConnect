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

    public function insertUser($username, $email, $password){
        $query = "INSERT INTO Utenti (Username, Email, Password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss',$username, $email, $password);
        return $stmt->execute();
    }

    public function login($username){
        $query = "SELECT UserID, Username, Password FROM Utenti WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertPost($UserID, $Titolo, $Descrizione, $Foto){
        $query = "INSERT INTO Posts (UserID, Titolo, Descrizione, Foto) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('isss',$UserID, $Titolo, $Descrizione, $Foto);
        return $stmt->execute();
    }

    public function getUser($Username) {
        $query = "SELECT UserID, Username, Email, Nome, Bio, ImmagineProfilo, NumeroPost, NumeroFollowing, NumeroFollower FROM Utenti WHERE Username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserPosts($UserID) {
        $query = "SELECT * FROM Posts WHERE UserID = ? ORDER BY DataCreazione DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPosts($userID) {
        $query = "SELECT p.*, u.Username, u.ImmagineProfilo, (SELECT count(*) from Notifiche 
                                                            WHERE UtenteNotificanteUserID = ? 
                                                              and Tipo = \"like\" 
                                                              and PostID = p.PostID) as isLike 
FROM Posts p, Utenti u 
WHERE p.UserID in (SELECT FollowedUserID from Followers where FollowingUserID=?) 
  and u.UserID = p.UserID;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$userID, $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowers($UserID) {
        $query = "SELECT NumeroFollower FROM Utenti WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);    
    }

    public function getFollowing($UserID) {
        $query = "SELECT NumeroFollowing FROM Utenti WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostsNumber($UserID) {
        $query = "SELECT NumeroPost FROM Utenti WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowID($followingUserID, $followedUserID) {
        $query = "SELECT * FROM Followers WHERE FollowingUserID = ? AND FollowedUserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$followingUserID, $followedUserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function followUser($followingUserID, $followedUserID) {
        $query = "INSERT INTO Followers (FollowingUserID, FollowedUserID) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$followingUserID, $followedUserID);
        $stmt->execute();

        $query = "UPDATE Utenti SET NumeroFollower = NumeroFollower + 1 WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$followedUserID);
        $stmt->execute();

        $query = "UPDATE Utenti SET NumeroFollowing = NumeroFollowing + 1 WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$followingUserID);
        $stmt->execute();
    }

    public function unfollowUser($followingUserID, $followedUserID) {
        $query = "DELETE FROM Followers WHERE FollowingUserID = ? AND FollowedUserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$followingUserID, $followedUserID);
        $stmt->execute();

        $query = "UPDATE Utenti SET NumeroFollower = NumeroFollower - 1 WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$followedUserID);
        $stmt->execute();

        $query = "UPDATE Utenti SET NumeroFollowing = NumeroFollowing - 1 WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$followingUserID);
        $stmt->execute();
    }

    public function updateProfile($UserID, $Nome, $Bio) {
        $query = "UPDATE Utenti SET Nome = ?, Bio = ? WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssi',$Nome, $Bio, $UserID);
        return $stmt->execute();
    }

    public function getCommentsFromPost($postID)
    {

        $query = "SELECT Notifiche.*, Utenti.Username, Utenti.ImmagineProfilo FROM Notifiche, Utenti WHERE Tipo='Commento' and PostID=? AND UtenteNotificanteUserID = Utenti.UserID";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function searchUserFromString($searchString, $username) {
        $query = "SELECT Username, ImmagineProfilo FROM Utenti WHERE Username LIKE ? AND Username != ?";
        $stmt = $this->db->prepare($query);
        $searchString = "%".$searchString."%";
        $stmt->bind_param('ss', $searchString, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function notifyFollow($followingUserID, $followedUserID) {
        $query = "INSERT INTO Notifiche (UtenteNotificatoUserID, UtenteNotificanteUserID, Tipo, PostID) VALUES (?, ?, 'Segui', NULL)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$followedUserID, $followingUserID);
        return $stmt->execute();
    }

    public function getNotifications($UserID) {
        $query = "SELECT Notifiche.*, Utenti.Nome, Utenti.Username, Utenti.ImmagineProfilo, Posts.PostID, Posts.Foto
                  FROM Notifiche
                  JOIN Utenti ON Utenti.UserID = Notifiche.UtenteNotificanteUserID
                  LEFT JOIN Posts ON Notifiche.PostID = Posts.PostID
                  WHERE Notifiche.UtenteNotificatoUserID = ?
                  ORDER BY Notifiche.DataNotifica DESC;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function readNotifications($UserID) {
        $query = "UPDATE Notifiche 
                  SET Letta = 1
                  WHERE UtenteNotificatoUserID = ?;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $UserID);
        return $stmt->execute();
    }
}
