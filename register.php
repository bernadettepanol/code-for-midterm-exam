<?php
require_once '../c/dbConfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $users_name = $_POST['users_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $date_of_registration = date("Y-m-d");

    // Check if the email already exists
    $query = "SELECT * FROM Users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $error_message = "Email already exists!";
    } else {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert the new user into the Users table
        $query = "INSERT INTO Users (users_name, email, password, date_of_registration)
                  VALUES ('$users_name', '$email', '$hashed_password', '$date_of_registration')";
        if (mysqli_query($conn, $query)) {
            $success_message = "Registered successfully! <a href='login.php'>Login</a>";
        } else {
            $error_message = "Error during registration!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

    <div class="container">
        <h1>User Registration</h1>

        <?php if (isset($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <?php if (isset($success_message)): ?>
            <div class="success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <input type="text" name="users_name" placeholder="Full Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
