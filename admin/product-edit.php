<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
header('location: logout.php');
exit;
} else {
// Check the id is valid or not
$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
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
<h1>Editar Producto</h1>
</div>
<div class="content-header-right">
<a href="product.php" class="btn btn-primary btn-sm">Ver Todos</a>
</div>
</section>

<?php
if (!isset($_REQUEST['id']) || !is_numeric($_REQUEST['id'])) {
    die("ID inválido.");
}

$p_id = $_REQUEST['id']; // Armazena o ID para evitar múltiplas chamadas a $_REQUEST

// Consulta para obter os detalhes do produto
$statement = $pdo->prepare("
    SELECT * FROM tbl_product WHERE p_id = ?
");
$statement->execute([$p_id]);
$row = $statement->fetch(PDO::FETCH_ASSOC);


if (!$row) {
    die("Produto não encontrado.");
}

// Atribuição dos valores do produto
$p_name = $row['p_name'];
$p_old_price = $row['p_old_price'];
$p_current_price = $row['p_current_price'];
$p_qty = $row['p_qty'];
$p_featured_photo = $row['p_featured_photo'];
$p_description = $row['p_description'];
$p_short_description = $row['p_short_description'];
$p_feature = $row['p_feature'];
$p_condition = $row['p_condition'];
$p_return_policy = $row['p_return_policy'];
$p_is_featured = $row['p_is_featured'];
$p_is_active = $row['p_is_active'];
$ecat_id = $row['ecat_id'];
$brand_path = $row['brand'];
// Consulta para obter a categoria do produto
$statement = $pdo->prepare("
    SELECT t1.ecat_name, t2.mcat_id, t3.tcat_id
    FROM tbl_end_category t1
    JOIN tbl_mid_category t2 ON t1.mcat_id = t2.mcat_id
    JOIN tbl_top_category t3 ON t2.tcat_id = t3.tcat_id
    WHERE t1.ecat_id = ?
");
$statement->execute([$ecat_id]);
$row = $statement->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $ecat_name = $row['ecat_name'];
    $mcat_id = $row['mcat_id'];
    $tcat_id = $row['tcat_id'];
} else {
    $ecat_name = $mcat_id = $tcat_id = null;
}

// Consulta para obter os tamanhos do produto
$size_id = [];
$statement = $pdo->prepare("SELECT size_id FROM tbl_product_size WHERE p_id = ?");
$statement->execute([$p_id]);
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $size_id[] = $row['size_id'];
}

// Consulta para obter as cores do produto
$color_id = [];
$statement = $pdo->prepare("SELECT color_id FROM tbl_product_color WHERE p_id = ?");
$statement->execute([$p_id]);
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $color_id[] = $row['color_id'];
}
?>

<?php
if(isset($_POST['form1'])) {
$valid = 1;

if(empty($_POST['tcat_id'])) {
$valid = 0;
$error_message .= "Você deve selecionar uma categoria de nível superior<br>";
}

if(empty($_POST['mcat_id'])) {
$valid = 0;
$error_message .= "Você deve selecionar uma categoria de nível médio<br>";
}

if(empty($_POST['ecat_id'])) {
$valid = 0;
$error_message .= "Você deve selecionar uma categoria de nível final<br>";
}

if(empty($_POST['p_name'])) {
$valid = 0;
$error_message .= "O nome do produto não pode estar vazio<br>";
}

if(empty($_POST['p_current_price'])) {
$valid = 0;
$error_message .= "O preço atual não pode estar vazio<br>";
}

if(empty($_POST['p_qty'])) {
$valid = 0;
$error_message .= "Quantidade não pode estar vazia<br>";
}

$path = $_FILES['p_featured_photo']['name'];
$path_tmp = $_FILES['p_featured_photo']['tmp_name'];

if($path!='') {
$ext = pathinfo( $path, PATHINFO_EXTENSION );
$file_name = basename( $path, '.' . $ext );
if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' && $ext!='webp' ) {
$valid = 0;
$error_message .= 'Você deve fazer upload de um arquivo jpg, jpeg, gif ou png<br>';
}
}


$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
   // Validação da Brand (Logo da Marca)
    if(isset($_FILES['brand']['name']) && $_FILES['brand']['name'] != '') {
        $brand_antiga = $brand_path;
        $brand_path = null;
        $brand_tmp = null;
        $brand_path = $_FILES['brand']['name'];
        $brand_tmp = $_FILES['brand']['tmp_name'];
        
        $brand_ext = strtolower(pathinfo($brand_path, PATHINFO_EXTENSION));

        if(!in_array($brand_ext, $allowed_extensions)) {
            $valid = 0;
            $error_message .= 'A Brand deve estar no formato jpg, jpeg, png, gif ou webp<br>';
        }
    } else {
        $valid = 1;
 
}

