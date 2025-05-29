<?php
ob_start();
session_start();
include("inc/config.php");
include("inc/functions.php");
include("inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();
$error_message = '';
$success_message = '';
$error_message1 = '';
$success_message1 = '';

// Check if the user is logged in or not
if(!isset($_SESSION['user'])) {
header('location: login.php');
exit;
}



?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Painel Admistrativo</title>

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<link rel="apple-touch-icon" sizes="57x57" href="assets/img/favicons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="assets/img/favicons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
<link rel="manifest" href="assets/img/favicons/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="assets/img/favicons/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/ionicons.min.css">
<link rel="stylesheet" href="css/datepicker3.css">
<link rel="stylesheet" href="css/all.css">
<link rel="stylesheet" href="css/select2.min.css">
<link rel="stylesheet" href="css/dataTables.bootstrap.css">
<link rel="stylesheet" href="css/jquery.fancybox.css">
<link rel="stylesheet" href="css/AdminLTE.min.css">
<link rel="stylesheet" href="css/_all-skins.min.css">
<link rel="stylesheet" href="css/on-off-switch.css"/>
<link rel="stylesheet" href="css/summernote.css">
<link rel="stylesheet" href="style.css">


<style>
    /*icone de bairro/*
    /* Estiliza o container das notificações e do bairro */
#notificacoes-container {
    position: fixed;
    top: 5rem !important;
    right: 180px !important;  /* Ajuste a distância conforme necessário */
    display: flex;
    flex-direction: row;
    gap: 20px;  /* Espaço entre os ícones */
    cursor: pointer;
    z-index: 1000;
 
}

/* Ícone de Notificações */
#notificacoes-icon {
    position: relative;
    font-size: 24px;
    background: #ffcc00;
    padding: 10px;
    border-radius: 50%;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    transition: 0.3s;
}

#notificacoes-icon:hover {
    background: #ffb700;
}

/* Ícone do Bairro */
#bairro-icon {
    position: relative;
    font-size: 24px;
    background: #4CAF50;
    padding: 10px;
    border-radius: 50%;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    transition: 0.3s;
}

#bairro-icon:hover {
    background: #388E3C;
}

/* Contadores de Notificações e Bairro */
#notificacoes-count,
#bairro-count, #usuarios-online {
    position: absolute;
    top: -5px;
    right: -5px;
    background: red;
    color: white;
    font-size: 14px;
    font-weight: bold;
    padding: 3px 7px;
    border-radius: 50%;
}

/* Dropdown de Notificações e Bairro */
#notificacoes-dropdown,
#bairro-dropdown {
    position: absolute;
    top: 50px;
    right: 0;
    width: 300px;
    background: white;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    padding: 10px;
    display: none;
}

#notificacoes-dropdown h4,
#bairro-dropdown h4 {
    margin: 0 0 10px;
    font-size: 16px;
    color: #333;
}

/* Estilização de cada item nas notificações e bairros */
.notificacao-item,
.bairro-item {
    display: flex;
    align-items: center;
    padding: 10px;
    margin-bottom: 8px;
    background: #fffae6;
    border-left: 5px solid #ffc107;
    border-radius: 8px;
    font-size: 14px;
    color: #333;
}

/* Mostrar dropdown ao clicar */
#notificacoes-container.active #notificacoes-dropdown,
#notificacoes-container.active #bairro-dropdown {
    display: block;
}

    /* fim */
/* Estiliza o container das notificações */
#notificacoes-container {
    position: fixed;
    top: 6rem ;
    right: 20rem;
    cursor: pointer;
    z-index: 1000;
    display: flex;
    margin-left: 10px;
}

/* Ícone do sino de notificações */
#notificacoes-icon {
    position: relative;
    font-size: 24px;
    background: #ffcc00;
    padding: 10px;
    border-radius: 50%;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    transition: 0.3s;
}

#notificacoes-icon:hover {
    background: #ffb700;
}

#online-icon{
    position: relative;
    font-size: 24px;
    background: linear-gradient(to right, #00c6ff, #0072ff);
    padding: 10px;
    border-radius: 50%;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    transition: 0.3s;
}

/* Contador de notificações */
#notificacoes-count {
    position: absolute;
    top: -5px;
    right: -5px;
    background: red;
    color: white;
    font-size: 14px;
    font-weight: bold;
    padding: 3px 7px;
    border-radius: 50%;
}

/* Dropdown das notificações */
#notificacoes-dropdown {
    position: absolute;
    top: 50px;
    right: 0;
    width: 300px;
    background: white;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    padding: 10px;
    display: none;
}

