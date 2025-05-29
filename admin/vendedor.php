<?php require_once('header.php'); ?>
<?php
$feedback = "";
if(isset($_POST['RegistarVendedor'])){

$role = addslashes($_POST['role']);
$email = $_POST['email'];
$password = addslashes($_POST['password']);
if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
$feedback .= "Email do trabalhador não pode estar vazio";
}

elseif (empty($password)){
$feedback .= "A password não pode estar vazia";
}else{

//  verificando se o email ja existe 
$statement1 = $pdo->prepare("SELECT * FROM tbl_user WHERE email=?");
$statement1->execute(array($email));
$total = $statement1->rowCount();                            
if($total) {
$feedback .= " Email ja existe"."<br>";
}else{
// saving into the database
$statement = $pdo->prepare("INSERT INTO tbl_user (email,password, role) VALUES (?,?,?)");
$statement->execute(array(
strip_tags($email),
md5($password),
$role
));
if($statement->rowCount()>0){
$feedback .= " Registrado com sucesso Assim que ". $email . " Ativar a sua conta vai aparecer na lista abaixo";

// eh aqui onde vai o codigo do email 
    $nome = "Ususario7Sete";
     $link_ativacao = URLADMIN."login.php";
    $assunto = "Detalhes de Login!";
    $mensagem = "Olá, $email. o seu cadastro foi feito com sucesso. \n\n Aqui estão os dados de acesso .\n\n Email: $email. \n\n Password: $password . \n\n Papel: $role .\n\nClique no link para continuar o cadastro: \n$link_ativacao";

    $feedback .=  enviarEmail($email, $nome, $assunto, $mensagem); 

}
}

}
}

?>

<?php if($_SESSION['user']['role'] == 'Vendedor'):?>
   
    <div class="alert alert-danger alert-dismissible text-dark">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Aviso!</strong> <?= $_SESSION['user']['full_name'] ?> não tem permissão para acessar essa pagina </div>'
<?php else: ?>

<section class="content-header ">
<div class="content-header-left  ">
<h1>Ver Trabalhadores</h1>
</div>

<div class="content-header-right">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mAddVendedor">
Cadastrar Trabalhadores
</button>
</div>
</>
</section>

<section class="content">
<?php 
if(isset($_POST['RegistarVendedor'])){
    echo '<div class="alert alert-danger alert-dismissible text-dark">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Aviso!</strong>'. $feedback .' </div>';
}
?>
<div class="row">
<div class="col-md-12">
<div class="box box-info">
<div class="box-body table-responsive">
<table id="example1" class="table table-bordered table-hover table-striped">
<thead>
<tr>
<th width="10">#</th>
<th width="180">Nome</th>
<th width="150">Endereço de email</th>
<th width="180">Provincia, Municio, Bairro</th>
<th>Status</th>
<th>Papel</th>
<th width="100">Alterar status</th>
<th width="100">Ação</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$statement = $pdo->prepare("SELECT * 
FROM tbl_user t1
JOIN tbl_country t2
ON t1.province = t2.country_id
");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);	
//echo "<pre>";
//print_r($result);
//die;					
foreach ($result as $row) {
$i++;
?>
<tr class="<?php if($row['status']=='Active') {echo 'bg-g';}else {echo 'bg-r';} ?>">
<td><?php echo $i; ?></td>
<td><?php echo $row['full_name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td>
<?php echo $row['country_name']; ?><br>
<?php echo $row['municipio']; ?><br>
<?php echo $row['bairro']; ?>
</td>

<td><?php if($row['status']=='Active') {echo 'Active';} else {echo 'Inactive';} ?>
</td>

<td>
<?php echo $row['role']; ?>  
</td>

<td>
<a href="vendedor_change_status.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-xs">Alterar status</a>
</td>
<td>
<a href="#" class="btn btn-danger btn-xs" data-href="vendedor_delete.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete">Apagar</a>
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
<h4 class="modal-title" id="myModalLabel">Comfirmar Exclução</h4>
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



<!-- Modal Registra Vendedor  -->
<div class="modal fade" id="mAddVendedor" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Registar Trabalhadores</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<form action="vendedor.php" method="post">
<div class="form-group">
<span id="emailHelpId" class="form-text text-dark ">Digite o email do trabalhador</span>
<input type="email" class="form-control" name="email" id="email"  placeholder="emaildovendedor@gmail.com" required="">
</div>

<div class="form-group">
  <span id="emailHelpId" class="form-text text-dark ">Digite a senha do trabalhador</span>
  <input type="password" class="form-control" name="password" id="password" placeholder="**************" required="">
</div>

<div class="form-group">
  <label for="">Seleciona o papel</label>
  <select class="form-control" name="role" id="role">
    <option value="Super Admin">Super Admin</option>
    <option class="Admin">Admin</option>
    <option value="Vendedor">Vendedor</option>
  </select>
</div>

<div class="mt-3">
<button type="submit" name="RegistarVendedor" class="btn btn-primary col-lg-12 col-12 col-md-12 col-sm-12">Registar</button>
</div>

</form>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

</div>
</div>
</div>
</div>

<?php require_once('footer.php'); ?>