if($valid == 1) {

if( isset($_FILES['photo']["name"]) && isset($_FILES['photo']["tmp_name"]) )
{

$photo = array();
$photo = $_FILES['photo']["name"];
$photo = array_values(array_filter($photo));

$photo_temp = array();
$photo_temp = $_FILES['photo']["tmp_name"];
$photo_temp = array_values(array_filter($photo_temp));

$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_product_photo'");
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row) {
$next_id1=$row[10];
}
$z = $next_id1;

$m=0;
for($i=0;$i<count($photo);$i++)
{
$my_ext1 = pathinfo( $photo[$i], PATHINFO_EXTENSION );
if( $my_ext1=='jpg' || $my_ext1=='png' || $my_ext1=='jpeg' || $my_ext1=='gif' ) {
$final_name1[$m] = $z.'.'.$my_ext1;
move_uploaded_file($photo_temp[$i],"../assets/uploads/product_photos/".$final_name1[$m]);
$m++;
$z++;
}
}

if(isset($final_name1)) {
for($i=0;$i<count($final_name1);$i++)
{
$statement = $pdo->prepare("INSERT INTO tbl_product_photo (photo,p_id) VALUES (?,?)");
$statement->execute(array($final_name1[$i],$_REQUEST['id']));
}
}            
}

// removendo espaco com ..
$valor_current = $_POST['p_current_price'];
// Remove tudo que não seja número ou vírgula/ponto
$valor_limpo = preg_replace('/[^\d.]/', '', $valor_current);
// Remove a parte decimal, mantendo apenas o valor inteiro
$valor_final = explode('.', $valor_limpo)[0];
// Remove a vírgula para obter o número correto
$valor_final = str_replace(',', '', $valor_final);
// fazendo tudo de novo para o preco antigo
$valor_old = $_POST['p_old_price'];
$valor_limpo_old = preg_replace('/[^\d.]/', '', $valor_old);
$valor_final_old = explode('.', $valor_limpo_old)[0];
$valor_final_old = str_replace(',', '', $valor_final_old);

$p_current_price = $valor_final;
$p_old_price = $valor_final_old;

if (isset($_FILES['brand']) && $_FILES['brand']['error'] !== UPLOAD_ERR_NO_FILE) {
    // Um arquivo foi enviado com sucesso
 $final_brand_name = randNumber().str_replace(" ", "" , $brand_path);
 //$clean_filename = str_replace(" ", "", $filename);
  // movendo a brand no .... local dele 
move_uploaded_file($brand_tmp, '../assets/uploads/'.$final_brand_name); 

$full_path = '../assets/uploads/' . $brand_antiga;

if (file_exists($full_path)) {
    unlink($full_path);
} else {
    echo "Erro ao apagar. Caminho tentado: " . $full_path;
    die;
}
}else{
    $final_brand_name = $brand_path;
}



