<?php
session_start();
require_once('database.php'); // contém $pdo e outras configurações
header('Content-Type: application/json');

// Adicionando cabeçalhos CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Arquivo de conexão com o banco de dados

header("Content-Type: application/json"); // Define resposta como JSON
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Recebe os dados em JSON
$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'];
$preco = $data['preco'];
$img = $data['img'];
$feedback = array("success"=>false,"message"=>"","qt"=>"");
$p_id = $data['p_id'];
$p_qty = intval($data['quantidade']);
$new_qt = 0;
$qt = 0;
$current_p_qty = $p_id;    
   
    // everuthing start here
        
// getting the currect stock of this product
$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
$statement->execute(array($p_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
$current_p_qty = $row['p_qty'];
}

if($p_qty > $current_p_qty):
    $lang_dias = "";
    $dias = $row['p_qty_update'];
    if($dias == 1){
       $lang_dias = " dia "; 
    }
    if($dias > 1){
        $lang_dias = " dias ";
    }
 $feedback['success'] = false;   
$feedback['message'] = 'Desculpas! á apenas  '.$current_p_qty.' item(s) no stoke , mais teremos esse produto dentro de: '.$row['p_qty_update']. $lang_dias;

?>

<?php
else:
if(isset($_SESSION['cart_p_id']))
{
$arr_cart_p_id = array();
$arr_cart_size_id = array();
$arr_cart_color_id = array();
$arr_cart_p_qty = array();
$arr_cart_p_current_price = array();

$i=0;
foreach($_SESSION['cart_p_id'] as $key => $value) 
{
$i++;
$arr_cart_p_id[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_size_id'] as $key => $value) 
{
$i++;
$arr_cart_size_id[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_color_id'] as $key => $value) 
{
$i++;
$arr_cart_color_id[$i] = $value;
}


$added = 0;
if(!isset($_POST['size_id'])) {
$size_id = 0;
} else {
$size_id = $_POST['size_id'];
}
if(!isset($_POST['color_id'])) {
$color_id = 0;
} else {
$color_id = $_POST['color_id'];
}
for($i=1;$i<=count($arr_cart_p_id);$i++) {
if( ($arr_cart_p_id[$i]==$p_id) && ($arr_cart_size_id[$i]==$size_id) && ($arr_cart_color_id[$i]==$color_id) ) {
$added = 1;
break;
}
}
if($added == 1) {
    $feedback['success'] = false;
$feedback['message'] = 'Esse produto já foi adicionado ao carrinho.';
} else {

$i=0;
foreach($_SESSION['cart_p_id'] as $key => $res) 
{
$i++;
}
$new_key = $i+1;

if(isset($_POST['size_id'])) {

$size_id = $_POST['size_id'];

$statement = $pdo->prepare("SELECT * FROM tbl_size WHERE size_id=?");
$statement->execute(array($size_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
$size_name = $row['size_name'];
}
} else {
$size_id = 0;
$size_name = '';
}

if(isset($_POST['color_id'])) {
$color_id = $_POST['color_id'];
$statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_id=?");
$statement->execute(array($color_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
$color_name = $row['color_name'];
}
} else {
$color_id = 0;
$color_name = '';
}


$_SESSION['cart_p_id'][$new_key] = $p_id;
$_SESSION['cart_size_id'][$new_key] = $size_id;
$_SESSION['cart_size_name'][$new_key] = $size_name;
$_SESSION['cart_color_id'][$new_key] = $color_id;
$_SESSION['cart_color_name'][$new_key] = $color_name;
$_SESSION['cart_p_qty'][$new_key] = $p_qty;
$_SESSION['cart_p_current_price'][$new_key] = $preco;
$_SESSION['cart_p_name'][$new_key] = $name;
$_SESSION['cart_p_featured_photo'][$new_key] = $img;

$feedback['success'] = true;
$feedback['message'] = 'Produto adicionado com sucesso!';

    // buscando a quantidade de produto que ja foram adicionado para somar com o que esta sendo adicionado
    $qt1 = 0;
if(isset($_SESSION['cart_p_qty']))if(isset($_SESSION['cart_p_qty'])){
    $qt_check = $_SESSION['cart_p_qty'];
      foreach($qt_check as $row){
        $qt1 = $qt1 + 1;
      }
      
   }

   $new_qt = $qt1 + 1;
   $feedback['qt'] = $qt1;

}
 

}

else
{

if(isset($_POST['size_id'])) {

$size_id = $_POST['size_id'];

$statement = $pdo->prepare("SELECT * FROM tbl_size WHERE size_id=?");
$statement->execute(array($size_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
$size_name = $row['size_name'];
}
} else {
$size_id = 0;
$size_name = '';
}

if(isset($_POST['color_id'])) {
$color_id = $_POST['color_id'];
$statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_id=?");
$statement->execute(array($color_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
$color_name = $row['color_name'];
}
} else {
$color_id = 0;
$color_name = '';
}


$_SESSION['cart_p_id'][1] = $p_id;
$_SESSION['cart_size_id'][1] = $size_id;
$_SESSION['cart_size_name'][1] = $size_name;
$_SESSION['cart_color_id'][1] = $color_id;
$_SESSION['cart_color_name'][1] = $color_name;
$_SESSION['cart_p_qty'][1] = $p_qty;
$_SESSION['cart_p_current_price'][1] = $preco;
$_SESSION['cart_p_name'][1] = $name;
$_SESSION['cart_p_featured_photo'][1] = $img;

    // buscando a quantidade de produto que ja foram adicionado para somar com o que esta sendo adicionado
$feedback['success'] = true;
$feedback['message'] = 'Produto adicionado com sucesso!';
$qt2 = 0;
if(isset($_SESSION['cart_p_qty']))if(isset($_SESSION['cart_p_qty'])){
    $qt_check = $_SESSION['cart_p_qty'];
      foreach($qt_check as $row){
        $qt2 = $qt2 + 1;
      }
     
   }
   $new_qt = $qt2 + 1;

   $feedback['qt'] = $qt2;

}
endif;

echo json_encode($feedback); 



// Aqui tu faz o processamento normal: salvar no carrinho, etc.
