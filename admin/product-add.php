<?php require_once('header.php'); ?>

<?php



if(isset($_POST['form1'])) {
$valid = 1;



if(empty($_POST['tcat_id'])) {
$valid = 0;
$error_message .= "você deve selecionar uma categoria de nível superior<br>";
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
} else {
$valid = 0;
$error_message .= 'Você deve selecionar uma foto em destaque<br>';
}

$valid = 1; // Variável de controle para validação
$error_message = '';

// Lista de extensões permitidas
$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

// Validação da foto em destaque
if ($path != '') {
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION)); // Converte para minúsculas
    if (!in_array($ext, $allowed_extensions)) {
        $valid = 0;
        $error_message .= 'A Foto em Destaque deve estar no formato jpg, jpeg, png, gif ou webp<br>';
    }
} else {
    $valid = 0;
    $error_message .= 'Você deve selecionar uma Foto em Destaque<br>';
}

// Lista de extensões permitidas para eBook
$allowed_ebook_ext = ['pdf', 'epub', 'mobi'];

$ebook_path = $_FILES['ebook']['name'];
$ebook_tmp = $_FILES['ebook']['tmp_name'];

if ($ebook_path != '') {
    $ebook_ext = strtolower(pathinfo($ebook_path, PATHINFO_EXTENSION));
    if (!in_array($ebook_ext, $allowed_ebook_ext)) {
        $valid = 0;
        $error_message .= 'O eBook deve estar no formato PDF, EPUB ou MOBI<br>';
    }
} else {
    $valid = 0;
    $error_message .= 'Você deve selecionar um arquivo de eBook<br>';
}
if ($valid == 1) {
    // mover o ebook
    $final_ebook_name = rand() . '_' . time() . '.' . $ebook_ext;
    move_uploaded_file($ebook_tmp, '../assets/uploads/ebooks/' . $final_ebook_name);
}


   // Validação da Brand (Logo da Marca)
    if(isset($_FILES['brand']['name']) && $_FILES['brand']['name'] != '') {
        $brand_path = $_FILES['brand']['name'];
        $brand_tmp = $_FILES['brand']['tmp_name'];
        $brand_ext = strtolower(pathinfo($brand_path, PATHINFO_EXTENSION));

        if(!in_array($brand_ext, $allowed_extensions)) {
            $valid = 0;
            $error_message .= 'A Brand deve estar no formato jpg, jpeg, png, gif ou webp<br>';
        }
    } else {
        $valid = 1;
        $error_message .= 'Você deve selecionar uma Brand<br>';
    }

if($valid == 1) {

$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_product'");
$statement->execute();
$result = $statement->fetchAll();

foreach($result as $row) {
$ai_id=$row[5];
}

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
$next_id1=$row[5];
}

$z = $next_id1;

$m=0;
for($i=0;$i<count($photo);$i++)
{
$my_ext1 = pathinfo( $photo[$i], PATHINFO_EXTENSION );
if( $my_ext1=='jpg' || $my_ext1=='png' || $my_ext1=='jpeg' || $my_ext1=='gif' || $my_ext1=='webp' ) {
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
$statement->execute(array($final_name1[$i],$ai_id));
}
}            
}

$final_name = randNumber().'.'.$ext;

move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

// movendo a brand no .... local dele 
move_uploaded_file( $brand_tmp, '../assets/uploads/'.$brand_path );

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

//Saving data into the main table tbl_product
$statement = $pdo->prepare("INSERT INTO tbl_product(
p_name, 
p_old_price,
p_current_price,
p_qty,
p_qty_update,
p_featured_photo,
p_description,
p_short_description,
p_feature,
p_condition,
p_return_policy,
p_total_view,
p_is_featured,
p_is_active,
ecat_id,
brand,
final_ebook_name
) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$statement->execute(array(
$_POST['p_name'],
$p_old_price,
$p_current_price,
$_POST['p_qty'],
$_POST['p_qty_update'],
$final_name,
$_POST['p_description'],
$_POST['p_short_description'],
$_POST['p_feature'],
$_POST['p_condition'],
$_POST['p_return_policy'],
0,
$_POST['p_is_featured'],
$_POST['p_is_active'],
$_POST['ecat_id'],
$brand_path,
$final_ebook_name
));


if(isset($_POST['size'])) {
foreach($_POST['size'] as $value) {
$statement = $pdo->prepare("INSERT INTO tbl_product_size (size_id,p_id) VALUES (?,?)");
$statement->execute(array($value,$ai_id));
}
}

if(isset($_POST['color'])) {
foreach($_POST['color'] as $value) {
$statement = $pdo->prepare("INSERT INTO tbl_product_color (color_id,p_id) VALUES (?,?)");
$statement->execute(array($value,$ai_id));
}
}

$success_message = 'Produto adicionado com sucesso.';
header("Location:".URLADMIN."product.php");
die;
}
}
?>