if($path == '') {
$statement = $pdo->prepare("UPDATE tbl_product SET 
p_name=?, 
p_old_price=?, 
p_current_price=?, 
p_qty=?,
brand=?,
p_description=?,
p_short_description=?,
p_feature=?,
p_condition=?,
p_return_policy=?,
p_is_featured=?,
p_is_active=?,
ecat_id=?
WHERE p_id=?");
$statement->execute(array(
$_POST['p_name'],
$p_old_price,
$p_current_price,
$_POST['p_qty'],
$final_brand_name,
$_POST['p_description'],
$_POST['p_short_description'],
$_POST['p_feature'],
$_POST['p_condition'],
$_POST['p_return_policy'],
$_POST['p_is_featured'],
$_POST['p_is_active'],
$_POST['ecat_id'],
$_REQUEST['id']
));
} else {

$fotoAtual = "../assets/uploads/".$_POST['current_photo'];
if(file_exists($fotoAtual) && is_file($fotoAtual)){
    unlink($fotoAtual);
}

$final_name = randNumber().'.'.$ext;
move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );



$statement = $pdo->prepare("UPDATE tbl_product SET 
p_name=?, 
p_old_price=?, 
p_current_price=?, 
p_qty=?,
p_featured_photo=?,
brand =?,
p_description=?,
p_short_description=?,
p_feature=?,
p_condition=?,
p_return_policy=?,
p_is_featured=?,
p_is_active=?,
ecat_id=?
WHERE p_id=?");
$statement->execute(array(
$_POST['p_name'],
$p_old_price,
$p_current_price,
$_POST['p_qty'],
$final_name,
$final_brand_name,
$_POST['p_description'],
$_POST['p_short_description'],
$_POST['p_feature'],
$_POST['p_condition'],
$_POST['p_return_policy'],
$_POST['p_is_featured'],
$_POST['p_is_active'],
$_POST['ecat_id'],
$_REQUEST['id']
));
}


if(isset($_POST['size'])) {

$statement = $pdo->prepare("DELETE FROM tbl_product_size WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));

foreach($_POST['size'] as $value) {
$statement = $pdo->prepare("INSERT INTO tbl_product_size (size_id,p_id) VALUES (?,?)");
$statement->execute(array($value,$_REQUEST['id']));
}
} else {
$statement = $pdo->prepare("DELETE FROM tbl_product_size WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
}

if(isset($_POST['color'])) {

$statement = $pdo->prepare("DELETE FROM tbl_product_color WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));

foreach($_POST['color'] as $value) {
$statement = $pdo->prepare("INSERT INTO tbl_product_color (color_id,p_id) VALUES (?,?)");
$statement->execute(array($value,$_REQUEST['id']));
}
} else {
$statement = $pdo->prepare("DELETE FROM tbl_product_color WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
}

$success_message = 'Produto Atualizado com sucesso.';
header("Location: product-edit.php?id=$p_id&success=1");
exit;
}
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

<?php if (isset($_GET['success'])): ?>
<div class="callout callout-success">
    Produto atualizado com sucesso.
</div>
<?php endif; ?>
<!--<?php if($success_message): ?>
<div class="callout callout-success">

<p><?php echo $success_message; ?></p>
</div>
<?php endif; ?>-->

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="box box-info">
<div class="box-body">
<div class="form-group">
<label for="" class="col-sm-3 control-label">Nome da categoria de nível superior<span>*</span></label>
<div class="col-sm-4">
<select name="tcat_id" class="form-control select2 top-cat">
<option value="">Selecione a categoria de nível superior</option>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_top_category ORDER BY tcat_name ASC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);   
foreach ($result as $row) {
?>
<option value="<?php echo $row['tcat_id']; ?>" <?php if($row['tcat_id'] == $tcat_id){echo 'selected';} ?>><?php echo $row['tcat_name']; ?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Nome da categoria de nível médio <span>*</span></label>
<div class="col-sm-4">
<select name="mcat_id" class="form-control select2 mid-cat">
<option value="">Selecione a categoria de nível médio</option>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_mid_category WHERE tcat_id = ? ORDER BY mcat_name ASC");
$statement->execute(array($tcat_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);   
foreach ($result as $row) {
?>
<option value="<?php echo $row['mcat_id']; ?>" <?php if($row['mcat_id'] == $mcat_id){echo 'selected';} ?>><?php echo $row['mcat_name']; ?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Nome da categoria de nível final <span>*</span></label>
<div class="col-sm-4">
<select name="ecat_id" class="form-control select2 end-cat">
<option value="">selecione Categoria de nível final</option>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_end_category WHERE mcat_id = ? ORDER BY ecat_name ASC");
$statement->execute(array($mcat_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);   
foreach ($result as $row) {
?>
<option value="<?php echo $row['ecat_id']; ?>" <?php if($row['ecat_id'] == $ecat_id){echo 'selected';} ?>><?php echo $row['ecat_name']; ?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Nome do produto <span>*</span></label>
<div class="col-sm-4">
<input type="text" name="p_name" class="form-control" value="<?php echo $p_name; ?>">
</div>
</div>	
<div class="form-group">
<label for="" class="col-sm-3 control-label">Preço antigo<br><span style="font-size:10px;font-weight:normal;">(Em KZ)</span></label>
<div class="col-sm-4">
<input type="text" name="p_old_price" class="form-control" value="<?php echo $p_old_price; ?>">
</div>
</div>	
<div class="form-group">
<label for="" class="col-sm-3 control-label">Preço Atual <span>*</span><br><span style="font-size:10px;font-weight:normal;">(Em KZ)</span></label>
<div class="col-sm-4">
<input type="text" name="p_current_price" class="form-control" value="<?php echo $p_current_price; ?>">
</div>
</div>	
<div class="form-group">
<label for="" class="col-sm-3 control-label">Quantidade <span>*</span></label>
<div class="col-sm-4">
<input type="text" name="p_qty" class="form-control" value="<?php echo $p_qty; ?>">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Selecionar Tamanho</label>
<div class="col-sm-4">
<select name="size[]" class="form-control select2" multiple="multiple">
<?php
$is_select = '';
$statement = $pdo->prepare("SELECT * FROM tbl_size ORDER BY size_id ASC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);			
foreach ($result as $row) {
if(isset($size_id)) {
if(in_array($row['size_id'],$size_id)) {
$is_select = 'selected';
} else {
$is_select = '';
}
}
?>
<option value="<?php echo $row['size_id']; ?>" <?php echo $is_select; ?>><?php echo $row['size_name']; ?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Selecionar Cor</label>
<div class="col-sm-4">
<select name="color[]" class="form-control select2" multiple="multiple">
<?php
$is_select = '';
$statement = $pdo->prepare("SELECT * FROM tbl_color ORDER BY color_id ASC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);			
foreach ($result as $row) {
if(isset($color_id)) {
if(in_array($row['color_id'],$color_id)) {
$is_select = 'selected';
} else {
$is_select = '';
}
}
?>
<option value="<?php echo $row['color_id']; ?>" <?php echo $is_select; ?>><?php echo $row['color_name']; ?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Foto em destaque existente</label>
<div class="col-sm-4" style="padding-top:4px;">
<img src="../assets/uploads/<?php echo $p_featured_photo; ?>" alt="" style="width:150px;">
<input type="hidden" name="current_photo" value="<?php echo $p_featured_photo; ?>">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Alterar foto em destaque </label>
<div class="col-sm-4" style="padding-top:4px;">
<input type="file" name="p_featured_photo">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Outras fotos</label>
<div class="col-sm-4" style="padding-top:4px;">
<table id="ProductTable" style="width:100%;">
<tbody>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
?>
<tr>
<td>
<img src="../assets/uploads/product_photos/<?php echo $row['photo']; ?>" alt="" style="width:150px;margin-bottom:5px;">
</td>
<td style="width:28px;">
<a onclick="return confirmDelete();" href="product-other-photo-delete.php?id=<?php echo $row['pp_id']; ?>&id1=<?php echo $_REQUEST['id']; ?>" class="btn btn-danger btn-xs">X</a>
</td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
<div class="col-sm-2">
<input type="button" id="btnAddNew" value="Add Item" style="margin-top: 5px;margin-bottom:10px;border:0;color: #fff;font-size: 14px;border-radius:3px;" class="btn btn-warning btn-xs">
</div>
</div>

<div class="form-group">
<div class="aqui" style="margin-left:27%;"><img src="../assets/uploads/<?php echo $brand_path; ?>" alt="" style="width:150px;margin-bottom:5px;"></div>
 <label for="" class="col-sm-3 control-label">Adicone a sua brand</label>
<div class="col-sm-4" style="padding-top:4px;">
<input type="file" name="brand">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Descrição</label>
<div class="col-sm-8">
<textarea name="p_description" class="form-control" cols="30" rows="10" id="editor1"><?php echo $p_description; ?></textarea>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Sdescrição curta</label>
<div class="col-sm-8">
<textarea name="p_short_description" class="form-control" cols="30" rows="10" id="editor1"><?php echo $p_short_description; ?></textarea>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Destaque</label>
<div class="col-sm-8">
<textarea name="p_feature" class="form-control" cols="30" rows="10" id="editor3"><?php echo $p_feature; ?></textarea>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Condições</label>
<div class="col-sm-8">
<textarea name="p_condition" class="form-control" cols="30" rows="10" id="editor4"><?php echo $p_condition; ?></textarea>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Política de devolução</label>
<div class="col-sm-8">
<textarea name="p_return_policy" class="form-control" cols="30" rows="10" id="editor5"><?php echo $p_return_policy; ?></textarea>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Está em destaque?</label>
<div class="col-sm-8">
<select name="p_is_featured" class="form-control" style="width:auto;">
<option value="0" <?php if($p_is_featured == '0'){echo 'selected';} ?>>Não</option>
<option value="1" <?php if($p_is_featured == '1'){echo 'selected';} ?>>Sim</option>
</select> 
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Está ativo?</label>
<div class="col-sm-8">
<select name="p_is_active" class="form-control" style="width:auto;">
<option value="0" <?php if($p_is_active == '0'){echo 'selected';} ?>>Não</option>
<option value="1" <?php if($p_is_active == '1'){echo 'selected';} ?>>Sim</option>
</select> 
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label"></label>
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

<?php require_once('footer.php'); ?>