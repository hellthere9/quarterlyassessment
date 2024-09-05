<?php
// Include the database connection
include 'roxcon.php'; // Adjust the path to your database connection file

// Define variables and initialize with empty values
$username = $email = $password = "";
$username_err = $email_err = $password_err = "";

// Check if the user ID exists (this could be from a GET request)
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Get the user ID from the GET request
    $id = trim($_GET["id"]);

    // Fetch the user data based on ID
    $sql = "SELECT * FROM users WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $param_id);
        $param_id = $id;

        // Execute the query
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            // Check if the user was found
            if ($result->num_rows == 1) {
                // Fetch user data
                $row = $result->fetch_assoc();
                $username = $row["username"];
                $email = $row["email"];
                // Do not pre-populate the password field for security
            } else {
                // Redirect if the user was not found
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
} else {
    // Redirect if the ID is not provided
    header("location: error.php");
    exit();
}

// Process the form when it is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (!empty(trim($_POST["password"]))) {
        if (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have at least 6 characters.";
        } else {
            $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT); // Hash the password
        }
    }

    // Check if there are no errors before updating the database
    if (empty($username_err) && empty($email_err) && empty($password_err)) {
        // Prepare an update statement
        if (!empty($password)) {
            $sql = "UPDATE users SET username = ?, email = ?, password = ?, updated_at = ? WHERE id = ?";
        } else {
            $sql = "UPDATE users SET username = ?, email = ?, updated_at = ? WHERE id = ?";
        }

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement
            if (!empty($password)) {
                $stmt->bind_param("ssssi", $param_username, $param_email, $param_password, $param_updated_at, $param_id);
                $param_password = $password;
            } else {
                $stmt->bind_param("sssi", $param_username, $param_email, $param_updated_at, $param_id);
            }

            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_updated_at = date("Y-m-d H:i:s"); // Set current timestamp for updated_at
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to the users list or display success message
                header("location: display_users.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit User</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password (Leave blank if not changing)</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="display_users.php" class="btn btn-secondary ml-2">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.com/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
