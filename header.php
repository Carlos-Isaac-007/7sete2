<?php define("ROOT", "https://7setetech.com/"); require_once "requires/head.php" ?>
<body>
<!-- top bar -->
<style>
  .top-bar-fixed{
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1050;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  }
</style>
<div class="top-bar-fixed">
  <header class="custom-header shadow-sm py-2 bg-white">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between flex-nowrap gap-2 custom-header-row">
        <!-- Logo à esquerda -->
        <div class="custom-header-logo flex-shrink-0">
          <a href="https://7setetech.com/" class="d-inline-block">
            <img src="assets/uploads/<?php echo $logo; ?>" alt="Logo" class="custom-header-logo-img">
          </a>
        </div>
        <!-- Barra de pesquisa centralizada no desktop, oculta no mobile -->
        <div class="custom-searchbar-wrapper flex-grow-1 d-none d-lg-flex justify-content-center align-items-center" style="min-width:0;">
          <div class="custom-searchbar w-100" style="max-width:420px;min-width:180px;">
            <form class="input-group" action="<?=ROOT?>search-result" method="get" autocomplete="off">
              <input type="text" class="form-control rounded-start-pill" placeholder="<?php echo LANG_VALUE_2; ?>" name="search_text" id="InputPesquisarDesktop" required>
              <button class="btn btn-outline-primary rounded-end-pill px-3" type="submit" title="Pesquisar">
                <i class="bi bi-search"></i>
              </button>
            </form>
            <div id="resultadoBuscaDesktop" class="custom-search-results position-absolute w-100 z-3"></div>
          </div>
        </div>
      
        <!-- Ícones à direita -->
        <div class="d-flex align-items-center gap-2 custom-header-actions ms-lg-3 ms-auto">
          <?php if(isset($_SESSION['customer'])):?>
            <a href="<?=ROOT?>dashboard" class="nav-icon-btn" title="Painel">
              <i class="bi bi-person fs-5"></i>
            </a>
          <?php else:?>
            <a href="<?=ROOT?>login" class="nav-icon-btn" title="Entrar">
              <i class="bi bi-box-arrow-in-right fs-5"></i>
            </a>
          <?php endif;?>
          <!-- Botão moderno -->

            <style>
              .nav-icon-btn {
                  display: inline-flex;
                  align-items: center;
                  justify-content: center;
                  background-color: #000c78;
                  color: #ffffff;
                  width: 40px;
                  height: 40px;
                  border-radius: 50%;
                  transition: all 0.3s ease;
                  text-decoration: none;
                  box-shadow: 0 2px 8px rgba(0, 12, 120, 0.15);
                  position: relative;
                }

                .nav-icon-btn:hover {
                  background-color: #ffffff;
                  color: #000c78;
                  border: 2px solid #000c78;
                  transform: translateY(-2px);
                }

                .nav-icon-btn:focus {
                  outline: none;
                  box-shadow: 0 0 0 3px rgba(0, 12, 120, 0.3);
                }

            </style>

            <a href="<?=ROOT?>cart" id="cart-icon" class="nav-icon-btn position-relative" title="Carrinho">
              <i class="bi bi-cart fs-5"></i>
            <?php if($qt > 0): ?>
            <span id="cart-badge" class="badge"><?=$qt?></span>
            <?php endif; ?>
          </a>
          <style>
            #menuToggle {
              background: transparent;
              border: none;
              font-size: 1.5rem;
              color: #000c78;
              cursor: pointer;
              z-index: 1001;
              transition: transform 0.3s ease;
              border-left: 1px solid #000c78;
              padding-left: 5px;
            }

            #menuToggle:focus {
              outline: none;
              transform: scale(1.1);
            }
          </style>
            <button id="menuToggle" class="" aria-label="Abrir menu" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>
        </div>
      </div>
          <!-- Barra de pesquisa: visível apenas no mobile (abaixo dos ícones e logo) -->
      <div class="custom-searchbar-wrapper mt-2 d-lg-none">
        <div class="" style="max-width:100vw;min-width:0;">
          <form class="input-group" action="<?=ROOT?>search-result" method="get" autocomplete="off">
            <input type="text" class="form-control rounded-start-pill" placeholder="<?php echo LANG_VALUE_2; ?>" name="search_text" id="InputPesquisarMobile" required>
            <button class="btn btn-outline-primary rounded-end-pill px-3" type="submit" title="Pesquisar">  
            <style>
              .bi-search{
                color: #000c78 !important;
              }
            </style>
            <i class="bi bi-search fs-5" style="color: #000c78;"></i>
            </button>
          </form>
          <div id="resultadoBuscaMobile" class="custom-search-results position-absolute w-100 z-3"></div>
        </div>
      </div>
      </div>
  </header>

      <style>
      /* Header moderno e responsivo */
      .custom-header {
        border-radius: 14px;
        transition: box-shadow 0.2s;
      }
      .custom-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: nowrap;
        gap: 0;
      }
      .custom-header-logo {
        display: flex;
        align-items: center;
        min-width: 120px;
        flex: 0 0 auto;
      }
      .custom-header-logo-img {
        object-fit: contain;
        height: 48px;
        width: auto;
        max-width: 160px;
        transition: height 0.2s;
        display: block;
      }
      .custom-searchbar-wrapper {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex: 1 1  auto;
        min-width: 150px;
      }
      .custom-searchbar {
        position: relative;
        width: 100%;
        max-width: 420px;
        min-width: 180px;
      }
      .custom-searchbar .form-control {
        background: #f7f9fa;
        border: 1px solid #e3e6ea;
        font-size: 1rem;
        padding-left: 1.1rem;
        padding-right: 1.1rem;
        min-width: 0;
      }
      .custom-searchbar .btn {
        border: 1px solid #e3e6ea;
        background: #fff;
        transition: background 0.2s, color 0.2s;
      }
      .custom-searchbar .btn:hover, .custom-searchbar .btn:focus {
        background: #e9f2ff;
        color: #0d6efd;
      }
      .custom-search-results {
        background: #fff;
        border: 1px solid #e3e6ea;
        border-radius: 0 0 12px 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.07);
        margin-top: 2px;
        display: none;
        max-height: 260px;
        overflow-y: auto;
      }
      .custom-search-results ul {
        list-style: none;
        margin: 0;
        padding: 0;
      }
      .custom-search-results .item-busca {
        padding: 0.7rem 1.1rem;
        cursor: pointer;
        transition: background 0.15s;
        border-bottom: 1px solid #f1f1f1;
        font-size: 1rem;
      }
      .custom-search-results .item-busca:last-child {
        border-bottom: none;
      }
      .custom-search-results .item-busca:hover {
        background: #f0f4ff;
        color: #0d6efd;
      }
      .custom-header-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        min-width: 90px;
        flex: 0 0 auto;
      }
      @media (max-width: 1199.98px) {
        .custom-header-logo-img {
          height: 38px;
          max-width: 120px;
        }
      }
      @media (max-width: 991px) {
        .custom-header {
          border-radius: 0;
          margin: 0;
          box-shadow: none;
        }
        .custom-header-row {
          flex-direction: row;
          align-items: center;
          gap: 0.5rem;
        }
        .custom-header-logo-img {
          height: 38px;
          max-width: 120px;
        }
        .custom-header-actions {
          gap: 0.5rem;
        }
        .custom-searchbar-wrapper {
          margin-top: 10px;
          margin-bottom: 0;
          width: 100%;
          display: block;
        }
        .custom-searchbar {
          max-width: 100vw;
          min-width: 0;
          width: 100%;
          margin: 0 !important;
        }
      }
      @media (max-width: 991.98px) {
        /* No mobile/tablet, barra de pesquisa ocupa 100% e fica abaixo */
        .custom-searchbar-wrapper {
          justify-content: stretch !important;
          width: 100%;
          margin-top: 10px;
        }
      }
      @media (max-width: 575.98px) {
        .custom-header-row {
          flex-direction: row;
          align-items: center;
          gap: 0.5rem;
        }
        .custom-header-logo-img {
          height: 32px;
          max-width: 90px;
        }
        .custom-searchbar-wrapper {
          margin-top: 10px;
          margin-bottom: 0;
          width: 100%;
          display: block;
        }
        .custom-searchbar {
          max-width: 100vw;
          min-width: 0;
          width: 100%;
          margin: 0 !important;
        }
      }
      </style>



  <!-- Inicio da nova nav -->

  <nav class="main-navbar-modern">
    <div class="container">
      <div class="row">
        <div class="col-md-12 pl_0 pr_0">
          <div class="main-navbar-container">
            <div class="main-navbar-menu">
              <ul class="main-navbar-list align-items-center">
                <li>
                  <a href="<?=ROOT?>home">
                    <i class="fas fa-home"></i> <span>Home</span>
                  </a>
                </li>
                <?php
                $statement = $pdo->prepare("SELECT * FROM tbl_top_category WHERE show_on_menu=1");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                $icones = ['bolsa.webp', 'beleza.webp', 'escritorio.webp', 'car.webp',
                'books.webp', 'pet.webp', 'tecn.webp', 'drink.webp', 'beleza.webp'];
                $i = 0;
                foreach ($result as $row) {
                  // Limita o nome da categoria a 18 caracteres
                  $tcat_name = mb_strlen($row['tcat_name']) > 18 ? mb_substr($row['tcat_name'], 0, 25) . '…' : $row['tcat_name'];
                ?>
                  <li class="main-navbar-dropdown">
                    <a href="<?=ROOT?>product-category?id=<?php echo $row['tcat_id']; ?>&type=top-category" title="<?php echo htmlspecialchars($row['tcat_name']); ?>">
                    <style>
                      .icone-img-<?=$i?>{
                          display: inline-block;
                          width: 40px;
                          height: 40px;
                          background-image: url('uploads/<?=$icones[$i]?>');
                          background-size: cover;
                          background-position: center;
                          border-radius: 50%;
                          transition: 0.3s ease-in-out;
                      }
                      
                    </style>  
                    <span class="icone-img-<?=$i?>"></span> <span><?php echo $tcat_name; ?></span>
                      <i class="fas fa-chevron-down main-navbar-dropdown-icon"></i>
                    </a>
                    <ul class="main-navbar-dropdown-menu">
                      <?php
                      $statement1 = $pdo->prepare("SELECT * FROM tbl_mid_category WHERE tcat_id=?");
                      $statement1->execute(array($row['tcat_id']));
                      $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($result1 as $row1) {
                        $mcat_name = mb_strlen($row1['mcat_name']) > 18 ? mb_substr($row1['mcat_name'], 0, 16) . '…' : $row1['mcat_name'];
                      ?>
                      <li class="main-navbar-dropdown-submenu">
                        <a href="<?=ROOT?>product-category?id=<?php echo $row1['mcat_id']; ?>&type=mid-category" title="<?php echo htmlspecialchars($row1['mcat_name']); ?>">
                          <i class="fas fa-layer-group"></i> <span><?php echo $mcat_name; ?></span>
                          <i class="fas fa-chevron-right main-navbar-dropdown-icon"></i>
                        </a>
                        <ul class="main-navbar-dropdown-menu">
                          <?php
                          $statement2 = $pdo->prepare("SELECT * FROM tbl_end_category WHERE mcat_id=?");
                          $statement2->execute(array($row1['mcat_id']));
                          $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
                          foreach ($result2 as $row2) {
                            $ecat_name = mb_strlen($row2['ecat_name']) > 18 ? mb_substr($row2['ecat_name'], 0, 16) . '…' : $row2['ecat_name'];
                          ?>
                          <li>
                            <a href="<?=ROOT?>product-category?id=<?php echo $row2['ecat_id']; ?>&type=end-category" title="<?php echo htmlspecialchars($row2['ecat_name']); ?>">
                              <i class="fas fa-cube"></i> <span><?php echo $ecat_name; ?></span>
                            </a>
                          </li>
                          <?php } ?>
                        </ul>
                      </li>
                      <?php } ?>
                    </ul>
                  </li>
                <?php $i++; } ?>

                <?php
                $statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);		
                foreach ($result as $row) {
                  $about_title = $row['about_title'];
                  $faq_title = $row['faq_title'];
                  $blog_title = $row['blog_title'];
                  $contact_title = $row['contact_title'];
                  $pgallery_title = $row['pgallery_title'];
                  $vgallery_title = $row['vgallery_title'];
                }
                ?>
                <li>
                  <a href="<?=ROOT?>about">
                    <i class="fas fa-info-circle"></i> <span><?php echo $about_title; ?></span>
                  </a>
                </li>
                <li>
                  <a href="<?=ROOT?>faq">
                    <i class="fas fa-question-circle"></i> <span><?php echo $faq_title; ?></span>
                  </a>
                </li>
                <li>
                  <a href="<?=ROOT?>contact">
                    <i class="fas fa-envelope"></i> <span><?php echo $contact_title; ?></span>
                  </a>
                </li>
                </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</div>
