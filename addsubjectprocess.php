<?php
// Include the database connection file
include 'roxcon.php';

// Define the directory to save uploaded files
$uploadDir = 'questionaire/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $gradelevel = isset($_POST['gradelevel']) ? intval($_POST['gradelevel']) : null;
    $subject = isset($_POST['subject']) ? $_POST['subject'] : null;

    // Initialize file path
    $filePath = null;
    
    // Handle the file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileName = basename($_FILES['file']['name']);
        $filePath = $uploadDir . $fileName;
        
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($fileTmpName, $filePath)) {
            // File upload successful
        } else {
            echo "Error moving uploaded file.";
            exit;
        }
    }

    // Prepare an SQL statement
    $stmt = $conn->prepare("INSERT INTO subjects (gradelevel, subject, file) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $gradelevel, $subject, $filePath);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        echo "New record created successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
