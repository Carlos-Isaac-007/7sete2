<?php require_once('header.php'); ?>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
$cta_title = $row['cta_title'];
$cta_content = $row['cta_content'];
$cta_read_more_text = $row['cta_read_more_text'];
$cta_read_more_url = $row['cta_read_more_url'];
$cta_photo = $row['cta_photo'];
$featured_product_title = $row['featured_product_title'];
$featured_product_subtitle = $row['featured_product_subtitle'];
$latest_product_title = $row['latest_product_title'];
$latest_product_subtitle = $row['latest_product_subtitle'];
$popular_product_title = $row['popular_product_title'];
$popular_product_subtitle = $row['popular_product_subtitle'];
$total_featured_product_home = $row['total_featured_product_home'];
$total_latest_product_home = $row['total_latest_product_home'];
$total_popular_product_home = $row['total_popular_product_home'];
$home_service_on_off = $row['home_service_on_off'];
$home_welcome_on_off = $row['home_welcome_on_off'];
$home_featured_product_on_off = $row['home_featured_product_on_off'];
$home_latest_product_on_off = $row['home_latest_product_on_off'];
$home_popular_product_on_off = $row['home_popular_product_on_off'];

}


?>
<style>
/* Container principal */
.avaliacao-container {
    width: 100%;
    max-width: 320px;
    margin: 20px auto;
    text-align: center;
    padding: 15px;
    border-radius: 10px;
    background: #fff;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

/* Título */
.avaliacao-container h3 {
    font-size: 18px;
    color: #333;
    margin-bottom: 10px;
}

/* Estrelas */
.estrelas {
    display: flex;
    justify-content: center;
    gap: 5px;
}

/* Estilo padrão das estrelas */
.estrela {
    font-size: 30px;
    cursor: pointer;
    color: #ccc;
    transition: color 0.3s;
}

/* Efeito hover e clique */
.estrela:hover,
.estrela.hover,
.estrela.selecionada {
    color: #ffcc00;
}

/* Texto de feedback */
#avaliacao-texto {
    font-size: 14px;
    color: #666;
    margin-top: 10px;
}

/* Campo de Comentário */
textarea {
    width: 100%;
    max-width: 280px;
    height: 80px;
    margin-top: 10px;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ddd;
    font-size: 14px;
    resize: none;
}

/* Botão Enviar */
button {
    margin-top: 10px;
    padding: 10px 15px;
    background: #ffcc00;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #ffb700;
}

/* 🔽 Responsividade (Desktop) */
@media (min-width: 768px) {
    .avaliacao-container {
        max-width: 400px;
    }
    .estrela {
        font-size: 35px;
    }
    textarea {
        max-width: 350px;
    }
}
    
</style>


<div class="page">
<div class="container">
<div class="row">            
<div class="col-md-12">
<p>
<?php if(isset($_GET['fase'])):?>
<?php 
$percent = "0%";
$bg_progress = "bg";

if($_GET['fase'] == "processamento") {
    $percent = "30%";
    $bg_progress = "bg-info";
} 
elseif($_GET['fase'] == "caminho"){
    $percent = "60%";
    $bg_progress = "bg-warning";
}  
elseif($_GET['fase'] == "concluido"){
    $percent = "100%";
    $bg_progress = "bg-success";
}  
?>
<?php if($percent == "100%"):?>

<?php else:?>
<div class="progress">
  <div class="progress-bar bg-success" style="width:100%"></div>
</div>
<?php endif?>
 

<div class="output">
   <?php if($percent == "100%"):?>
    <h4><span><b>Concluido</b></span><i class="fas fa-check-circle text-success"></i></h4>
    <?php elseif($percent == "60%"):?>
       <h4> <span>Produto á Caminho</span><div class="spinner-border text-muted"></div></h4>
       <?php else:?>
        <h4> <span>Produto em Processamento </span><div class="spinner-border text-muted"></div></h4>
    <?php endif?>
 
  </div>
  <?php 
    if($percent == "100%"){
        ?>
          <div class="avaliacao-container">
    <h3>Avalie este produto</h3>
    
    <!-- Estrelas -->
    <div class="estrelas">
        <span class="estrela" data-value="1">★</span>
        <span class="estrela" data-value="2">★</span>
        <span class="estrela" data-value="3">★</span>
        <span class="estrela" data-value="4">★</span>
        <span class="estrela" data-value="5">★</span>
    </div>
    
    <p id="avaliacao-texto">Clique nas estrelas para avaliar</p>

    <!-- Campo de Comentário -->
    <textarea id="comentario" placeholder="Digite seu comentário..."></textarea>

    <!-- Botão Enviar -->
    <button id="enviarAvaliacao">Enviar Avaliação</button>
</div>

        <script>
            const urlParams = new URLSearchParams(window.location.search);
            const cliente_id = urlParams.get("cliente_id");  // Obtém o valor de "id"
            const product_id = urlParams.get("product_id");  // Obtém o valor de "nome"
            
           // console.log("cliente_id:", cliente_id);
            //console.log("product_id:", product_id);

        </script>


        <?php
    }
  
  ?>
   <!-- Blue -->
<div class="progress">
<div class="progress-bar <?= $bg_progress ?>" style="width:<?=$percent?>"></div>
</div>
<?php if($home_featured_product_on_off == 1): ?>
<div class="product">
<div class="container">

