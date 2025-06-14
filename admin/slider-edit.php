<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
$valid = 1;


$path = $_FILES['photo']['name'];
$path_tmp = $_FILES['photo']['tmp_name'];

if($path!='') {
$ext = pathinfo( $path, PATHINFO_EXTENSION );
$file_name = basename( $path, '.' . $ext );
if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
$valid = 0;
$error_message .= 'Você deve fazer upload de um arquivo jpg, jpeg, gif ou png<br>';
}
}

if($valid == 1) {

if($path == '') {
$statement = $pdo->prepare("UPDATE tbl_slider SET heading=?, content=?, button_text=?, button_url=?, position=? WHERE id=?");
$statement->execute(array($_POST['heading'],$_POST['content'],$_POST['button_text'],$_POST['button_url'],$_POST['position'],$_REQUEST['id']));
} else {
    // verficando antes de apagar um aquivo
$arquivo = '../assets/uploads/'.$_POST['current_photo'];
if( file_exists($arquivo)){
 unlink($arquivo);
}


$final_name = $path.$_REQUEST['id'].'.'.$ext;
move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

$statement = $pdo->prepare("UPDATE tbl_slider SET photo=?, heading=?, content=?, button_text=?, button_url=?, position=? WHERE id=?");
$statement->execute(array($final_name,$_POST['heading'],$_POST['content'],$_POST['button_text'],$_POST['button_url'],$_POST['position'],$_REQUEST['id']));
}	   

$success_message = 'O controle deslizante foi atualizado com sucesso!';

//header("Location:". BASE_URL);

}
}
?>

<?php
if(!isset($_REQUEST['id'])) {
header('location: logout.php');
exit;
} else {
// Check the id is valid or not
$statement = $pdo->prepare("SELECT * FROM tbl_slider WHERE id=?");
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
<h1>Editar controle deslizante</h1>
</div>
<div class="content-header-right">
<a href="slider.php" class="btn btn-primary btn-sm">Ver tudo</a>
</div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_slider WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
$photo       = $row['photo'];
$heading     = $row['heading'];
$content     = $row['content'];
$button_text = $row['button_text'];
$button_url  = $row['button_url'];
$position    = $row['position'];
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

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="current_photo" value="<?php echo $photo; ?>">
<div class="box box-info">
<div class="box-body">
<div class="form-group">
<label for="" class="col-sm-2 control-label">Ffoto existente</label>
<div class="col-sm-9" style="padding-top:5px">
<img src="../assets/uploads/<?php echo $photo; ?>" alt="Slider Photo" style="width:400px;">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-2 control-label">Foto </label>
<div class="col-sm-6" style="padding-top:5px">
<input type="file" name="photo">(Somente jpg, jpeg, gif e png são permitidos)
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-2 control-label">Cabeçalho</label>
<div class="col-sm-6">
<input type="text" autocomplete="off" class="form-control" name="heading" value="<?php echo $heading; ?>">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-2 control-label">Conteudo </label>
<div class="col-sm-6">
<textarea class="form-control" name="content" style="height:140px;"><?php echo $content; ?></textarea>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-2 control-label">
Texto do botão </label>
<div class="col-sm-6">
<input type="text" autocomplete="off" class="form-control" name="button_text" value="<?php echo $button_text; ?>">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-2 control-label">URL do botão</label>
<div class="col-sm-6">
<input type="text" autocomplete="off" class="form-control" name="button_url" value="<?php echo $button_url; ?>">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-2 control-label">Posição</label>
<div class="col-sm-6">
<select name="position" class="form-control">
<option value="Left" <?php if($position == 'Left') {echo 'selected';} ?>>Esquerda</option>
<option value="Center" <?php if($position == 'Center') {echo 'selected';} ?>>Centro</option>
<option value="Right" <?php if($position == 'Right') {echo 'selected';} ?>>Direita</option>
</select>
</div>
</div>				
<div class="form-group">
<label for="" class="col-sm-2 control-label"></label>
<div class="col-sm-6">
<button type="submit" class="btn btn-success pull-left" name="form1">Eviar</button>
</div>
</div>
</div>
</div>
</form>
</div>
</div>

</section>

<?php require_once('footer.php'); ?>