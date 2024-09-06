<?php
// Include the database connection file
include 'roxcon.php';

// Fetch data from the school table
$sql = "SELECT id, schoolid, name, division FROM school";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">
        <a href="index.php?pg=schadd" class="btn btn-primary btn-sm">Add</a>
        School List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>School ID</th>
                    <th>Name</th> <!-- New Name Field -->
                    <th>Division</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['schoolid']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td> <!-- Display Name -->
                            <td><?php echo htmlspecialchars($row['division']); ?></td>
                            <td>
                                <!-- <a href="edit_school.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a> -->
                                <a href="index.php?pg=schooledit&&id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete_school.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