#notificacoes-dropdown h4 {
    margin: 0 0 10px;
    font-size: 16px;
    color: #333;
}

/* Estilização de cada notificação */
.notificacao-item {
    display: flex;
    align-items: center;
    padding: 10px;
    margin-bottom: 8px;
    background: #fffae6;
    border-left: 5px solid #ffc107;
    border-radius: 8px;
    font-size: 14px;
    color: #333;
}

.notificacao-item .icone {
    font-size: 18px;
    margin-right: 10px;
    color: #ffc107;
}

.notificacao-item .mensagem {
    flex: 1;
}

.notificacao-item .data {
    font-size: 12px;
    color: #777;
}

/* Mostrar dropdown ao clicar */
#notificacoes-container.active #notificacoes-dropdown {
    display: block;
}

/* Responsividade: Ajuste para telas menores */
/* Layout responsivo para telas pequenas */
@media (max-width: 600px) {
    #notificacoes-container {
        top: 5rem !important;
        right: 7rem !important;
        gap: 10px;
    }

    /* Reduz o tamanho visual dos ícones */
    #notificacoes-icon,
    #bairro-icon {
        font-size: 18px;
        padding: 6px;
    }

    /* Reduz tamanho do contador */
    #notificacoes-count,
    #bairro-count,
    #usuarios-online{
        font-size: 10px;
        padding: 2px 5px;
        top: -4px;
        right: -4px;
    }

    /* Dropdown ocupa quase toda a largura */
    #notificacoes-dropdown,
    #bairro-dropdown {
        width: 90vw;
        left: 50%;
        transform: translateX(-50%);
        right: auto;
    }

    /* Itens do dropdown menores */
    .notificacao-item,
    .bairro-item {
        font-size: 13px;
        padding: 8px;
    }

    .notificacao-item .icone,
    .bairro-item .icone {
        font-size: 16px;
    }

    .notificacao-item .data,
    .bairro-item .data {
        font-size: 11px;
    }
}



</style>

</head>

<body class="hold-transition fixed skin-blue sidebar-mini">

<div class="wrapper">

<header class="main-header">

<a href="index.php" class="logo">
<span class="logo-lg">7sete Technology </span> 
</a>


<nav class="navbar navbar-static-top">

<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
<span class="sr-only">Toggle navigation</span>
</a>

<span style="float:left;line-height:50px;color:#fff;padding-left:15px;font-size:18px;">Painel de administração</span>

<!-- Botão de ativação de som (popup) -->
<div id="som-popup" style="
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #111;
    color: #fff;
    padding: 12px 18px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    z-index: 9999;
    display: flex;
    align-items: center;
    gap: 10px;
    animation: aparecer 0.5s ease-out;
">
    <span>🔊 Deseja ativar os sons?</span>
    <button onclick="ativarSom()" style="
        background: #00c853;
        color: white;
        border: none;
        padding: 8px 14px;
        border-radius: 6px;
        cursor: pointer;
    ">Ativar</button>
</div>



<style>
@keyframes aparecer {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>


<!-- Top Bar ... User Inforamtion .. Login/Log out Area -->
<div class="navbar-custom-menu">
<ul class="nav navbar-nav">
<li class="dropdown user user-menu">
    <!-- Botão de notificações -->
<div id="notificacoes-container">
    <div id="notificacoes-icon">
        🔔 <span id="notificacoes-count">0</span>
    </div>
    <!--bairro-->
    <div id="bairro-container">
        <div id="bairro-icon">
            🗺️ <span id="bairro-count">0</span>
        </div>
        <div id="bairro-dropdown" class="hidden">
            <h4>Bairros Novos</h4>
            <div id="bairro-list"></div>
        </div>
    </div>
    
    <div id="online-container">
        <div id="online-icon">
            👥 <span id = "usuarios-online">0</span>
        </div>
    </div>
    
    <div id="notificacoes-dropdown" class="hidden">
        <h4>Notificações</h4>
        <div id="notificacoes-list"></div>
    </div>
</div>

<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="../assets/uploads/<?php echo $_SESSION['user']['photo']; ?>" class="user-image" alt="User Image">
<span class="hidden-xs"><?php echo $_SESSION['user']['full_name']; ?></span>
</a>
<ul class="dropdown-menu">
<li class="user-footer">
<div>
<a href="profile-edit.php" class="btn btn-default btn-flat">Editar perfil</a>
</div>
<div>
<a href="logout.php" class="btn btn-default btn-flat">Sair</a>
</div>
</li>
</ul>
</li>
</ul>
</div>

</nav>
</header>

<?php $cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); ?>
<!-- Side Bar to Manage Shop Activities -->
<aside class="main-sidebar">
<section class="sidebar">

