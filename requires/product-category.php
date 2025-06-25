<?php
function formatarKZ($valorTexto) {
    $numero = preg_replace('/[^\d]/', '', $valorTexto);
    $fmt = new NumberFormatter('pt_AO', NumberFormatter::CURRENCY);
    return $fmt->formatCurrency($numero, 'AOA');
}

$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $banner_product_category = $row['banner_product_category'];
}


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


// --- Lógica PHP separada ---
$prod_count = 0;
$prod_table_ecat_ids = [];
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

$produtos = [];
if ($prod_count > 0) {
    for ($ii = 0; $ii < count($final_ecat_ids); $ii++) {
        $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE ecat_id=? AND p_is_active=? ORDER BY p_name ASC");
        $statement->execute([$final_ecat_ids[$ii], 1]);
        $produtos = array_merge($produtos, $statement->fetchAll(PDO::FETCH_ASSOC));
    }
}

$promocionais = [];
foreach ($final_ecat_ids as $ecat_id) {
    $stmtPromo = $pdo->prepare("SELECT * FROM tbl_product WHERE ecat_id = ? AND p_is_active = 1 AND p_old_price IS NOT NULL AND p_old_price > p_current_price ORDER BY p_name ASC LIMIT 5");
    $stmtPromo->execute([$ecat_id]);
    $promocionais = array_merge($promocionais, $stmtPromo->fetchAll(PDO::FETCH_ASSOC));
}
