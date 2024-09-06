<?php
// Include the database connection file
include 'roxcon.php';

// Initialize variables for the form
$id = $gradelevel = $subject = $filePath = "";
$update = false;

// Check if the 'id' parameter is set and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Fetch the current record
    $stmt = $conn->prepare("SELECT * FROM subjects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $gradelevel = $row['gradelevel'];
        $subject = $row['subject'];
        $filePath = $row['file'];
    } else {
        die("Record not found.");
    }
    
    // Close the statement
    $stmt->close();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $gradelevel = isset($_POST['gradelevel']) ? intval($_POST['gradelevel']) : null;
    $subject = isset($_POST['subject']) ? $_POST['subject'] : null;

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        // Delete the old file if it exists
        if ($filePath && file_exists($filePath)) {
            unlink($filePath);
        }

        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileName = basename($_FILES['file']['name']);
        $filePath = 'questionaire/' . $fileName;

        // Move the uploaded file to the specified directory
        if (!move_uploaded_file($fileTmpName, $filePath)) {
            die("Error moving uploaded file.");
        }
    }

    // Prepare the update SQL statement
    $stmt = $conn->prepare("UPDATE subjects SET gradelevel = ?, subject = ?, file = ? WHERE id = ?");
    $stmt->bind_param("issi", $gradelevel, $subject, $filePath, $id);

    // Execute the update query
    if ($stmt->execute()) {
        // Redirect to the display page with a success message
        header("Location: index.php?pg=subj&&message=Record updated successfully");
    } else {
        // Redirect to the display page with an error message
        header("Location: index.php?pg=subj&&message=Error updating record: " . $stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Subject</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Subject</h2>
        <form action="edit_subject.php?id=<?php echo htmlspecialchars($id); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="gradelevel">Grade Level</label>
                <input type="number" class="form-control" id="gradelevel" name="gradelevel" value="<?php echo htmlspecialchars($gradelevel); ?>" min="1" max="99" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <textarea class="form-control" id="subject" name="subject" rows="3" required><?php echo htmlspecialchars($subject); ?></textarea>
            </div>
            <div class="form-group">
                <label for="file">Upload File</label>
                <input type="file" class="form-control-file" id="file" name="file">
                <?php if ($filePath): ?>
                    <small>Current file: <a href="<?php echo htmlspecialchars($filePath); ?>" target="_blank">View File</a></small>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>


</body>
</html>
