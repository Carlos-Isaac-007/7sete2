<?php require_once('header.php'); ?>


<?php if($_SESSION['user']['role'] == 'Vendedor'):?>
   
    <div class="alert alert-danger alert-dismissible text-dark">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Aviso!</strong> <?= $_SESSION['user']['full_name'] ?> não tem permissão para acessar essa pagina </div>'
<?php else: ?>
<style>
    .fa-star{
        color: #fad501!important;
    }
</style>
<section class="content-header">
	<div class="content-header-left">
		<h1>Avaliações do cliente</h1>
	</div>
	<div class="content-header-right">
		<a href="subscriber-remove.php" class="btn btn-primary btn-sm">..</a>
		<a href="subscriber-csv.php" class="btn btn-primary btn-sm">...</a>
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
			        <th>Avalição</th>
			        <th>Cometario</th>
			        <th>Nome do cliente</th>
			        <th>Data de Avalição</th>
			        <th>Action</th>
			    </tr>
			</thead>
            <tbody>
            	<?php
            	$i=0;
            	;
            	$statement = $pdo->prepare("SELECT a.nota, a.comentario, c.cust_name AS tbl_customer, a.data_avaliacao FROM avaliacoes a JOIN tbl_customer c ON a.cliente_id = c.cust_id  ORDER BY a.data_avaliacao DESC");
            	$statement->execute();
            	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            	foreach ($result as $row) {
            		$i++;
            		?>
					<tr>
	                    <td><?php echo $i; ?></td>
	                    <td>
	                        <?php echo $row['nota']; ?>
	                        <div class="rating">
                                <?php
                                $avg_rating = $row['nota'];
                                if($avg_rating == 0) {
                                echo '';
                                }
                                elseif($avg_rating == 1) {
                                echo '
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                ';
                                } 
                                elseif($avg_rating == 2) {
                                echo '
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                ';
                                }
                                elseif($avg_rating == 3) {
                                echo '
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <i class="fa fa-star-o"></i>
                                ';
                                }
                                elseif($avg_rating == 4) {
                                echo '
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                ';
                                }
                                else {
                                for($i=1;$i<=5;$i++) {
                                ?>
                                <?php if($i>$avg_rating): ?>
                                <i class="fa fa-star-o "></i>
                                <?php else: ?>
                                <i class="fa fa-star"></i>
                                <?php endif; ?>
                                <?php
                                }
                                }                                    
                                ?>
                                </div>
	                    
	                    </td>
	                    <td><?php echo $row['comentario']; ?></td>
	                    <td><?php echo $row['tbl_customer']; ?></td>
	                    <td><?php echo $row['data_avaliacao']; ?></td>
	                    <td><a href="#" class="btn btn-danger btn-xs" data-href="subscriber-delete.php?id=<?php echo $row['subs_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</a></td>
	                </tr>
            		<?php
            	}
            	?>
            </tbody>
          </table>
        </div>
      </div>
  

</section>
<?php endif ?>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>