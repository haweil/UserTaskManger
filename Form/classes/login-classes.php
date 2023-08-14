<?php

include "dbh.classes.php";
class login extends Dbh
{
    public function loginUser($email, $password)
    {
        $dbh = $this->connect();

        try {
            $stmt = $dbh->prepare("SELECT * FROM users WHERE users_email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                // Verify the hashed password
                if (password_verify($password, $user['users_pwd'])) {
                    return $user; // Login successful, return the user data
                } else {
                    return false; // Password does not match
                }
            } else {
                return false; // User not found
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}