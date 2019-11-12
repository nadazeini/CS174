<?php
session_start();
session_destroy();
echo 'You have been logged out from admin. <a href="authent.php">login again</a>';
echo <<<_END
<form action="index.php">
        <input type="submit" value="Menu Page" />
    </form>
_END;
?>