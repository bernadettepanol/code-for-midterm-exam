SQL CREATE TABLE

CREATE TABLE Developers (
    DeveloperID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(100) NOT NULL,
    LastName VARCHAR(100) NOT NULL,
    Email VARCHAR(150) UNIQUE NOT NULL,
    Age INT CHECK (Age >= 18),
    Birthdate DATE,
    Address VARCHAR(255),
    Services VARCHAR(255)
);
