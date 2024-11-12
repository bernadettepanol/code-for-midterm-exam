<?php
require_once '../c/dbConfig.php';

// Insert Developer
function insertDeveloper($firstName, $lastName, $email, $age, $birthdate, $address, $services) {
    global $pdo;
    $sql = "INSERT INTO Developers (FirstName, LastName, Email, Age, Birthdate, Address, Services)
            VALUES (:firstName, :lastName, :email, :age, :birthdate, :address, :services)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':firstName' => $firstName,
        ':lastName' => $lastName,
        ':email' => $email,
        ':age' => $age,
        ':birthdate' => $birthdate,
        ':address' => $address,
        ':services' => $services
    ]);
}

// Update Developer
function updateDeveloper($developerID, $firstName, $lastName, $email, $age, $birthdate, $address, $services) {
    global $pdo;
    $sql = "UPDATE Developers
            SET FirstName = :firstName, LastName = :lastName, Email = :email,
                Age = :age, Birthdate = :birthdate, Address = :address, Services = :services
            WHERE DeveloperID = :developerID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':developerID' => $developerID,
        ':firstName' => $firstName,
        ':lastName' => $lastName,
        ':email' => $email,
        ':age' => $age,
        ':birthdate' => $birthdate,
        ':address' => $address,
        ':services' => $services
    ]);
}

// Delete Developer
function deleteDeveloper($developerID) {
    global $pdo;
    $sql = "DELETE FROM Developers WHERE DeveloperID = :developerID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':developerID' => $developerID]);
}

function fetchAllDevelopers() {
    global $pdo;
    $stmt = $pdo->query("SELECT DeveloperID, FirstName, LastName, Email, Age, Birthdate, Address, Services FROM developers");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchDeveloperByID($developerID) {
    global $pdo;

    $query = "SELECT * FROM developers WHERE DeveloperID = :developerID";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':developerID', $developerID, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addDeveloper($firstName, $lastName, $email, $age, $birthdate, $address, $services) {
    global $pdo;

    $sql = "INSERT INTO developers (FirstName, LastName, Email, Age, Birthdate, Address, Services) 
            VALUES (:firstName, :lastName, :email, :age, :birthdate, :address, :services)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':birthdate', $birthdate);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':services', $services);

    $stmt->execute();
}

?>