<ul class="sidebar-menu">

<li class="treeview <?php if($cur_page == 'index.php') {echo 'active';} ?>">
<a href="index.php">
<i class="fa fa-dashboard"></i> <span>Painel</span>
</a>
</li>



<li class="treeview <?php if( ($cur_page == 'settings.php') ) {echo 'active';} ?>">
<a href="settings.php">
<i class="fa fa-sliders"></i> <span>Configurações do site</span>
</a>
</li>


<?php if($_SESSION['user']['role'] == "Vendedor"):?>

<?php else:?>
<li class="treeview <?php if( ($cur_page == 'size.php') || ($cur_page == 'size-add.php') || ($cur_page == 'size-edit.php') || ($cur_page == 'color.php') || ($cur_page == 'color-add.php') || ($cur_page == 'color-edit.php') || ($cur_page == 'country.php') || ($cur_page == 'country-add.php') || ($cur_page == 'country-edit.php') || ($cur_page == 'shipping-cost.php') || ($cur_page == 'shipping-cost-edit.php') || ($cur_page == 'top-category.php') || ($cur_page == 'top-category-add.php') || ($cur_page == 'top-category-edit.php') || ($cur_page == 'mid-category.php') || ($cur_page == 'mid-category-add.php') || ($cur_page == 'mid-category-edit.php') || ($cur_page == 'end-category.php') || ($cur_page == 'end-category-add.php') || ($cur_page == 'end-category-edit.php') ) {echo 'active';} ?>">
<a href="#">
<i class="fa fa-cogs"></i>
<span>Configurações da loja</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
</a>
<ul class="treeview-menu">
<li><a href="size.php"><i class="fa fa-circle-o"></i> Tamanho</a></li>
<li><a href="color.php"><i class="fa fa-circle-o"></i> Cor</a></li>
<li><a href="country.php"><i class="fa fa-circle-o"></i> Provincias</a></li>
<li><a href="municipio.php"><i class="fa fa-circle-o"></i> Municipio</a></li>
<li><a href="bairro.php"><i class="fa fa-circle-o"></i> Bairro</a></li>
<li><a href="shipping-cost.php"><i class="fa fa-circle-o"></i> Custo de envio</a></li>
<li><a href="top-category.php"><i class="fa fa-circle-o"></i> Categoria de nível superior</a></li>
<li><a href="mid-category.php"><i class="fa fa-circle-o"></i> Categoria de nível médio</a></li>
<li><a href="end-category.php"><i class="fa fa-circle-o"></i> Categoria de nível final</a></li>
</ul>
</li>
<?php endif?>




<li class="treeview <?php if( ($cur_page == 'product.php') || ($cur_page == 'product-add.php') || ($cur_page == 'product-edit.php') ) {echo 'active';} ?>">
<a href="product.php">
<i class="fa fa-shopping-bag"></i> <span>
Gestão de Produtos</span>
</a>
</li>


<li class="treeview <?php if( ($cur_page == 'order.php') ) {echo 'active';} ?>">
<a href="order.php">
<i class="fa fa-sticky-note"></i> <span>
Gerenciamento de pedidos</span>
</a>
</li>


<li class="treeview <?php if( ($cur_page == 'slider.php') ) {echo 'active';} ?>">
<a href="slider.php">
<i class="fa fa-picture-o"></i> <span>Gerenciar controles deslizantes</span>
</a>
</li>
<!-- Icons to be displayed on Shop -->
<li class="treeview <?php if( ($cur_page == 'service.php') ) {echo 'active';} ?>">
<a href="service.php">
<i class="fa fa-list-ol"></i> <span>
Serviços</span>
</a>
</li>

<li class="treeview <?php if( ($cur_page == 'faq.php') ) {echo 'active';} ?>">
<a href="faq.php">
<i class="fa fa-question-circle"></i> <span>FAQ</span>
</a>
</li>

<li class="treeview <?php if( ($cur_page == 'customer.php') || ($cur_page == 'customer-add.php') || ($cur_page == 'customer-edit.php') ) {echo 'active';} ?>">
<a href="customer.php">
<i class="fa fa-user-plus"></i> <span>Cliente Registrado</span>
</a>
</li>

<li class="treeview <?php if( ($cur_page == 'vendedor.php') || ($cur_page == 'vendedor-add.php') || ($cur_page == 'vendedor-edit.php') ) {echo 'active';} ?>">
<a href="vendedor.php">
<i class="fa fa-user-plus"></i> <span>Gerenciamento de Trabalhadores</span>
</a>
</li>

