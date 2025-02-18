<?php
include("config.php");
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_id = $_POST['job_id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO applications (user_id, job_id) VALUES (?, ?)");
    if ($stmt->execute([$user_id, $job_id])) {
        echo "Application submitted!";
    } else {
        echo "Error!";
    }
}
?>

<form method="post">
    <input type="hidden" name="job_id" value="<?= $_GET['id'] ?>">
    <button type="submit">Apply</button>
</form>
