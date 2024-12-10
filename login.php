<?php
// Database connection
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is empty
$dbname = "my_database"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);
    
    // Execute the statement
    $stmt->execute();
    
    // Store the result
    $stmt->store_result();
    
    // Check if a user exists
    if ($stmt->num_rows > 0) {
        echo "Login successful!";
        // Here you can redirect to another page or start a session
    } else {
        echo "Invalid username or password.";
    }
    
    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>