<div class="row">
<div class="col-md-12">
<div class="headline">
<h2><?php echo $featured_product_title; ?></h2>
<h3><?php echo $featured_product_subtitle; ?></h3>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<?php 
$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_featured=? AND p_is_active=? ORDER BY RAND() LIMIT ".$total_featured_product_home);
$statement->execute(array(1,1));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
if ( is_array($result)){
   
   require_once('carrosel_horizontal_feacture.php');
}

?>

</div>
</div>

</div>
</div>
<?php endif; ?>


<?php if($home_latest_product_on_off == 1): ?>
<div class="product bg-gray ">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="headline">
<h2><?php echo $latest_product_title; ?></h2>
<h3><?php echo $latest_product_subtitle; ?></h3>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<!-- aQUI VAI O COMPONENETE CARROSEL HORIZONTAL-->
<?php  
$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY RAND() LIMIT ".$total_latest_product_home);
$statement->execute(array(1));
$result = $statement->fetchAll(PDO::FETCH_ASSOC); 

if (is_array($result)){
    require_once('carrosel_horizontal_latest.php');
}
?>
</div>
</div>
</div>
<?php endif; ?>


<?php if($home_popular_product_on_off == 1): ?>
<div class="product">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="headline">
<h2><?php echo $popular_product_title; ?></h2>
<h3><?php echo $popular_product_subtitle; ?></h3>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
   <?php 
        $statement = $pdo->prepare("SELECT * FROM tbl_product  WHERE p_is_active=? ORDER BY RAND() LIMIT ".$total_popular_product_home);
        $statement->execute(array(1));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(is_array(($result))){
            require_once('carrosel_horizontal_popular.php');
        }
        ?>


</div>
</div>
</div>
</div>
<?php endif; ?>

<?php else:?>

 <?php endif?>   

<div class="d-flex justify-content-center my-3 ">
    <a href="https://7setetech.com/" class=" btn btn-primary btn-lg"> Voltar na Pagina principal</a>
</div>

</div>
</div>
</div>
</div>

<?php require_once('footer.php'); ?>
<?php require_once 'modal_success.php';  ?>


<script>
 // codigo para abrir o modal succes 
    function showSuccessModal(message = "Produto adicionado com sucesso!") {
    const modal = document.getElementById("successModal");
    const messageText = modal.querySelector(".modal-message");
    const closeButton = modal.querySelector(".close-btn");

    messageText.textContent = message; // Atualiza a mensagem
    modal.style.display = "flex"; // Exibe o modal

    // Fecha ao clicar no botão X
    closeButton.onclick = function () {
        modal.style.display = "none";
    };

    // Fecha automaticamente após 3 segundos
    setTimeout(() => {
        modal.style.display = "none";
    }, 3000);
}
// pegando os dados da avalia;ao do clienete e mandar no php ou no mysql e dar um feedback bonito    
document.addEventListener("DOMContentLoaded", function() {
    const estrelas = document.querySelectorAll(".estrela");
    const textoAvaliacao = document.getElementById("avaliacao-texto");
    const comentario = document.getElementById("comentario");
    const botaoEnviar = document.getElementById("enviarAvaliacao");

    let notaSelecionada = 0; // Guarda a nota escolhida pelo usuário

    estrelas.forEach(estrela => {
        estrela.addEventListener("mouseover", function() {
            resetarEstrelas();
            let valor = this.getAttribute("data-value");
            destacarEstrelas(valor);
        });

        estrela.addEventListener("click", function() {
            notaSelecionada = this.getAttribute("data-value");
            resetarEstrelas();
            destacarEstrelas(notaSelecionada, true);
            textoAvaliacao.innerText = `Você avaliou com ${notaSelecionada} estrelas!`;
        });

        estrela.addEventListener("mouseout", function() {
            resetarEstrelas();
        });
    });

    function destacarEstrelas(valor, fixar = false) {
        estrelas.forEach(estrela => {
            if (estrela.getAttribute("data-value") <= valor) {
                estrela.classList.add(fixar ? "selecionada" : "hover");
            }
        });
    }

    function resetarEstrelas() {
        estrelas.forEach(estrela => {
            estrela.classList.remove("hover", "selecionada");
        });
    }

    // Evento de clique no botão de envio
    botaoEnviar.addEventListener("click", function() {
        if (notaSelecionada === 0) {
            alert("Por favor, selecione uma nota antes de enviar.");
            return;
        }

        let comentarioTexto = comentario.value.trim();
        if (comentarioTexto === "") {
            alert("Por favor, escreva um comentário.");
            return;
        }

        // Enviar para o servidor via AJAX
        enviarAvaliacao(notaSelecionada, comentarioTexto);
    });

    function enviarAvaliacao(nota, comentario) {
        console.log("Nota enviada:", nota);
        console.log("Comentário enviado:", comentario);

        // Aqui você pode usar AJAX para enviar os dados ao backend PHP
        fetch("<?=ROOT?>salvar_avaliacao.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `nota=${nota}&comentario=${encodeURIComponent(comentario)}&cliente_id=${cliente_id}&product_id=${product_id}`
        })
        .then(response => response.text())
        .then(data => {
        //alert("Avaliação enviada com sucesso!");
          // console.log(data);
           nwe_data = JSON.parse(data)
            showSuccessModal(nwe_data.message)
        })
        .catch(error => console.error("Erro ao enviar avaliação:", error));
    }
});
</script>




