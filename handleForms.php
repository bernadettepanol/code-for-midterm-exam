<?php
require_once 'dbConfig.php';
require_once 'models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    // Insert Developer
    if ($action === 'insert') {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $birthdate = $_POST['birthdate'];
        $address = $_POST['address'];
        $services = $_POST['services'];

        try {
            insertDeveloper($firstName, $lastName, $email, $age, $birthdate, $address, $services);
            header('Location: index.php?message=insert_success');
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Update Developer
    if ($action === 'update') {
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
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Delete Developer
    if ($action === 'delete') {
        $developerID = $_POST['developerID'];

        try {
            deleteDeveloper($developerID);
            header('Location: index.php?message=delete_success');
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
