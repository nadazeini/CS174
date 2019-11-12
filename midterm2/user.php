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
echo <<<_END
<h2>USER FILE CHECK</h2> 
<form method="post" enctype="multipart/form-data">
Select a file: <input required type="file" name = "userfile" />
<input  type="submit" name="usersubmit" value="Submit"/>
</pre></form>
<form action="index.php">
        <input type="submit" value="Menu Page" />
    </form>
_END;


if (isset($_POST['usersubmit'])) {
    $file = addslashes(file_get_contents($_FILES["userfile"]["name"]));
//$result = mysql_query("SELECT content FROM malware");
$query = "SELECT content FROM malware";
$result = $conn->query($query);
if (!$result) {
    $msg = "Error in accessing content: ";
    die(mysql_fatal_error($msg, $conn));
    }
   
    $rows = $result->num_rows;
    
    for ($j = 0; $j < $rows; ++$j) {
        $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if( strpos($file, $row['content']) !== false){
            echo "File is a malware :(";
        exit();
        }
        
    }
   
        echo "File not a malware :)";

}
else{
    echo "No files uploaded";
     }   
    $conn->close();
?>