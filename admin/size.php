<?php require_once('header.php'); ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Sizes</h1>
	</div>
	<div class="content-header-right">
		<a href="size-add.php" class="btn btn-primary btn-sm">Add Novo</a>
	</div>
</section>


<section class="content">

  <div class="row">
    <div class="col-md-12">


      <div class="box box-info">
        
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-hover table-striped">
			<thead>
			    <tr>
			        <th>#</th>
			        <th>Nome do Tamanho</th>
			        <th>Acção</th>
			    </tr>
			</thead>
            <tbody>
            	<?php
            	$i=0;
            	$statement = $pdo->prepare("SELECT * FROM tbl_size ORDER BY size_id ASC");
            	$statement->execute();
            	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
            	foreach ($result as $row) {
            		$i++;
            		?>
					<tr>
	                    <td><?php echo $i; ?></td>
	                    <td><?php echo $row['size_name']; ?></td>
	                    <td>
	                        <a href="size-edit.php?id=<?php echo $row['size_id']; ?>" class="btn btn-primary btn-xs">Editar</a>
	                        <a href="#" class="btn btn-danger btn-xs" data-href="size-delete.php?id=<?php echo $row['size_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Apagar</a>
	                    </td>
	                </tr>
            		<?php
            	}
            	?>
            </tbody>
          </table>
        </div>
      </div>
  

</section>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirmar o Apagamento</h4>
            </div>
            <div class="modal-body">
                Tem certeza que quer apagar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger btn-ok">Apagar</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>