<?php
// Establish a database connection
$conn = new mysqli('localhost', 'root', '', 'bpmsdb');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query
$query = $_POST['query'];

// Perform a real-time search in the database
$sql = "SELECT customer_name, email, phone, gender FROM tblcustomers WHERE customer_name LIKE '%$query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['customer_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $gender = $row['gender'];
        
        echo '<div onclick="fillCustomerFields(\'' . $name . '\', \'' . $email . '\', \'' . $phone . '\', \'' . $gender . '\')">' . $name . '</div>';
    }
} else {
    echo 'No results found';
}

$conn->close();
?>
