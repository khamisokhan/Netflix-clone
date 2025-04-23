<?php
// db.php - Database connection and functions for user authentication

// Create a function to establish the database connection
function getDbConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "netflix_clone";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Function to verify user credentials for sign-in
function loginUser($email, $password) {
    $conn = getDbConnection();
    
    // Check if the email exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    // If user is found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            $stmt->close();
            $conn->close();
            return $p; // Return user data
        } else {
            $stmt->close();
            $conn->close();
            return "Invalid email or password.";
        }
    } else {
        $stmt->close();
        $conn->close();
        return "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie Slider</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color:rgb(0, 0, 0);
      color: #fff;
      overflow: hidden;
    }

    
    .main nav{
      height:86px ;
      display:flex;
      align-items:center;
    
    }
    .main nav img{
      margin-left:150px;
    }
    .slider {
      position: relative;
      width: 80vw;
      height: 80vh;
      overflow: hidden;
      margin: 0px auto;
      border-radius: 20px;
      box-shadow: 0 4px 10px rgba(139, 135, 135, 0.5);
    }

    .slider-container {
      display: flex;
      transition: transform 0.5s ease-in-out;
      width: 100%;
    }

    .slider-item {
      min-width: 100%;
      height: 80vh;
      box-sizing: border-box;
      text-align: center;
      border-radius: 20px;
      overflow: hidden;
    }

    .slider-item img {
      width: 100%;
      height: 100%;
      
      object-fit:contain;

      overflow: hidden;
      border-radius: 20px;
    }

    .arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      border: none;
      cursor: pointer;
      padding: 10px;
      border-radius: 50%;
      z-index: 10;
    }

    .arrow.left {
      left: 10px;
    }

    .arrow.right {
      right: 10px;
    }
  </style>
</head>
<body>
 <div class="main">
      <nav>
        <span>
          <img width="160" src="imgs/netlogo-removebg-preview.png" alt="" />
        </span>
      </nav>
  <div class="slider">
    <button class="arrow left">&#10094;</button>
    <div class="slider-container">
      <div class="slider-item">
      <img src="imgs/money hiest.jpg" alt="" />
      </div>
      <div class="slider-item">
      <img src="imgs/spiderman.jpg" alt="" />
      </div>
      <div class="slider-item">
      <img src="imgs/iron man.jpg" alt="" />
      </div>
      <div class="slider-item">
      <img src="imgs/joker.jpg" alt="" />
      </div>
      <div class="slider-item">
      <img src="imgs/panda.jpg" alt="" />
      </div>
      <div class="slider-item">
      <img src="imgs/psyco.jpg" alt="" />
      </div>
      <div class="slider-item">
      <img src="imgs/interstaller.jpg" alt="" />
      </div>
      <div class="slider-item">
      <img src="imgs/deadpool.jpg" alt="" />
      </div>
      <div class="slider-item">
      <img src="imgs/peakyblinders.jpg" alt="" />
      </div>
      <div class="slider-item">
      <img src="imgs/loki.jpg" alt="" />
      </div>
    </div>
    <button class="arrow right">&#10095;</button>
  </div>

  <script src="script.js"></script>
</body>
</html>

      

