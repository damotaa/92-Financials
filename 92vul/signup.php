<?php
$servername = "localhost";
$username = "92admin";
$password = "admin";
$dbname = "cyberSec_dump";

error_reporting(E_ALL);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize user input
    $username = filter_input(INPUT_POST, 'e_login', FILTER_SANITIZE_STRING);
    $pass = $_POST["password"]; // We'll hash this below
    $email = filter_input(INPUT_POST, 'e_mail', FILTER_SANITIZE_EMAIL);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

    // Check if the email or username is already in use
    $stmt = $conn->prepare("SELECT * FROM loginS WHERE e_mail = ? OR e_login = ?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email or username is already in use
        header("Location: email_inUse.html");
        exit();
    } else {
        // Hash the password
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        // Generate a unique token
        $token = md5(uniqid(rand(), true));

        // Insert user data and token into the database
        $stmt = $conn->prepare("INSERT INTO loginS (e_login, password, e_mail, address, verification_token) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $hashedPassword, $email, $address, $token);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Send verification email
            $to = $email;
            $subject = "Account Verification";
            $message = "Click the following link to verify your account: http://localhost/92vul//verify.php?token=$token";
            $headers = "From: 92@accounts.com";

            mail($to, $subject, $message, $headers);

            header("location: index.php");
        } else {
            echo "Error in signup process.";
        }
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