<section class="content-header">
<div class="content-header-left">
<h1>Adicionar produto</h1>
</div>
<div class="content-header-right">
<a href="product.php" class="btn btn-primary btn-sm">Ver Todosl</a>
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

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="box box-info">
<div class="box-body">
<div class="form-group">
<label for="" class="col-sm-3 control-label">Nome da categoria de nível superior <span>*</span></label>
<div class="col-sm-4">
<select name="tcat_id" class="form-control select2 top-cat">
<option value="">Selecione a categoria de nível superior</option>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_top_category ORDER BY tcat_name ASC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);	
foreach ($result as $row) {
?>
<option value="<?php echo $row['tcat_id']; ?>"><?php echo $row['tcat_name']; ?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Nome da categoria de nível médio<span>*</span></label>
<div class="col-sm-4">
<select name="mcat_id" class="form-control select2 mid-cat">
<option value="">selecione categoria de nível médio</option>
</select>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Nome da categoria de nível final<span>*</span></label>
<div class="col-sm-4">
<select name="ecat_id" class="form-control select2 end-cat">
<option value="">Selecione a categoria de nível final</option>
</select>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Nome do produto <span>*</span></label>
<div class="col-sm-4">
<input type="text" name="p_name" class="form-control">
</div>
</div>	
<div class="form-group">
<label for="" class="col-sm-3 control-label">
Preço antigo <br><span style="font-size:10px;font-weight:normal;">(Em KZ)</span></label>
<div class="col-sm-4">
<input type="text" name="p_old_price" class="form-control">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Preço Atual <span>*</span><br><span style="font-size:10px;font-weight:normal;">(Em KZ)</span></label>
<div class="col-sm-4">
<input type="text" name="p_current_price" class="form-control">
</div>
</div>

<div class="form-group">
<label for="" class="col-sm-3 control-label">Quantidade <span>*</span></label>
<div class="col-sm-4">
<input type="text" name="p_qty" class="form-control">
</div>
</div>

<div class="form-group">
<label for="" class="col-sm-3 control-label">Daqui a quanto tempo vai atualizar o Stoke <span>*</span></label>

<div class="col-sm-4">
<input type="number" name="p_qty_update" class="form-control" placeholder="exemplo 1 dia, 2 dias .." required="true">
</div>

</div>

<div class="form-group">
<label for="" class="col-sm-3 control-label">Selecione o tamanho</label>
<div class="col-sm-4">
<select name="size[]" class="form-control select2" multiple="multiple">
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_size ORDER BY size_id ASC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);			
foreach ($result as $row) {
?>
<option value="<?php echo $row['size_id']; ?>"><?php echo $row['size_name']; ?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Sselecione Cor</label>
<div class="col-sm-4">
<select name="color[]" class="form-control select2" multiple="multiple">
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_color ORDER BY color_id ASC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);			
foreach ($result as $row) {
?>
<option value="<?php echo $row['color_id']; ?>"><?php echo $row['color_name']; ?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Foto em destaque <span>*</span></label>
<div class="col-sm-4" style="padding-top:4px;">
<input type="file" name="p_featured_photo">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Outras fotos</label>
<div class="col-sm-4" style="padding-top:4px;">
<table id="ProductTable" style="width:100%;">
<tbody>
<tr>
<td>
<div class="upload-btn">
<input type="file" name="photo[]" style="margin-bottom:5px;">
</div>
</td>
<td style="width:28px;"><a href="javascript:void()" class="Delete btn btn-danger btn-xs">X</a></td>
</tr>
</tbody>
</table>
</div>
<div class="col-sm-2">
<input type="button" id="btnAddNew" value="Adicionar item" style="margin-top: 5px;margin-bottom:10px;border:0;color: #fff;font-size: 14px;border-radius:3px;" class="btn btn-warning btn-xs">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Adicone a sua brand</label>
<div class="col-sm-4" style="padding-top:4px;">
<input type="file" name="brand">
</div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">Upload de eBook (PDF, EPUB, MOBI) <span>*</span></label>
    <div class="col-sm-4" style="padding-top:4px;">
        <input type="file" name="ebook" accept=".pdf,.epub,.mobi">
    </div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Descrição</label>
<div class="col-sm-8">
<textarea name="p_description" class="form-control" cols="30" rows="10" id="editor1"></textarea>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Breve descrição</label>
<div class="col-sm-8">
<textarea name="p_short_description" class="form-control" cols="30" rows="10" id="editor2"></textarea>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Destaques</label>
<div class="col-sm-8">
<textarea name="p_feature" class="form-control" cols="30" rows="10" id="editor3"></textarea>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Condições</label>
<div class="col-sm-8">
<textarea name="p_condition" class="form-control" cols="30" rows="10" id="editor4"></textarea>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Política de devolução</label>
<div class="col-sm-8">
<textarea name="p_return_policy" class="form-control" cols="30" rows="10" id="editor5"></textarea>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Está em destaque?</label>
<div class="col-sm-8">
<select name="p_is_featured" class="form-control" style="width:auto;">
<option value="0">Não</option>
<option value="1">Sim</option>
</select> 
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label">Está ativo?</label>
<div class="col-sm-8">
<select name="p_is_active" class="form-control" style="width:auto;">
<option value="0">Não</option>
<option value="1">Sim</option>
</select> 
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-3 control-label"></label>
<div class="col-sm-6">
<button type="submit" class="btn btn-success pull-left" name="form1">
Adicionar produto</button>
</div>
</div>
</div>
</div>

</form>


</div>
</div>

</section>

<?php require_once('footer.php'); ?>