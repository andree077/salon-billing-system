<?php
$conn = new mysqli('localhost', 'root', '', 'bpmsdb');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query
$query = $_POST['query'];

// Perform a real-time search in the database
$sql = "SELECT employee_name FROM tblemployees WHERE employee_name LIKE '%$query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employee_name = $row['employee_name'];
    
        echo '<div onclick="fillEmployeeFields(\'' . $employee_name . '\')">' . $employee_name . '</div>';
    }
} else {
    echo 'No results found';
}

$conn->close();
 
// Close the database connection when done.
// mysqli_close($con);
?>
