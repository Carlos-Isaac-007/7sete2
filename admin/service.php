<?php require_once('header.php'); ?>
<?php if($_SESSION['user']['role'] == 'Vendedor'):?>
   
    <div class="alert alert-danger alert-dismissible text-dark">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Aviso!</strong> <?= $_SESSION['user']['full_name'] ?> não tem permissão para acessar essa pagina </div>'
<?php else: ?>

<section class="content-header">
<div class="content-header-left">
<h1>Ver serviços</h1>
</div>
<div class="content-header-right">
<a href="service-add.php" class="btn btn-primary btn-sm">Adicionar serviço</a>
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
<th width="30">#</th>
<th>Foto</th>
<th width="100">Título</th>
<th>Conteudo</th>
<th width="80">Ação</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$statement = $pdo->prepare("SELECT * FROM tbl_service");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
$i++;
?>
<tr>
<td><?php echo $i; ?></td>
<td style="width:130px;"><img src="../assets/uploads/<?php echo $row['photo']; ?>" alt="<?php echo $row['title']; ?>" style="width:120px;"></td>
<td><?php echo $row['title']; ?></td>
<td><?php echo $row['content']; ?></td>
<td>										
<a href="service-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-xs">Editar</a>
<a href="#" class="btn btn-danger btn-xs" data-href="service-delete.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete">Apagar</a>  
</td>
</tr>
<?php
}
?>							
</tbody>
</table>
</div>
</div>
</div>
</div>


</section>

<?php endif?>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel">Confirmar a Exclução</h4>
</div>
<div class="modal-body">
<p>Tem certeza de que deseja excluir este item?</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
<a class="btn btn-danger btn-ok">Apagar</a>
</div>
</div>
</div>
</div>


<?php require_once('footer.php'); ?>