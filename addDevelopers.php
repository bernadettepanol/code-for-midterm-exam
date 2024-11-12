<?php
require_once '../c/dbConfig.php';
require_once '../c/models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $services = $_POST['services'];

    try {
        
        addDeveloper($firstName, $lastName, $email, $age, $birthdate, $address, $services);
        
        header('Location: index.php?message=Developer added successfully');
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Developer</title>
</head>
<body>
    <h2>Add New Developer</h2>
    <form method="POST" action="addDeveloper.php">
        <label>First Name: <input type="text" name="firstName" required></label><br>
        <label>Last Name: <input type="text" name="lastName" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Age: <input type="number" name="age" required></label><br>
        <label>Birthdate: <input type="date" name="birthdate" required></label><br>
        <label>Address: <input type="text" name="address" required></label><br>
        <label>Services: <input type="text" name="services" required></label><br>
        <button type="submit">Add Developer</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
