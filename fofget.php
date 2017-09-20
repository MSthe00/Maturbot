<?php 
require '../backendnogit/db.php';

$sql = "SELECT * FROM fof";
$result = $conn->query($sql);
$count = $result->num_rows;
$choice = rand(1, $count);

for ($x = 0; $x < $choice; $x++) {
	$row = $result->fetch_assoc();
}
$output = array("id"=>$row['id'], "text"=>$row['text']);
echo json_encode($output);

?>