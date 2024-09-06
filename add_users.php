<?php
// Include the database connection
include 'roxcon.php'; // Adjust the path to your database connection file

// Define variables and initialize with empty values
$username = $email = $password = "";
$username_err = $email_err = $password_err = "";

// Process the form data when form is submitted
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
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT); // Hash the password
    }

    // Check if there are no errors before inserting into the database
    if (empty($username_err) && empty($email_err) && empty($password_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_username, $param_email, $param_password, $param_created_at);

            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = $password; // Password is already hashed
            $param_created_at = date("Y-m-d H:i:s"); // Set current timestamp for created_at

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to the users list or display success message
                header("location: index.php?pg=user");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <!-- Bootstrap CSS -->

</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Add New User</h2>
        <form action="add_users.php" method="post">
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
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="display_users.php" class="btn btn-secondary ml-2">Cancel</a>
            </div>
        </form>
    </div>


</body>
</html>
