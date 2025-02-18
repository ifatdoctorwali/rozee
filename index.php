<?php 
include("config.php");

try {
    $stmt = $conn->query("SELECT * FROM jobs");
} catch (PDOException $e) {
    die("Error fetching jobs: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            position: relative;
        }
        .header .buttons {
            position: absolute;
            top: 15px;
            right: 20px;
        }
        .header .buttons a, .header .buttons button {
            background: white;
            color: #007bff;
            padding: 8px 15px;
            margin-left: 10px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }
        .header .buttons a:hover, .header .buttons button:hover {
            background: #0056b3;
            color: white;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .job-listing {
            background: white;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
        .job-listing h3 {
            margin: 0;
            color: #333;
        }
        .job-listing p {
            margin: 5px 0;
            color: #666;
        }
        .apply-btn {
            display: inline-block;
            padding: 8px 12px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .apply-btn:hover {
            background: #0056b3;
        }
        /* Profile Modal */
        .profile-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
            border-radius: 5px;
            text-align: center;
            z-index: 1000;
        }
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        .close-btn {
            background: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Job Listings</h1>
        <div class="buttons">
            <button onclick="showProfile()">My Profile</button>
            <a href="login.php">Login</a>
            <a href="signup.php">Signup</a>
        </div>
    </div>

    <div class="container">
        <?php while ($row = $stmt->fetch()): ?>
            <div class="job-listing">
                <h3><?= htmlspecialchars($row['title']) ?></h3>
                <p><strong>Company:</strong> <?= htmlspecialchars($row['company']) ?></p>
                <p><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
                <a class="apply-btn" href="apply.php?id=<?= $row['id'] ?>">Apply</a>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Profile Modal -->
    <div class="modal-overlay" id="modalOverlay"></div>
    <div class="profile-modal" id="profileModal">
        <h2>My Profile</h2>
        <p><strong>Name:</strong> Iffat Huzaifa Doctor Wali</p>
        <p><strong>Age:</strong> 10 years old</p>
        <p><strong>Location:</strong> Allahabad, UP, India</p>
        <p><strong>School:</strong> Rehan School Online Academy</p>
        <button class="close-btn" onclick="closeProfile()">Close</button>
    </div>

    <script>
        // Show profile modal
        function showProfile() {
            document.getElementById("profileModal").style.display = "block";
            document.getElementById("modalOverlay").style.display = "block";
        }

        // Close profile modal
        function closeProfile() {
            document.getElementById("profileModal").style.display = "none";
            document.getElementById("modalOverlay").style.display = "none";
        }
    </script>

</body>
</html>
