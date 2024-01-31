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

    public function getPosts($UserID) {
        $query = "SELECT * FROM Posts WHERE UserID = ? ORDER BY DataCreazione DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$UserID);
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
}
