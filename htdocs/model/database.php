<?php
class Database
{
    private $db;
    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
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

    public function getUser($UserID) {
        $query = "SELECT UserID, Username, Email, Nome, Bio, ImmagineProfilo FROM Utenti WHERE UserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
