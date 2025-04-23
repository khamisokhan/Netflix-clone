
<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'netflix_clone');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            echo "Welcome, " . $user['username'] . "!";
            // Start session or redirect to a dashboard
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php");
        } else {
            header("Location: signin1.php");
            echo "Invalid password.";
        }
    } else {
        header("Location: signin1.php");
        echo "No account found with that email.";
    }

    $stmt->close();
}

$conn->close();
?>

