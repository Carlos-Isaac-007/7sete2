<?php require_once('header.php'); ?>

<section class="content-header">
<div class="content-header-left">
<h1>Ver produtos</h1>
</div>
<div class="content-header-right">
<a href="product-add.php" class="btn btn-primary btn-sm">Adicionar produto</a>
</div>
</section>

<section class="content">
<div class="row">
<div class="col-md-12">
<div class="box box-info">
<div class="box-body table-responsive">
<table id="example1" class="table table-bordered table-hover table-striped">
<thead class="thead-dark">
<tr>
<th width="10">#</th>
<th>Foto</th>
<th width="160">Nome do Producto</th>
<th width="60">Preço antigo</th>
<th width="60">(C) Preço</th>
<th width="60">Quantidade</th>
<th>em Destaque?</th>
<th>Ativo?</th>
<th>Categoria</th>
<th width="80">Action</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$statement = $pdo->prepare("SELECT

t1.p_id,
t1.p_name,
t1.p_old_price,
t1.p_current_price,
t1.p_qty,
t1.p_featured_photo,
t1.p_is_featured,
t1.p_is_active,
t1.ecat_id,

t2.ecat_id,
t2.ecat_name,

t3.mcat_id,
t3.mcat_name,

t4.tcat_id,
t4.tcat_name

FROM tbl_product t1
JOIN tbl_end_category t2
ON t1.ecat_id = t2.ecat_id
JOIN tbl_mid_category t3
ON t2.mcat_id = t3.mcat_id
JOIN tbl_top_category t4
ON t3.tcat_id = t4.tcat_id
ORDER BY t1.p_qty ASC
");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
$i++;
?>
<tr <?= $row['p_qty']=='0' ? 'style = "background-color: #ffb3b3;"': ($row['p_qty'] <='10' ? 'style = "background-color: #fff7b3"' : '' )?>>
<td><?php echo $i; ?></td>
<td style="width:82px;"><img src="../assets/uploads/<?php echo $row['p_featured_photo']; ?>" alt="<?php echo $row['p_name']; ?>" style="width:80px;"></td>
<td><?php echo $row['p_name']; ?></td>
<td><?php echo $row['p_old_price']; ?>KZ</td>
<td><?php echo $row['p_current_price']; ?>KZ</td>
<td><?php echo $row['p_qty']; ?></td>
<td>
<?php if($row['p_is_featured'] == 1) {echo '<span class="badge badge-success" style="background-color:green;">Yes</span>';} else {echo '<span class="badge badge-success" style="background-color:red;">No</span>';} ?>
</td>
<td>
<?php if($row['p_is_active'] == 1) {echo '<span class="badge badge-success" style="background-color:green;">Yes</span>';} else {echo '<span class="badge badge-danger" style="background-color:red;">No</span>';} ?>
</td>
<td><?php echo $row['tcat_name']; ?><br><?php echo $row['mcat_name']; ?><br><?php echo $row['ecat_name']; ?></td>
<td>										
<a href="product-edit.php?id=<?php echo $row['p_id']; ?>" class="btn btn-primary btn-xs">Editar</a>
<a href="#" class="btn btn-danger btn-xs" data-href="product-delete.php?id=<?php echo $row['p_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Apagar</a>  
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


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel">Confirmação para apagar</h4>
</div>
<div class="modal-body">
<p>Tem certeza de que deseja excluir este item?</p>
<p style="color:red;">Cuidado! Este produto será excluído da tabela de pedidos, tabela de pagamentos, tabela de tamanhos, tabela de cores e tabela de classificação também.</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
<a class="btn btn-danger btn-ok">Apagar</a>
</div>
</div>
</div>
</div>

<?php require_once('footer.php'); ?>