<?php
$servername = "localhost";
$username = "92admin";
$password = "admin";
$dbname = "cyberSec_dump";

// Create connection with improved error handling
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    // Handle error - don't output connection details
    error_log("Connection failed: " . $conn->connect_error); // log error
    exit('Could not connect to the database.'); // generic error message
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = $_POST["e_login"];
    $enteredPassword = $_POST["password"];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT password FROM loginS WHERE e_login = ?");
    $stmt->bind_param("s", $enteredUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password against the hashed password in the database
        if (password_verify($enteredPassword, $row['password'])) {
            // Authentication successful
            echo "Login successful!";
            header("Location: client.php");
            exit();
        } else {
            // Invalid password
            echo "Invalid username or password";
        }
    } else {
        // Username not found
        echo "Invalid username or password";
    }
    $stmt->close();
}

session_start();

// ... [Your login logic]

if ($result->num_rows > 0) {
    // ... [Your authentication logic]
} else {
    $_SESSION['login_error'] = 'Invalid username or password';
    header("Location: index.php"); // Redirect back to the login page
    exit();
}


$conn->close();


