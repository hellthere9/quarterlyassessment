<?php
// Include the database connection file
include 'roxcon.php';

// Initialize variables
$schoolid = $name = $division = "";
$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $schoolid = isset($_POST['schoolid']) ? trim($_POST['schoolid']) : '';
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';  // Get the name from form
    $division = isset($_POST['division']) ? trim($_POST['division']) : '';

    // Validate School ID
    if (empty($schoolid) || !preg_match('/^\d{6}$/', $schoolid)) {
        $errors[] = "School ID must be exactly 6 digits.";
    }

    // Validate Name
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    // Validate Division
    $valid_divisions = [
        "Bukidnon", "Cagayan de Oro City", "Camiguin", "El Salvador City", "Gingoog City",
        "Iligan City", "Lanao del Norte", "Malaybalay City", "Misamis Occidental", "Misamis Oriental",
        "Oroquieta City", "Ozamiz City", "Tangub City", "Valencia City"
    ];
    if (empty($division) || !in_array($division, $valid_divisions)) {
        $errors[] = "Please select a valid division.";
    }

    // If no errors, proceed to insert data
    if (empty($errors)) {
        // Prepare the SQL INSERT statement
        $stmt = $conn->prepare("INSERT INTO school (schoolid, name, division) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $schoolid, $name, $division);

        // Execute the query and check if it was successful
        if ($stmt->execute()) {
            // Redirect to the display page with a success message
            header("Location: display_school.php?message=Record added successfully");
            exit();
        } else {
            $errors[] = "Error adding record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add School Data</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Add School Data</h2>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="index.php?pg=sch" method="post">
            <div class="form-group">
                <label for="schoolid">School ID</label>
                <input type="text" class="form-control" id="schoolid" name="schoolid" value="<?php echo htmlspecialchars($schoolid); ?>" maxlength="6" required>
                <small class="form-text text-muted">School ID must be exactly 6 digits.</small>
            </div>
            <div class="form-group">
                <label for="name">Name</label> <!-- New field for Name -->
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="form-group">
                <label for="division">Division</label>
                <select class="form-control" id="division" name="division" required>
                    <option value="">Select Division</option>
                    <option value="Bukidnon" <?php echo ($division == 'Bukidnon') ? 'selected' : ''; ?>>Bukidnon</option>
                    <option value="Cagayan de Oro City" <?php echo ($division == 'Cagayan de Oro City') ? 'selected' : ''; ?>>Cagayan de Oro City</option>
                    <option value="Camiguin" <?php echo ($division == 'Camiguin') ? 'selected' : ''; ?>>Camiguin</option>
                    <option value="El Salvador City" <?php echo ($division == 'El Salvador City') ? 'selected' : ''; ?>>El Salvador City</option>
                    <option value="Gingoog City" <?php echo ($division == 'Gingoog City') ? 'selected' : ''; ?>>Gingoog City</option>
                    <option value="Iligan City" <?php echo ($division == 'Iligan City') ? 'selected' : ''; ?>>Iligan City</option>
                    <option value="Lanao del Norte" <?php echo ($division == 'Lanao del Norte') ? 'selected' : ''; ?>>Lanao del Norte</option>
                    <option value="Malaybalay City" <?php echo ($division == 'Malaybalay City') ? 'selected' : ''; ?>>Malaybalay City</option>
                    <option value="Misamis Occidental" <?php echo ($division == 'Misamis Occidental') ? 'selected' : ''; ?>>Misamis Occidental</option>
                    <option value="Misamis Oriental" <?php echo ($division == 'Misamis Oriental') ? 'selected' : ''; ?>>Misamis Oriental</option>
                    <option value="Oroquieta City" <?php echo ($division == 'Oroquieta City') ? 'selected' : ''; ?>>Oroquieta City</option>
                    <option value="Ozamiz City" <?php echo ($division == 'Ozamiz City') ? 'selected' : ''; ?>>Ozamiz City</option>
                    <option value="Tangub City" <?php echo ($division == 'Tangub City') ? 'selected' : ''; ?>>Tangub City</option>
                    <option value="Valencia City" <?php echo ($division == 'Valencia City') ? 'selected' : ''; ?>>Valencia City</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Record</button>
        </form>
    </div>

</body>
</html>
