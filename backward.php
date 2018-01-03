<?php  
echo shell_exec('sudo -u pi -S bash /var/www/html/scripts/drivebackward.sh');
require '../backendnogit/db.php';
$sql = "INSERT INTO counter (Number) VALUES ('')";
$conn->query($sql);
?>