<li class="treeview <?php if( ($cur_page == 'page.php') ) {echo 'active';} ?>">
<a href="page.php">
<i class="fa fa-tasks"></i> <span>Configurações de página</span>
</a>
</li>

<li class="treeview <?php if( ($cur_page == 'social-media.php') ) {echo 'active';} ?>">
<a href="social-media.php">
<i class="fa fa-globe"></i> <span>Mídias Sociais</span>
</a>
</li>

<li class="treeview <?php if( ($cur_page == 'subscriber.php')||($cur_page == 'subscriber.php') ) {echo 'active';} ?>">
<a href="subscriber.php">
<i class="fa fa-hand-o-right"></i> <span>Assinante</span>
</a>
</li>

</ul>
</section>
</aside>

<div class="content-wrapper">
    <!-- Elemento de áudio -->
    <audio id="usuarios-online-som" src="online-som.wav" preload="auto"></audio>
    <audio id="ativar" src="ativar.wav" preload="auto"></audio>
    <audio id="notificacao-som" src="online-som.wav"></audio>
    <audio id="bairro-som" src="bairro.wav"></audio>
    
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // =================== FUNÇÃO GENÉRICA ===================
    function carregarDados(config) {
        $.ajax({
            url: config.url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                let html = '';
                let total = data.length;

                if (total > config.anterior.count) {
                    let audio = document.getElementById(config.audioId);
                    if (audio) audio.play();
                }

                config.anterior.count = total;

                if (total > 0) {
                    data.forEach(function(item) {
                        html += `
                            <div class="${config.itemClass}">
                                <span class="icone">${config.icone}</span>
                                <div class="mensagem">${item.mensagem || item.nome}</div>
                                <div class="data">${item.data_criacao}</div>
                            </div>`;
                    });
                } else {
                    html = `<p style="text-align:center; color:#777;">${config.vazioTexto}</p>`;
                }

                $(config.listId).html(html);
                $(config.countId).text(total).show();
            }
        });
    }

    let notificacoes = { count: 0 };
    let bairros = { count: 0 };

    function atualizarNotificacoes() {
        carregarDados({
            url: 'buscar_notificacoes.php',
            anterior: notificacoes,
            audioId: 'notificacao-som',
            listId: '#notificacoes-list',
            countId: '#notificacoes-count',
            itemClass: 'notificacao-item',
            icone: '🔔',
            vazioTexto: 'Sem novas notificações.'
        });
    }

    function atualizarBairros() {
        carregarDados({
            url: 'buscar_bairro.php',
            anterior: bairros,
            audioId: 'bairro-som',
            listId: '#bairro-list',
            countId: '#bairro-count',
            itemClass: 'bairro-item',
            icone: '🗺️',
            vazioTexto: 'Sem novos bairros.'
        });
    }

    setInterval(atualizarNotificacoes, 5000);
    setInterval(atualizarBairros, 5000);
    atualizarNotificacoes();
    atualizarBairros();

    // =================== EVENTOS DE CLICK ===================
    $('#notificacoes-icon').on('click', function() {
        $.get('marcar_como_visto.php');
        window.location.href = "https://7setetech.com/admin/order.php";
    });

    $('#bairro-container').on('click', function() {
        $.get('marcar_como_visto_bairro.php');
        window.location.href = "https://7setetech.com/admin/bairro.php";
    });
});
</script>


<script>
function tocarSomUsuariosOnline() {
    const audio = document.getElementById('usuarios-online-som');
    if (audio) {
        audio.currentTime = 0;
        audio.play().catch(e => console.log("Erro ao tocar som:", e));
    }
}

function animateCounter(element, start, end, duration) {
    // Toca som ao iniciar animação
    tocarSomUsuariosOnline();
    
    let startTimestamp = null;
    const step = timestamp => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        element.textContent = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

function atualizarUsuariosOnline() {
    fetch('../api/contar_usuarios_online.php')
        .then(response => response.text())
        .then(data => {
            const novoValor = parseInt(data);
            const contador = document.getElementById('usuarios-online');
            const valorAtual = parseInt(contador.textContent);

            if (!isNaN(novoValor) && novoValor !== valorAtual) {
                animateCounter(contador, valorAtual, novoValor, 500); // toca som + animação
            }
        });
}

setInterval(atualizarUsuariosOnline, 5000);
atualizarUsuariosOnline();
</script>

<script>
function ativarSom() {
    const audio = document.getElementById('ativar');
    audio.play().then(() => {
        console.log('Som ativado com sucesso.');
    }).catch((e) => {
        console.warn('Erro ao ativar som:', e);
    });

    document.getElementById('som-popup').style.display = 'none';
}
</script>
 
 
    
  
  
    
    
    
    
    