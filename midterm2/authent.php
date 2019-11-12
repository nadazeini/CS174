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




$username = 'admin';
$password = 'letmein';//to store in database
if(isset($_POST['PHP_AUTH_USER']) && isset($_POST['PHP_AUTH_PW'])){
    if($_POST['PHP_AUTH_USER']==$username && $_POST['PHP_AUTH_PW']==$password){
    //  echo "Welcome User:" .$_SERVER['PHP_AUTH_USER']."Password:".$_SERVER['PHP_AUTH_PW'];
    header("Location: loggedin.php");
    exit();
    }
    else{
        die("Invalid password/username");

    _END;
    
    }
}

else{
   //header('WWW-Authenticate:Basic realm= "Restricted Section'); //basic realm is the name of the scteuon that is protected 
    //and appears part of the pop-up prompt
    //head('HTTP/1.0 401 Unauthorized');
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
?>