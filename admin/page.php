<?php require_once('header.php'); ?>

<?php

if(isset($_POST['form_about'])) {

$valid = 1;

if(empty($_POST['about_title'])) {
$valid = 0;
$error_message .= 'O título não pode estar vazio<br>';
}

if(empty($_POST['about_content'])) {
$valid = 0;
$error_message .= 'O conteúdo não pode estar vazio<br>';
}

$path = $_FILES['about_banner']['name'];
$path_tmp = $_FILES['about_banner']['tmp_name'];

if($path != '') {
$ext = pathinfo( $path, PATHINFO_EXTENSION );
$file_name = basename( $path, '.' . $ext );
if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
$valid = 0;
$error_message .= 'Você deve fazer upload de um arquivo jpg, jpeg, gif ou png<br>';
}
}

if($valid == 1) {

if($path != '') {
// removing the existing photo
$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
foreach ($result as $row) {
$about_banner = $row['about_banner'];
unlink('../assets/uploads/'.$about_banner);
}

// updating the data
$final_name = randNumber().'.'.$ext;
move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

// updating the database
$statement = $pdo->prepare("UPDATE tbl_page SET about_title=?,about_content=?,about_banner=?,about_meta_title=?,about_meta_keyword=?,about_meta_description=? WHERE id=1");
$statement->execute(array($_POST['about_title'],$_POST['about_content'],$final_name,$_POST['about_meta_title'],$_POST['about_meta_keyword'],$_POST['about_meta_description']));
} else {
// updating the database
$statement = $pdo->prepare("UPDATE tbl_page SET about_title=?,about_content=?,about_meta_title=?,about_meta_keyword=?,about_meta_description=? WHERE id=1");
$statement->execute(array($_POST['about_title'],$_POST['about_content'],$_POST['about_meta_title'],$_POST['about_meta_keyword'],$_POST['about_meta_description']));
}

$success_message = 'Sobre a página As informações foram atualizadas com sucesso.';
header("Location:".BASE_URL);
exit();

}

}



if(isset($_POST['form_faq'])) {

$valid = 1;

if(empty($_POST['faq_title'])) {
$valid = 0;
$error_message .= 'O título não pode estar vazio<br>';
}

$path = $_FILES['faq_banner']['name'];
$path_tmp = $_FILES['faq_banner']['tmp_name'];

if($path != '') {
$ext = pathinfo( $path, PATHINFO_EXTENSION );
$file_name = basename( $path, '.' . $ext );
if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
$valid = 0;
$error_message .= 'Você deve fazer upload de um arquivo jpg, jpeg, gif ou png<br>';
}
}

if($valid == 1) {

if($path != '') {
// removing the existing photo
$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
foreach ($result as $row) {
$faq_banner = $row['faq_banner'];
unlink('../assets/uploads/'.$faq_banner);
}

// updating the data
$final_name = randNumber().'.'.$ext;
move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

// updating the database
$statement = $pdo->prepare("UPDATE tbl_page SET faq_title=?,faq_banner=?,faq_meta_title=?,faq_meta_keyword=?,faq_meta_description=? WHERE id=1");
$statement->execute(array($_POST['faq_title'],$final_name,$_POST['faq_meta_title'],$_POST['faq_meta_keyword'],$_POST['faq_meta_description']));
} else {
// updating the database
$statement = $pdo->prepare("UPDATE tbl_page SET faq_title=?,faq_meta_title=?,faq_meta_keyword=?,faq_meta_description=? WHERE id=1");
$statement->execute(array($_POST['faq_title'],$_POST['faq_meta_title'],$_POST['faq_meta_keyword'],$_POST['faq_meta_description']));
}

$success_message = 'As informações da página de perguntas frequentes foram atualizadas com sucesso.';
header("Location:".BASE_URL);
exit();
}

}



if(isset($_POST['form_contact'])) {

$valid = 1;

if(empty($_POST['contact_title'])) {
$valid = 0;
$error_message .= 'O título não pode estar vazio<br>';
}

$path = $_FILES['contact_banner']['name'];
$path_tmp = $_FILES['contact_banner']['tmp_name'];

if($path != '') {
$ext = pathinfo( $path, PATHINFO_EXTENSION );
$file_name = basename( $path, '.' . $ext );
if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
$valid = 0;
$error_message .= 'Você deve fazer upload de um arquivo jpg, jpeg, gif ou png<br>';
}
}

