<?php
require_once 'login.php';
//Mysql to create the table:
//CREATE TABLE data( name VARCHAR(50), content VARCHAR(400)) ENGINE MyISAM;

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die($conn->connect_error);
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $file = addslashes(file_get_contents($_FILES["filename"]["tmp_name"]));

    $query = "INSERT INTO data (name,content)
VALUES ('" . $name . "', '" . $file . "')";

    $q = mysqli_query($conn, $query);
}
echo <<<_END
		<html><head><title>Hw5 CS 174</title></head><body>
		<form method="post" enctype="multipart/form-data">
			Select a txt File: <input required type="file" name = "filename" size = "10" accept="text/plain" />
			<br><br>
		Enter name of the content: <input required type="text" name = "name" />
<br>
			<input type="submit" name="submit" value="Submit"/>
		</form>
_END;
$query = "SELECT * FROM data";
$print = $conn->query($query);

if ($print->num_rows > 0) {
    while ($row = $print->fetch_assoc()) {
        echo "Name: " . $row["name"] . " ----Content: " . $row["content"] . "----end<br><br><br>";
    }
} else {
    echo "No result";
}
