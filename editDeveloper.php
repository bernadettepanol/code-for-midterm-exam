<?php
require_once '../c/dbConfig.php';
require_once '../c/models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $developerID = $_POST['developerID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $services = $_POST['services'];

    try {
        updateDeveloper($developerID, $firstName, $lastName, $email, $age, $birthdate, $address, $services);
        header('Location: index.php?message=update_success');
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_GET['developerID'])) {
    $developerID = $_GET['developerID'];
    $developer = fetchDeveloperByID($developerID);
} else {
    header('Location: index.php?message=invalid_id');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Developer</title>
</head>
<body>
    <h2>Edit Developer</h2>
    <form method="POST" action="editDeveloper.php">
        <input type="hidden" name="developerID" value="<?= htmlspecialchars($developer['DeveloperID']) ?>">
        <label>First Name: <input type="text" name="firstName" value="<?= htmlspecialchars($developer['FirstName']) ?>"></label><br>
        <label>Last Name: <input type="text" name="lastName" value="<?= htmlspecialchars($developer['LastName']) ?>"></label><br>
        <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($developer['Email']) ?>"></label><br>
        <label>Age: <input type="number" name="age" value="<?= htmlspecialchars($developer['Age']) ?>"></label><br>
        <label>Birthdate: <input type="date" name="birthdate" value="<?= htmlspecialchars($developer['Birthdate']) ?>"></label><br>
        <label>Address: <input type="text" name="address" value="<?= htmlspecialchars($developer['Address']) ?>"></label><br>
        <label>Services: <input type="text" name="services" value="<?= htmlspecialchars($developer['Services']) ?>"></label><br>
        <button type="submit">Update</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
