<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['search_text'])) {
header('location: home');
exit;
} else {
if($_REQUEST['search_text']=='') {
header('location:'.ROOT.'home');
exit;
}
}
?>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
$banner_search = $row['banner_search'];
}
?>

<div class="page-banner" style="background-image: url(assets/uploads/<?php echo $banner_search; ?>);">
<div class="overlay"></div>
<div class="inner ">
<h1 style="font-size:14pt;">
Pesquisou por: 
<?php 
$search_text = strip_tags($_REQUEST['search_text']); 
echo $search_text; 
?>            
</h1>
</div>
</div>

<div class="page">
<div class="container">
<div class="row">
<div class="col-md-12">
    <div id="product-list_serch" class="container23">
        <!-- Os produtos serão carregados aqui via AJAX -->
        
    </div>
    <div class="loading_search">
        <p>Carregando...</p>
    </div>


</div>
</div>
</div>
</div>




<script>
    
    // codigo java script para carregar dinamicamente do banco de dados
      $(document).ready(function() {
    let limit = window.innerWidth >= 992 ? 5 : 2;  // Número de produtos por página
    let start = 0;  // Ponto inicial
    let action = 'inactive';
    let search_text = "<?=$_GET['search_text']?>";

    function load_products_search(limit, start) {
        $.ajax({
            url: "<?=ROOT?>fetch_products_search.php",
            method: "POST",
            data: {limit: limit, start: start,search_text:search_text},
            beforeSend: function() {
                $('.loading_search').show();
            },
            success: function(data) {
                 console.log(data);
                if (data.trim() === '') {
                    action = 'active';
                } else {
                    $('#product-list_serch').append(data);
                    $('.loading_search').hide();
                    action = 'inactive';
                }
            }
        });
    }

    if (action === 'inactive') {
        action = 'active';
        load_products_search(limit, start);
    }

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $("#product-list_serch").height() && action === 'inactive') {
            action = 'active';
            start += limit;
            setTimeout(function() {
                load_products_search(limit, start);
            }, 500);
        }
    });
});
    
    
    
</script>

<?php require_once('footer.php'); ?>

