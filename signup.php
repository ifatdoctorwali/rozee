<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $password])) {
            $_SESSION['user_id'] = $conn->lastInsertId(); 
            $_SESSION['user_name'] = $name;
            header("Location: login.php"); // Redirect to home page
            exit();
        } else {
            echo "Signup failed. Try again.";
        }
    } catch (PDOException $e) {
        die("Signup Error: " . $e->getMessage()); // Display error message
    }
}
?>
