<?php 
require_once 'login.php';
function mysql_fatal_error($msg,$conn){
    $msg2 = mysqli_error($conn);
    echo <<<_END
    OOPS SOMETHING WENT WRONG:
    The error message is:
    <p>$msg:$msg2 </p>
    CLICK THE BACK BUTTON AND TRY AGAIN!

    _END;
}
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    return mysql_fatal_error($msg,$conn);
}


if (isset($_POST['Advisor']) && isset($_POST['StudentName']) &&
    isset($_POST['StudentID']) && isset($_POST['ClassCode'])
    ) {
    $Advisor = get_post($conn, 'Advisor');
    $StudentName = get_post($conn, 'StudentName');
    $StudentID = get_post($conn, 'StudentID');
    $ClassCode = get_post($conn, 'ClassCode');
    $query = "INSERT INTO info VALUES" .
        "('$Advisor', '$StudentName', '$StudentID', '$ClassCode')";
    $result = $conn->query($query);

    if (!$result) {
        $msg = "Failed to add: ";
        die(mysql_fatal_error($msg, $conn));
    }

    }
    echo <<<_END
    <form action="connect.php" method="post"><pre>
    Advisor Name <input type="text" name="Advisor">
    Student Name <input type="text" name="StudentName">
    Student ID <input type="text" name="StudentID">
    Class Code <input type="text" name="ClassCode">
    <input type="submit" value="ADD">
    <br><br><br>
    </pre></form>
    _END;

if(isset($_POST['search'])){
    $search = get_post($conn,'search');

$query = "SELECT * FROM info WHERE Advisor='$search'";
$result = $conn->query($query);
if (!$result) {
    $msg = "Error in retrieving result: ";
    die(mysql_fatal_error($msg, $conn));
}
}
echo <<<_END
<form action="connect.php" method="post"><pre>
Enter Advisor Name to Search: <input type="text" name="search">
<input type="submit" value="SEARCH">
</pre></form>
_END;
$rows = $result->num_rows;
for ($j = 0; $j < $rows; ++$j) {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);
    echo <<<_END

<pre>
Advisor FOUND:
Advisor: $row[0]
Student Name: $row[1]
Student ID:  $row[2]
Class Code: $row[3]
</pre>
_END;

}
$conn->close();

function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);

}

?>