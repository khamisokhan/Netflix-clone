<?php
$conn = new mysqli('localhost', 'root', '', 'netflix_clone');

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Make sure the form was submitted using POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if required POST data is set
    if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validation: Check if the email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit();
        }

        // Password validation: Check if password is at least 6 characters long
        if (strlen($password) < 6) {
            echo "Password must be at least 6 characters long.";
            exit();
        }

        // Check if the username or email already exists in the database
        $checkSql = "SELECT * FROM users WHERE email = ? OR username = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("ss", $email, $username);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            echo "Username or email already exists.";
            exit();
        }

        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            // Start session and log user in
            session_start();
            $_SESSION['user_id'] = $conn->insert_id; // Store user ID in session
            header("Location: signin1.php");
            exit();
        } else {
            error_log("Error: " . $stmt->error);
            echo "An error occurred. Please try again.";
        }

        $stmt->close();
    } else {
        echo "Required form data missing.";
    }
} else {
    // echo "Invalid request method.";
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Netflix Pakistan - Watch TV Shows Online, Watch Movies Online</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main">
      <nav>
          <img width="160" src="imgs/netlogo-removebg-preview.png" alt="" />
      </nav>
      <div class="box"></div>
    <div class="box-signin">
      <div class="signin-form">

        <h1>Sign In</h1>
        <form action="signin.php" method="POST">


          <div class="inputs">
            <label for="email"><input id="1" itype="text" placeholder="Email or mobile number" name="email"></label>
            <label for="password"> <input id="2" type="password" placeholder="password" name="password"></label>
            <button>Sign In</button>
        </form>
        <div class="signup">
          <p>New to Netflix?</p>
          <a href="signup.html">Sign up now.</a>
        </div>
        <p>This page is protected by Google reCAPTCHA to ensure you're not a bot.</p>
      </div>
    </div>
</div>
</body>

</html>