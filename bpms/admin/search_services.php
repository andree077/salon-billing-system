<?php
$conn = new mysqli('localhost', 'root', '', 'bpmsdb');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query
$query = $_POST['query'];

// Perform a real-time search in the database
$sql = "SELECT ServiceName, Cost FROM tblservices WHERE ServiceName LIKE '%$query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ServiceName = $row['ServiceName'];
        $Cost = $row['Cost'];
    
        echo '<div onclick="fillServiceFields(\'' . $ServiceName . '\', \'' . $Cost . '\')">' . $ServiceName . '</div>';
    }
} else {
    echo 'No results found';
}

$conn->close();
 
// Close the database connection when done.
// mysqli_close($con);
?>
