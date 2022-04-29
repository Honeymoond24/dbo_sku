<?php 
function clear_admin_access()
{
    header('HTTP/1.1 401 Unauthorized');
    // die('Admin access turned off');
    header("Location: /");
}
clear_admin_access();

?>