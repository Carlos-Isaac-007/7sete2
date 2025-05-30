<?php require_once('header.php');
if (!isset($_SESSION['customer']['cust_id'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI']; // ou $_SERVER['REQUEST_URI'] se quiser o caminho exato
}

?> ?>

<style>
.product-cat .col-md-2 {
  
  
}
.product-cat .col-md-2 {
    flex: 0 0 16%; /* ou 24%, dependendo da margem/padding */
    
   
    box-sizing: border-box;
}
    .product-cat .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: start; /* melhor para alinhamento natural */
    }

    .col-md-2 {
        padding: 10px;
        box-sizing: border-box;
        transition: transform 0.3s ease;
    }

    .card-produto {
        border: 1px solid #ddd;
        padding: 30px;
        border-radius: 12px;
        background-color: #fff;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .card-produto:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    }

    .card-produto > .produto-img {
        max-width: 100% !important;
        height: 150px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .card-produto:hover img {
        transform: scale(1.1);
    }

    .produto-nome {
        font-size: 16px !important;
        font-weight: 600;
        margin: 10px 0;
        color: #333;
        transition: color 0.3s ease;
        
        display: -webkit-box;
        -webkit-line-clamp: 2;         /* Número de linhas visíveis */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        
        line-height: 1.2em;
        height: 2.4em; /* 1.2em x 2 linhas = 2.4em */
        
    }

    .card-produto:hover .produto-nome {
        color: #000c78;
    }

    .preco {
        font-size: 18px;
        font-weight: bold;
        color: #e55300;
        margin-bottom: 15px;
    }

    .brand-wrapper {
        min-height: 60px; /* Garantir espaço mínimo */
        max-height: 70px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 0px;
        overflow: hidden; /* Prevenir que imagens maiores estourem */
        padding: 5px;
    }

    .brand-logo {
        height: 20px !important;
        object-fit: contain !important;
        display: block !important;
        margin: 0 auto !important;
    }

    .btn-primary {
        background-color: #000c78;
        border: none;
        color: #fff;
        padding: 8px 16px;
        font-size: 14px;
        border-radius: 25px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #085117;
    }

    /* Responsividade */
    @media (max-width: 1199px) {
        .col-md-2 {
            width: 30%; /* 3 por linha */
        }
    }

    @media (max-width: 767px) {
        .col-md-2 {
            width: 48%; /* 2 por linha */
            margin: 0 auto;
        }
        
        .produto-nome{
            font-size: 10px;
        }
        .preco{
            font-size: 14px;
        }
        .btn-primary{
            margin: 0 auto;
            font-size: 12px;
            padding: 4px 8px;
        }
        
         .brand-wrapper {
            margin: -20px 0 !important; /* reduz a margem vertical */
            padding: 2px !important;  /* reduz o padding interno */
        }

      .brand-logo {
        height: 20px !important; /* menor altura */
      }
    
      .preco {
        margin: 5px !important; /* reduz a margem abaixo do preço */
        font-size: 14px !important;    /* ajusta o tamanho da fonte se necessário */
      }
    }
    
</style>



<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $banner_product_category = $row['banner_product_category'];
}
?>

<?php
if (!isset($_REQUEST['id']) || !isset($_REQUEST['type'])) {
    header('location:' . ROOT . 'home');
    exit;
} else {
    if ($_REQUEST['type'] != 'top-category' && $_REQUEST['type'] != 'mid-category' && $_REQUEST['type'] != 'end-category') {
        header('location:' . ROOT . 'home');
        exit;
    } else {
        $top = $top1 = $mid = $mid1 = $mid2 = $end = $end1 = $end2 = [];

        $statement = $pdo->prepare("SELECT * FROM tbl_top_category");
        $statement->execute();
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $top[] = $row['tcat_id'];
            $top1[] = $row['tcat_name'];
        }

        $statement = $pdo->prepare("SELECT * FROM tbl_mid_category");
        $statement->execute();
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $mid[] = $row['mcat_id'];
            $mid1[] = $row['mcat_name'];
            $mid2[] = $row['tcat_id'];
        }

        $statement = $pdo->prepare("SELECT * FROM tbl_end_category");
        $statement->execute();
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $end[] = $row['ecat_id'];
            $end1[] = $row['ecat_name'];
            $end2[] = $row['mcat_id'];
        }

        if ($_REQUEST['type'] == 'top-category') {
            if (!in_array($_REQUEST['id'], $top)) {
                header('location:' . ROOT . 'home');
                exit;
            } else {
                for ($i = 0; $i < count($top); $i++) {
                    if ($top[$i] == $_REQUEST['id']) {
                        $title = $top1[$i];
                        break;
                    }
                }
                $arr1 = $arr2 = [];
                for ($i = 0; $i < count($mid); $i++) {
                    if ($mid2[$i] == $_REQUEST['id']) {
                        $arr1[] = $mid[$i];
                    }
                }
                for ($j = 0; $j < count($arr1); $j++) {
                    for ($i = 0; $i < count($end); $i++) {
                        if ($end2[$i] == $arr1[$j]) {
                            $arr2[] = $end[$i];
                        }
                    }
                }
                $final_ecat_ids = $arr2;
            }
        }

        if ($_REQUEST['type'] == 'mid-category') {
            if (!in_array($_REQUEST['id'], $mid)) {
                header('location:' . ROOT . 'home');
                exit;
            } else {
                for ($i = 0; $i < count($mid); $i++) {
                    if ($mid[$i] == $_REQUEST['id']) {
                        $title = $mid1[$i];
                        break;
                    }
                }
                $arr2 = [];
                for ($i = 0; $i < count($end); $i++) {
                    if ($end2[$i] == $_REQUEST['id']) {
                        $arr2[] = $end[$i];
                    }
                }
                $final_ecat_ids = $arr2;
            }
        }

        if ($_REQUEST['type'] == 'end-category') {
            if (!in_array($_REQUEST['id'], $end)) {
                header('location:' . ROOT . 'home');
                exit;
            } else {
                for ($i = 0; $i < count($end); $i++) {
                    if ($end[$i] == $_REQUEST['id']) {
                        $title = $end1[$i];
                        break;
                    }
                }
                $final_ecat_ids = [$_REQUEST['id']];
            }
        }
    }
}
?>

