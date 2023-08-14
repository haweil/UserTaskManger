<?php
session_start();
include "../classes/login-classes.php";
$dbh = new login();
$email = $_POST['email'];
$password = $_POST['password'];
$user = $dbh->loginUser($email, $password);

if ($user) {
    $firstname = $user['users_firstname'];
    $lastname = $user['users_lastname'];
    echo "Login successful! Welcome, " . $firstname . " " . $lastname . "!";
    // Store the user's ID in the session
    $_SESSION['users_id'] = $user['users_id'];
    $users_id = $_SESSION['users_id'];
    header("location: ../../To Do Task/todo.php"); // Redirect to the personalized page
} else {
echo "Invalid email or password. Please try again.";
}
?>