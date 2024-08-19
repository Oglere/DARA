<?php 
$server = "localhost";
$username = "root";
$pass = "";
$db = "DARA";

$conn = new mysqli($server, $username, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "
            <p> {$row['usn']}{$row['user_id']} = {</P>
            <p> Name: {$row['last_name']}, {$row['first_name']}</P>
            <p> Role: {$row['role']}</P>
            <p> }; </P>
        ";
        // print_r($row['usn']);
        // print_r($row['user_id']);
        // print_r("\n");

    }
} else {
    echo "0 results";
}

$conn->close();
?>