<div class="page-banner" style="background-image: url(assets/uploads/<?php echo $banner_product_category; ?>);">
    <div class="inner">
        <h1><?php echo $title; ?></h1>
    </div>
</div>

<div class="page" style="width: 90%; margin: 0 auto;">
    <div class="page-inner" style="width: 100%;">
        <div class="row" style="width: 100%;">
            <div class="col-md-12" style="width: 100%;">
                <div class="product product-cat">
                    <?php
                    function formatarKZ($valorTexto) {
                        $numero = preg_replace('/[^\d]/', '', $valorTexto);
                        $fmt = new NumberFormatter('pt_AO', NumberFormatter::CURRENCY);
                        return $fmt->formatCurrency($numero, 'AOA');
                    }

                    $prod_count = 0;
                    $statement = $pdo->prepare("SELECT * FROM tbl_product");
                    $statement->execute();
                    foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        $prod_table_ecat_ids[] = $row['ecat_id'];
                    }

                    for ($ii = 0; $ii < count($final_ecat_ids); $ii++) {
                        if (in_array($final_ecat_ids[$ii], $prod_table_ecat_ids)) {
                            $prod_count++;
                        }
                    }

                    if ($prod_count == 0) {
                        echo '<div class="pl_15">' . LANG_VALUE_153 . '</div>';
                    } else {
                        $produtos = [];
                        for ($ii = 0; $ii < count($final_ecat_ids); $ii++) {
                            $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE ecat_id=? AND p_is_active=? ORDER BY p_name ASC");
                            $statement->execute([$final_ecat_ids[$ii], 1]);
                            $produtos = array_merge($produtos, $statement->fetchAll(PDO::FETCH_ASSOC));
                        }

                        $count = 0;
                        echo '<div class="row">';
                        foreach ($produtos as $produto) {
                            echo '<div class="col-md-2">';
                            // Produto renderizado como card
                            ?>
                           <div class="card-produto">
                                <!-- Imagem do Produto -->
                                <img src="assets/uploads/<?php echo htmlspecialchars($produto['p_featured_photo']); ?>" 
                                     alt="<?php echo htmlspecialchars($produto['p_name']); ?>" 
                                     class="produto-img">
                            
                                <!-- Nome do Produto -->
                                <h4 class="produto-nome"><?php echo htmlspecialchars($produto['p_name']); ?></h4>
                            
                                <!-- Brand -->
                                <div class="brand-wrapper">
                                    <img src="<?php echo empty($produto['brand']) || !$produto['brand'] 
                                                    ? 'assets/uploads/SETE-NOVO-LOGOTIPO.png' 
                                                    : 'assets/uploads/' . htmlspecialchars($produto['brand']); ?>" 
                                         class="brand-logo" 
                                         alt="Logo da Marca">
                                </div>
                            
                                <!-- Preço -->
                                <p class="preco"><?php echo formatarKZ($produto['p_current_price']); ?></p>
                            
                                <!-- Link para o Produto -->
                                <a href="product?id=<?= $produto['p_id'] ?>" class="btn btn-primary btn-sm mt-auto">
                                    <i class="fa fa-info-circle"></i> Ver Detalhes
                                </a>
                            </div>


                            <?php
                            echo '</div>';
                            $count++;
                            if ($count % 6 == 0) {
                                echo '</div><div class="row">';
                            }
                        }
                        echo '</div>'; // Fecha a última row
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>
