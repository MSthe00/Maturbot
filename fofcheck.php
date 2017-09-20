<?php
require '../backendnogit/db.php';

$sql = "SELECT * FROM fof";
$result = $conn->query($sql);

for ($x = 0; $x < $_POST['id']; $x++) {
	$row = $result->fetch_assoc();
}
if ($row['status'] == $_POST['answer']) {
	echo "1";
} else {
	echo "0";
}

// 0 = Fiction, 1 = Fact


?>