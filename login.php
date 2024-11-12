<?php
require_once '../c/dbConfig.php';
session_start();

// LOGIN
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Modified query for Users table
    $sql = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['users_id'];
            $_SESSION['user_name'] = $user['users_name'];
            header('Location: ../s/index.php');
            exit();
        } else {
            $error_message = "Incorrect password!";
        }
    } else {
        $error_message = "User not found!";
    }
}

if (isset($_GET['register']) && $_GET['register'] == 'true') {
    $register_form = true;
} else {
    $register_form = false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $users_name = $_POST['users_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $date_of_registration = date('Y-m-d');
    
    // Modified query to check for existing email in Users table
    $sql = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error_message = "Email is already registered!";
    } else {
        
        // Insert into Users table
        $sql = "INSERT INTO Users (users_name, email, password, date_of_registration) 
                VALUES ('$users_name', '$email', '$password', '$date_of_registration')";
        
        if ($conn->query($sql) === TRUE) {
            $success_message = "Registered successfully! Please log in.";
            $register_form = false;
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}
?>

<div class="container">

    <?php if (isset($error_message)): ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <?php if (isset($success_message)): ?>
        <div class="success"><?php echo $success_message; ?></div>
    <?php endif; ?>
    
    <?php if (!$register_form): ?>
        <h1>User Login</h1>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">Login</button>
        </form>
        
        <p>Don't have an account? <a href="login.php?register=true">Register here</a></p>
    <?php else: ?>
        
        <h1>User Registration</h1>
        <form method="POST">
            <input type="text" name="users_name" placeholder="Full Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="register">Register</button>
        </form>
        
        <p>Already have an account? <a href="login.php">Login here</a></p>
    <?php endif; ?>
</div>
