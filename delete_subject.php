<?php
// Include the database connection file
include 'roxcon.php';

// Check if the 'id' parameter is set
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Prepare a statement to fetch the file path
    $stmt = $conn->prepare("SELECT file FROM subjects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filePath = $row['file'];
        
        // Delete the record
        $stmt = $conn->prepare("DELETE FROM subjects WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            // File deletion
            if ($filePath && file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }
            // Redirect to the display page with a success message
            header("Location: display_subjects.php?message=Record deleted successfully");
        } else {
            // Redirect to the display page with an error message
            header("Location: display_subjects.php?message=Error deleting record: " . $stmt->error);
        }
        
        // Close the statement
        $stmt->close();
    } else {
        // Redirect to the display page with an error message if no record found
        header("Location: display_subjects.php?message=Record not found");
    }

    // Close the connection
    $conn->close();
} else {
    // Redirect to the display page with an error message if 'id' is not valid
    header("Location: display_subjects.php?message=Invalid ID");
}
?>
