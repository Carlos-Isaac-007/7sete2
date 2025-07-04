<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;

    if(empty($_POST['bairro_name'])) {
        $valid = 0;
        $error_message .= "Nome do Bairro não pode estar vazio <br>";
    } else {
		// Duplicate Country checking
    	// current Country name that is in the database
    	$statement = $pdo->prepare("SELECT * FROM tbl_bairro WHERE bairro_id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) {
			$current_bairro_name = $row['nome_bairro'];
		}

		$statement = $pdo->prepare("SELECT * FROM tbl_bairro WHERE nome_bairro =? and nome_bairro!=?");
    	$statement->execute(array($_POST['bairro_name'],$current_bairro_name));
    	$total = $statement->rowCount();							
    	if($total) {
    		$valid = 0;
        	$error_message .= 'Nome do Bairro ja existe<br>';
    	}
    }

    if($valid == 1) {    	
		// updating into the database
		$statement = $pdo->prepare("UPDATE tbl_bairro SET nome_bairro=? WHERE bairro_id=?");
		$statement->execute(array($_POST['bairro_name'],$_REQUEST['id']));

    	$success_message = 'Bairro Atualizado com sucesso.';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_bairro WHERE bairro_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Editar Bairro</h1>
	</div>
	<div class="content-header-right">
		<a href="bairro.php" class="btn btn-primary btn-sm">Ver Todos</a>
	</div>
</section>


<?php							
foreach ($result as $row) {
	$bairro_name = $row['nome_bairro'];
}
?>

<section class="content">

  <div class="row">
    <div class="col-md-12">

		<?php if($error_message): ?>
		<div class="callout callout-danger">
		
		<p>
		<?php echo $error_message; ?>
		</p>
		</div>
		<?php endif; ?>

		<?php if($success_message): ?>
		<div class="callout callout-success">
		
		<p><?php echo $success_message; ?></p>
		</div>
		<?php endif; ?>

        <form class="form-horizontal" action="" method="post">

        <div class="box box-info">

            <div class="box-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Nome do Bairro<span>*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="bairro_name" value="<?php echo $bairro_name; ?>">
                    </div>
                </div>
                <div class="form-group">
                	<label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-success pull-left" name="form1">Atualizar</button>
                    </div>
                </div>

            </div>

        </div>

        </form>



    </div>
  </div>

</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirmar </h4>
            </div>
            <div class="modal-body">
                Certeza que quer apagar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger btn-ok">Apagar</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>