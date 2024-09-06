<?php
// Initialize the session
session_start();

// Include the database connection
include 'roxcon.php'; // Adjust the path to your database connection file

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Process the form when it is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter your username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement to fetch user data
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement
            $stmt->bind_param("s", $param_username);
            $param_username = $username;
            
            // Execute the prepared statement
            if ($stmt->execute()) {
                // Store the result
                $stmt->store_result();
                
                // Check if the username exists, if yes, then verify the password
                if ($stmt->num_rows == 1) {
                    // Bind the result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    
                    if ($stmt->fetch()) {
                        // Verify the hashed password
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            
                            // Redirect user to the dashboard or home page
                            header("location: dashboard.php"); // Replace with your landing page after login
                        } else {
                            // If password is incorrect, display an error message
                            $login_err = "Invalid password.";
                        }
                    }
                } else {
                    // If the username doesn't exist, display an error message
                    $login_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
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
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Login</h2>
        <?php 
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.com/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
