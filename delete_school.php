<?php
// Include the database connection file
include 'roxcon.php';

// Check if the ID parameter is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare a statement to find the record
    $stmt = $conn->prepare("SELECT * FROM school WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Record found, proceed to delete
        $stmt = $conn->prepare("DELETE FROM school WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Redirect to the display page with a success message
            header("Location: display_school.php?message=Record deleted successfully");
            exit();
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
    } else {
        // No record found with the given ID
        echo "No record found with the given ID.";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