if($valid == 1) {

if($path != '') {
// removing the existing photo
$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
foreach ($result as $row) {
$contact_banner = $row['contact_banner'];
unlink('../assets/uploads/'.$contact_banner);
}

// updating the data
$final_name = randNumber().'.'.$ext;
move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

// updating the database
$statement = $pdo->prepare("UPDATE tbl_page SET contact_title=?,contact_banner=?,contact_meta_title=?,contact_meta_keyword=?,contact_meta_description=? WHERE id=1");
$statement->execute(array($_POST['contact_title'],$final_name,$_POST['contact_meta_title'],$_POST['contact_meta_keyword'],$_POST['contact_meta_description']));
} else {
// updating the database
$statement = $pdo->prepare("UPDATE tbl_page SET contact_title=?,contact_meta_title=?,contact_meta_keyword=?,contact_meta_description=? WHERE id=1");
$statement->execute(array($_POST['contact_title'],$_POST['contact_meta_title'],$_POST['contact_meta_keyword'],$_POST['contact_meta_description']));
}

$success_message = 'As informações da página de contato foram atualizadas com sucesso.';
header("Location:".BASE_URL);
exit();

}

}


?>

<?php if($_SESSION['user']['role'] == 'Vendedor'):?>
   
    <div class="alert alert-danger alert-dismissible text-dark">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Aviso!</strong> <?= $_SESSION['user']['full_name'] ?> não tem permissão para acessar essa pagina </div>'
<?php else: ?>

<section class="content-header">
<div class="content-header-left">
<h1>Configurações de página</h1>
</div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
foreach ($result as $row) {
$about_title = $row['about_title'];
$about_content = $row['about_content'];
$about_banner = $row['about_banner'];
$about_meta_title = $row['about_meta_title'];
$about_meta_keyword = $row['about_meta_keyword'];
$about_meta_description = $row['about_meta_description'];
$faq_title = $row['faq_title'];
$faq_banner = $row['faq_banner'];
$faq_meta_title = $row['faq_meta_title'];
$faq_meta_keyword = $row['faq_meta_keyword'];
$faq_meta_description = $row['faq_meta_description'];
$contact_title = $row['contact_title'];
$contact_banner = $row['contact_banner'];
$contact_meta_title = $row['contact_meta_title'];
$contact_meta_keyword = $row['contact_meta_keyword'];
$contact_meta_description = $row['contact_meta_description'];

}
?>


<section class="content" style="min-height:auto;margin-bottom: -30px;">
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
</div>
</div>
</section>

<section class="content">

<div class="row">
<div class="col-md-12">

<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#tab_1" data-toggle="tab">Sobre nós</a></li>
<li><a href="#tab_2" data-toggle="tab">Perguntas frequentes</a></li>
<li><a href="#tab_4" data-toggle="tab">Contato</a></li>

</ul>

<!-- About us Page Content -->

<div class="tab-content">
<div class="tab-pane active" id="tab_1">
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
<div class="box box-info">
<div class="box-body">
<div class="form-group">
<label for="" class="col-sm-3 control-label">Título da página * </label>
<div class="col-sm-5">
<input class="form-control" type="text" name="about_title" value="<?php echo $about_title; ?>">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Conteúdo da página * </label>
<div class="col-sm-8">
<textarea class="form-control" name="about_content" id="editor1"><?php echo $about_content; ?></textarea>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Foto de banner existente</label>
<div class="col-sm-6" style="padding-top:6px;">
<img src="../assets/uploads/<?php echo $about_banner; ?>" class="existing-photo" style="height:80px;">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Nova foto do banner</label>
<div class="col-sm-6" style="padding-top:6px;">
<input type="file" name="about_banner">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Meta Title</label>
<div class="col-sm-8">
<input class="form-control" type="text" name="about_meta_title" value="<?php echo $about_meta_title; ?>">
</div>
</div>             
<div class="form-group">
<label for="" class="col-sm-3 control-label">Meta palavra-chave</label>
<div class="col-sm-8">
<textarea class="form-control" name="about_meta_keyword" style="height:100px;"><?php echo $about_meta_keyword; ?></textarea>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Meta descrição </label>
<div class="col-sm-8">
<textarea class="form-control" name="about_meta_description" style="height:100px;"><?php echo $about_meta_description; ?></textarea>
</div>
</div>                                    
<div class="form-group">
<label for="" class="col-sm-3 control-label"></label>
<div class="col-sm-6">
<button type="submit" class="btn btn-success pull-left" name="form_about">Atualizar</button>
</div>
</div>
</div>
</div>
</form>
</div>

