<?php
session_start();
require "../Database/migration.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
    $title = trim($_POST['title']);
    $description = $_POST['Description'];

    $users_id = $_SESSION['users_id'];

    // Find the next users_task_id for the logged-in user
    $sqlMaxUserTaskId = "SELECT MAX(users_task_id) FROM `tasks` WHERE `users_id` = $users_id";
    $resultMaxUserTaskId = mysqli_query($conn, $sqlMaxUserTaskId);
    $nextUserTaskId = (int) mysqli_fetch_array($resultMaxUserTaskId)[0] + 1;

    // Insert the task
    $sql = "INSERT INTO `tasks`(`title`, `Description`, `users_id`, `users_task_id`) VALUES ('$title', '$description', '$users_id', '$nextUserTaskId')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['success'] = "Data inserted successfully";
    } else {
        $_SESSION['error'] = "Error inserting data: " . mysqli_error($conn);
    }

    // Redirect to the appropriate page
    header("location: ../todo.php");
}
?>
