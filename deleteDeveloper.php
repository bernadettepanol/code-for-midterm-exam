<?php
require_once '../c/dbConfig.php';
require_once '../c/models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $developerID = $_POST['developerID'];

    try {
        deleteDeveloper($developerID);
        header('Location: index.php?message=delete_success');
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
    <title>Delete Developer</title>
</head>
<body>
    <h2>Delete Developer</h2>
    <p>Are you sure you want to delete this developer?</p>
    <form method="POST" action="deleteDeveloper.php">
        <input type="hidden" name="developerID" value="<?= htmlspecialchars($developer['DeveloperID']) ?>">
        <p>Name: <?= htmlspecialchars($developer['FirstName']) . ' ' . htmlspecialchars($developer['LastName']) ?></p>
        <button type="submit">Delete</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
