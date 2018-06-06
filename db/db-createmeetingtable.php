<?php
$servername = "localhost";
$username = "dpurnomo";
$password = "dennysesi";
$dbname = "sjbbi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE Meetings (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
type VARCHAR(30) NOT NULL,
date DATE NOT NULL,
tp_ketua VARCHAR(30) DEFAULT NULL,
tp_khotbah VARCHAR(30) DEFAULT NULL,
tp_menggali VARCHAR(30) DEFAULT NULL,
tp_bagian1 VARCHAR(30) DEFAULT NULL,
tp_bagian2 VARCHAR(30) DEFAULT NULL,
tp_pas VARCHAR(30) DEFAULT NULL,
tp_tavis1 VARCHAR(30) DEFAULT NULL,
tp_tavis2 VARCHAR(30) DEFAULT NULL,
tp_tatib VARCHAR(30) DEFAULT NULL,
tp_pembersihan VARCHAR(30) DEFAULT NULL,
tp_hadirin INT(6) DEFAULT NULL,
ap_ketua VARCHAR(30) DEFAULT NULL,
ap_ku VARCHAR(30) DEFAULT NULL,
ap_penerjemah VARCHAR(30) DEFAULT NULL,
ap_mp VARCHAR(30) DEFAULT NULL,
ap_tavis1 VARCHAR(30) DEFAULT NULL,
ap_tavis2 VARCHAR(30) DEFAULT NULL,
ap_tatib VARCHAR(30) DEFAULT NULL,
ap_pembersihan VARCHAR(30) DEFAULT NULL,
ap_pdl VARCHAR(30) DEFAULT NULL,
ap_hadirin VARCHAR(30) DEFAULT NULL,
createddate DATE NOT NULL,
modifieddate DATE NOT NULL,
createdby VARCHAR(30) NOT NULL,
modifiedby VARCHAR(30) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Meetings created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>