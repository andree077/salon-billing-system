<?php
// Establish a database connection
$conn = new mysqli('localhost', 'root', '', 'bpmsdb');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$customer_name = $_POST['customer_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];

// Insert the new customer into the database
$sql = "INSERT INTO tblcustomers (customer_name, email, phone, gender) VALUES ('$customer_name', '$email', '$phone', '$gender')";
if ($conn->query($sql) === TRUE) {
    echo "New customer added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
