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
    $msg="Failed to access database";
    die(mysql_fatal_error($msg,$conn));
}
 echo "You are now logged in";

 echo <<<_END
 <form method="post" enctype="multipart/form-data">
 Select a txt File: <input required type="file" name = "adminfile" size = "10" accept="text/plain" />

 Enter name of the malware file: <input required type="text" name = "name" />
  <input type="submit" name="adminsubmit" value="Submit"/>
 </form>
 <form action="logout.php">
     <input type="submit" value="logout" />
 </form>

 <form action="index.php">
        <input type="submit" value="Menu Page" />
    </form>
    
 _END;
 
 if (isset($_POST['adminsubmit'])) {
    if ($_FILES['adminfile']['type'] == 'text/plain'){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
    $file = addslashes(file_get_contents($_FILES["adminfile"]["tmp_name"],FALSE,null,0,20));
 
   
    $query = "INSERT INTO malware (name,content)
VALUES ('" . $name . "', '" . $file . "')";

    $q = mysqli_query($conn, $query);

echo "Malware file uploaded successfully";
}
 else{
echo "No files uploaded";
 }
}
?>