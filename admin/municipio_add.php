<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form23'])) {
   
    
	$valid = 1;

    if(empty($_POST['country_id']) && ! is_numeric($_POST['country_id'])) {
        $valid = 0;
        $error_message .= "Nome da Provincia não pode estar vazio<br>";
    }
    elseif (empty($_POST['municio_name'])) {
       $valid = 0;
        $error_message .= "Nome do Municipio não pode estar vazio<br>";
    }
    
    else {
    	// Duplicate Category checking
    	$statement = $pdo->prepare("SELECT * FROM tbl_municipio WHERE nome=?");
    	$statement->execute(array($_POST['municio_name']));
    	$total = $statement->rowCount();
    	if($total)
    	{
    		$valid = 0;
        	$error_message .= "Nome do Municipio ja existe exists<br>";
    	}
    }

    if($valid == 1) {

		// Saving data into the main table tbl_country
		$statement = $pdo->prepare("INSERT INTO tbl_municipio (province_id,nome) VALUES (?,?)");
		$statement->execute(array($_POST['country_id'],$_POST['municio_name']));
	
    	$success_message = 'Municipio Adicionado com sucesso.';
    }
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Municipio</h1>
	</div>
	<div class="content-header-right">
		<a href="municipio.php" class="btn btn-primary btn-sm">Ver Todos</a>
	</div>
</section>


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
			      <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Seleciona a Provincia <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="country_id" class="form-control select2">
                                    <option value="">Seleciona a Provincia</option>
                                    <?php
                                    $statement = $pdo->prepare("SELECT * FROM tbl_country ");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                        
                                        ?>
                                        <option value="<?php echo $row['country_id']; ?>"><?php echo $row['country_name']; ?></option>
                                      <?php
                            
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

			          <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Digite o nome do Municipio <span>*</span></label>
                             <div class="col-sm-4">
                                <input type="text" class="form-control" name="municio_name">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form23">Adicionar</button>
                            </div>

			</form>


		</div>
	</div>

</section>

<?php require_once('footer.php'); ?>