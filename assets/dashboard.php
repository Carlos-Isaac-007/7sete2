<?php require_once('header.php'); ?>

<?php
// Check if the customer is logged in or not
if(!isset($_SESSION['customer'])) {
header('location: '.URL.'logout');
exit;
} else {
// If customer is logged in, but admin make him inactive, then force logout this user.
$statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_id=? AND cust_status=?");
$statement->execute(array($_SESSION['customer']['cust_id'],0));
$total = $statement->rowCount();
if($total) {
header('location: '.URL.'logout');
exit;
}
}
?>

<div class="page">
<div class="container">
<div class="row">            
<div class="col-md-12"> 
<?php require_once('customer-sidebar.php'); ?>
</div>
<div class="col-md-12">
<div class="user-content">
</div>                
</div>
</div>
</div>
</div>

<?php require_once('footer.php'); ?>