<!-- FAQ Page Content -->

<div class="tab-pane" id="tab_2">
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
<div class="box box-info">
<div class="box-body">
<div class="form-group">
<label for="" class="col-sm-3 control-label">Título da página * </label>
<div class="col-sm-5">
<input class="form-control" type="text" name="faq_title" value="<?php echo $faq_title; ?>">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Foto de banner existente</label>
<div class="col-sm-6" style="padding-top:6px;">
<img src="../assets/uploads/<?php echo $faq_banner; ?>" class="existing-photo" style="height:80px;">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Nova foto do banner</label>
<div class="col-sm-6" style="padding-top:6px;">
<input type="file" name="faq_banner">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Meta Titulo</label>
<div class="col-sm-8">
<input class="form-control" type="text" name="faq_meta_title" value="<?php echo $faq_meta_title; ?>">
</div>
</div>             
<div class="form-group">
<label for="" class="col-sm-3 control-label">Meta palavra-chave </label>
<div class="col-sm-8">
<textarea class="form-control" name="faq_meta_keyword" style="height:100px;"><?php echo $faq_meta_keyword; ?></textarea>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Meta descrição </label>
<div class="col-sm-8">
<textarea class="form-control" name="faq_meta_description" style="height:100px;"><?php echo $faq_meta_description; ?></textarea>
</div>
</div>                                    
<div class="form-group">
<label for="" class="col-sm-3 control-label"></label>
<div class="col-sm-6">
<button type="submit" class="btn btn-success pull-left" name="form_faq">Atualizar</button>
</div>
</div>
</div>
</div>
</form>
</div>

<!-- End of FAQ Page Content -->

<div class="tab-pane" id="tab_4">
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
<div class="box box-info">
<div class="box-body">
<div class="form-group">
<label for="" class="col-sm-3 control-label">Titulo Da Pagina * </label>
<div class="col-sm-5">
<input class="form-control" type="text" name="contact_title" value="<?php echo $contact_title; ?>">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Foto de banner existente</label>
<div class="col-sm-6" style="padding-top:6px;">
<img src="../assets/uploads/<?php echo $contact_banner; ?>" class="existing-photo" style="height:80px;">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Nova foto do banner</label>
<div class="col-sm-6" style="padding-top:6px;">
<input type="file" name="contact_banner">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Meta Titulo</label>
<div class="col-sm-8">
<input class="form-control" type="text" name="contact_meta_title" value="<?php echo $contact_meta_title; ?>">
</div>
</div>             
<div class="form-group">
<label for="" class="col-sm-3 control-label">Meta palavra-chave </label>
<div class="col-sm-8">
<textarea class="form-control" name="contact_meta_keyword" style="height:100px;"><?php echo $contact_meta_keyword; ?></textarea>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Meta descrição </label>
<div class="col-sm-8">
<textarea class="form-control" name="contact_meta_description" style="height:100px;"><?php echo $contact_meta_description; ?></textarea>
</div>
</div>                                    
<div class="form-group">
<label for="" class="col-sm-3 control-label"></label>
<div class="col-sm-6">
<button type="submit" class="btn btn-success pull-left" name="form_contact">Atualizar</button>
</div>
</div>
</div>
</div>
</form>
</div>





</form>
</div>
</div>

</section>
<?php endif?>

<?php require_once('footer.php'); ?>