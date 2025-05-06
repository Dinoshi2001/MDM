<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    
    public function checkEmailExists($email) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0; 
    }

    // Register a new user
    public function register($fullname, $email, $password) {
        $query = "INSERT INTO users (name, email, password) VALUES (:fullname, :email, :password)";
        $stmt = $this->conn->prepare($query);

        // Hash the password before saving
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Bind parameters
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        
        return $stmt->execute();
    }
}
?>
