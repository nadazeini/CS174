<?php
//CREATE TABLE malware(name VARCHAR(32) NOT NULL, content VARCHAR(32));
require_once 'login.php';
$conn = new mysqli($hn,$un,$pw,$db);
if($conn->connect_error){
    die ($conn->connect_error);
}
echo <<<_END

<pre> <h2 stye="display:inline; float:center;">USER OR ADMIN</h2> 
<form action="authent.php">
        <input type="submit" value="Admin login" />
    </form>
    <form action="user.php">
        <input type="submit" value="User Page" />
    </form>

_END;