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
function mysql_entities_fix_string($connection, $string) {
    return htmlentities(mysql_fix_string($connection, $string));
}
function mysql_fix_string($connection, $string) {
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
        return $connection->real_escape_string($string);
}

function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);

}

if(isset($_POST['PHP_AUTH_USER']) && isset($_POST['PHP_AUTH_PW'])){
  $un_temp = mysql_entities_fix_string($conn,$_POST['PHP_AUTH_USER']);
  $pw_temp = mysql_entities_fix_string($conn,$_POST['PHP_AUTH_PW']);
  $query = "SELECT * FROM users WHERE username='$un_temp'";
$result = $conn->query($query);
if (!$result) {
    $msg = "Error in retrieving result: ";
    die(mysql_fatal_error($msg, $conn));
}
else {
 //   $rows = $result->num_rows;
$row = $result->fetch_array(MYSQLI_NUM);
$result->close;

$salt1 = $row[2];
$salt2= $row[3];
$token =  hash('ripemd128',"$salt1$pw_temp$salt2");
if($token == $row[1]){
header("Location: loggedin.php");
exit(); }
else{
        die("Invalid password/username");   

    }
}
}
else{
    echo <<<_END
<form action="authent.php" method="post">
<pre> <h2>ADMIN LOG-IN</h2> 
Username: <input type = "text" name ="PHP_AUTH_USER"> <br>
Password: <input type = "text" name ="PHP_AUTH_PW">
<input type="submit" value="Submit"> </pre> </form>
<form action="index.php">
        <input type="submit" value="Menu Page" />
    </form>
    
<br>
_END;
    die("Please enter your username and password");
}
$conn->close();

?>