<style>
  
/* Modern UI/UX Styles for Navigation */
.main-navbar-modern {
  background: #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  border-radius: 12px;
  padding: 0 0.5rem;
  width: 100%;
  max-width: 1300px;
  min-width: 320px;
 
}
.main-navbar-menu {
  width: 100%;
}
.main-navbar-list {
  list-style: none;
  margin: 0;
  padding: 0;
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  justify-content: flex-start;
}
.main-navbar-list > li {
  position: relative;
  display: inline-block;
  vertical-align: top;
  min-width: 90px;
  max-width: 450px;
  margin-bottom: 0.5rem;
  text-align: center;
  white-space: nowrap;
}
.main-navbar-list > li > a {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  color: #222;
  font-weight: 500;
  padding: 0.75rem 1rem;
  border-radius: 8px;
  transition: background 0.2s, color 0.2s;
  text-decoration: none;
  height: 48px;
  max-width: 100%;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.main-navbar-list > li > a > i{
  color: #000c78;
}
.main-navbar-list > li > a:hover, .main-navbar-list > li > a:focus {
  background: #f5f5f5;
  color: #007bff;
}
.main-navbar-dropdown-icon {
  margin-left: 0.3rem;
  font-size: 0.8em;
}
.main-navbar-dropdown:hover > .main-navbar-dropdown-menu,
.main-navbar-dropdown-submenu:hover > .main-navbar-dropdown-menu {
  display: block;
}
.main-navbar-dropdown-menu {
  display: none;
  position: absolute;
  left: 0;
  top: 100%;
  min-width: 220px;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 8px 24px rgba(0,0,0,0.08);
  z-index: 100;
  padding: 0.5rem 0;
}
.main-navbar-dropdown-menu > li > a {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: #333;
  padding: 0.6rem 1.2rem;
  border-radius: 6px;
  text-decoration: none;
  font-size: 0.98em;
  transition: background 0.2s, color 0.2s;
  max-width: 200px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.main-navbar-dropdown-menu > li > a:hover {
  background: #f0f4ff;
  color: #007bff;
}

.main-navbar-dropdown-submenu {
  position: relative;
}
.main-navbar-dropdown-submenu > .main-navbar-dropdown-menu {
  left: 100%;
  top: 0;
  margin-left: 0.2rem;
}
@media (max-width: 991px) {
  .main-navbar-modern {
    border-radius: 0;
    margin: 0;
    box-shadow: none;
    max-width: 100vw;
    min-width: 0;
    padding: 0;
  }
  .main-navbar-list {
    flex-direction: column;
    gap: 0;
    width: 100%;
    display: block;
  }
  .main-navbar-list > li {
    min-width: 0;
    max-width: 100vw;
    width: 100%;
    display: block;
    text-align: left;
  }
  .main-navbar-list > li > a {
    justify-content: flex-start;
    height: 48px;
    width: 100%;
    padding-left: 1.5rem;
    max-width: 100vw;
  }
  .main-navbar-dropdown-menu {
    position: static;
    box-shadow: none;
    min-width: 100%;
    border-radius: 0;
  }
  .main-navbar-dropdown-menu > li > a {
    max-width: 95vw;
  }
  .main-navbar-dropdown-submenu > .main-navbar-dropdown-menu {
    left: 0;
    margin-left: 0;
  }
}
</style>
<style>
  .main-navbar-toggle {
    display: none;
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #000c78;
    cursor: pointer;
    margin-left: auto;
    padding: 0.75rem;
    transition: color 0.3s;
}
.main-navbar-toggle:hover {
  color: #007bff;
}

@media (max-width: 991px) {
  .main-navbar-toggle {
    display: block;
  }

  .main-navbar-list {
    display: none;
  }

  .main-navbar-list.active {
    display: block;
  }
  
}

@media (min-width: 992px) {
  .main-navbar-list {
    display: flex;
    transition: max-height 0.3s ease, opacity 0.3s ease;
    max-height: 1000px;
    opacity: 1;

  }

  .main-navbar-list.hidden{
    max-height: 0;
    opacity: 0;
    overflow: hidden;
    pointer-events: none;
  }

  .main-navbar-toggle{
    display: block;
  }
}
</style>


<script>
 document.addEventListener('DOMContentLoaded', function () {
  const toggle = document.getElementById('menuToggle');
  const menu = document.querySelector('.main-navbar-list');

  let lastScrollTop = 0;
  const isDesktop = () => window.innerWidth >= 992;

  function updateMenuButton(isOpen) {
    toggle.innerHTML = isOpen
      ? '<i class="fas fa-times"></i>'
      : '<i class="fas fa-bars"></i>';
    toggle.setAttribute('aria-expanded', isOpen);
    toggle.setAttribute('aria-label', isOpen ? 'Fechar menu' : 'Abrir menu');
  }

  // Estado inicial do botão ao carregar
  if (isDesktop() && !menu.classList.contains('hidden')) {
    menu.classList.add('active'); // garante que esteja com classe correta
    updateMenuButton(true); // exibe o ícone de fechar
  }

  toggle.addEventListener('click', function () {
    const isOpen = menu.classList.toggle('active');
    menu.classList.toggle('hidden', !isOpen);
    updateMenuButton(isOpen);

    //Lógica extra: aplicar estilo se o menu for fechado manualmente sem rolagem
    const scrollY = window.pageYOffset || document.documentElement.scrollTop;
    if(isDesktop()){
      if (!isOpen && scrollY <= 10) {
        // Aqui você pode alterar qualquer estilo — exemplo:
        document.body.style.paddingTop = "70px"; // ou menu.style.backgroundColor = "#ccc";
        // Exemplo com transição suave:
        menu.style.transition = "opacity 0.3s ease";
      } else{
        document.body.style.paddingTop = "260px";
        menu.style.transition = "opacity 0.3s ease";
      }
    }
  });

  // Ocultar ao rolar (apenas no desktop)
  if (isDesktop()) {
    window.addEventListener('scroll', function () {
      const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

      if (currentScroll > lastScrollTop && currentScroll > 100) {
        menu.classList.add('hidden');
        menu.classList.remove('active');
        document.body.style.paddingTop = "260px";
        menu.style.transition = "opacity 0.3s ease";
        updateMenuButton(false);
      } else if (currentScroll < lastScrollTop && currentScroll <= 10) {
        menu.classList.remove('hidden');
        menu.classList.add('active');
        updateMenuButton(true);
      }

      lastScrollTop = Math.max(0, currentScroll);
    });
  }
});

</script>
