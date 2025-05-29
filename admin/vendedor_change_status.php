<?php require_once('header.php'); ?>

<?php
if(!isset($_GET['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE id=?");
	$statement->execute(array($_GET['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	} else {
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) {
			$status = $row['status'];
		}
	}
}
?>

<?php
if($status == "") {$final = "Active";} else {$final = "";}
$statement = $pdo->prepare("UPDATE tbl_user SET status=? WHERE id=?");
$statement->execute(array($final,$_GET['id']));

header('location: vendedor.php');
?>