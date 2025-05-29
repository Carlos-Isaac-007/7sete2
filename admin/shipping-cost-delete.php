<?php require_once('header.php'); ?>

<?php
if( !isset($_GET['id']) ) {
	header('location: logout.php');
	exit;
} else {
   $id = $_GET['id'];
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_shipping_cost WHERE shipping_cost_id=?");
	$statement->execute(array($id));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php
	$statement = $pdo->prepare("DELETE FROM tbl_shipping_cost  WHERE shipping_cost_id=?");
	$statement->execute(array($id));

	header('location: shipping-cost.php');
	die;
?>