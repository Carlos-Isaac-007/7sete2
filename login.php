<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css?v=<?= filemtime('assets/css/login.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
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
    <script src="assets/js/login.js?v=<?= filemtime('assets/js/login.js') ?>" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <?php
        if (isset($_SESSION['customer'])) {
            // Caso contrário, vai para o painel
            header("https://localhost/7sete/dashboard");
            exit();
        }
    ?>
    <header class="header">
        <!-- Logo (substitua src pelo seu logo) -->
        <img src="assets/uploads/logoR.webp" alt="Logo" class="logo">
        <div class="header-icons">
            <!-- Ícone Home -->
            <a href="https://7setetech.com/" title="Home" class="nav-icon-btn">
                <i class="bi bi-house fs-5"></i>
            </a>
            <!-- Ícone Carrinho -->
            <a href="/carrinho" title="Carrinho" class="nav-icon-btn">
                <i class="bi bi-cart fs-5"></i>
            </a>
        </div>
    </header>
    <section class="containerPai">
        <div class="card loginActive">
            <div class="esquerda">
                <div class="formLogin">
                    <h2><i class="bi bi-person-circle"></i> Fazer Login</h2>
                    <div id="loginMessage" class="message-area"></div> <!-- Área de mensagem de login -->
                    <form id="loginForm">
                        <input type="email" placeholder="E-mail" name="cust_email" required>
                        <input type="password" placeholder="Palavra-passe" name="cust_password" required>
                        <button type="submit">Entrar</button>
                    </form>
                </div>
                <div class="facaLogin">
                    <h2>Já tem uma conta?</h2>
                    <p>Entre para aceder a todos os recursos.</p>
                    <button class="btnLogin">Fazer Login <i class="bi bi-box-arrow-in-right"></i></button>
                </div>
            </div>
            <div class="direita">
                <div class="formCadastro">
                    <h2><i class="bi bi-person-plus"></i> Criar Conta</h2>
                    <div id="registerMessage" class="message-area"></div> <!-- Área de mensagem de registro -->
                    <form id="registerForm">
                        <input type="text" placeholder="Nome Completo" name="nome" required>
                        <input type="email" placeholder="E-mail" name="email" required>
                        <input type="tel" placeholder="Telefone" name="telefone" required>
                        <input type="password" placeholder="Palavra-passe" name="senha" required>
                        <input type="password" placeholder="Confirmar Palavra-passe" name="confirmarSenha" required>
                        <button type="submit">Registar</button>
                    </form>
                </div>
                <div class="facaCadastro">
                    <h2>Primeira vez aqui?</h2>
                    <p>Crie sua conta e aproveite todos os benefícios!</p>
                    <button class="btnCadastro">Registar-se <i class="bi bi-person-plus"></i></button>
                </div>
            </div>
        </div>
    </section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');
    const loginMessage = document.getElementById('loginMessage');
    // Exemplo para registro
    const registerForm = document.getElementById('registerForm');
    const registerMessage = document.getElementById('registerMessage');

    loginForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        loginMessage.textContent = ''; // Limpa mensagem anterior

        const formData = new FormData(loginForm);
        const data = Object.fromEntries(formData.entries());

        try {
            const response = await fetch('http://localhost/7sete/api/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                credentials: 'include',
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                loginMessage.textContent = 'Login realizado com sucesso!';
                loginMessage.style.color = 'green';
                loginMessage.style.padding= '5px';
                loginMessage.style.background= '#d4edda';
                loginMessage.style.border = '1px solid #c3e6cb';
                loginMessage.style.fontSize = '8px';
                window.location.href = result.redirect;
            } else {
                loginMessage.textContent = result.error || 'Erro ao fazer login.';
                loginMessage.style.color = '#721c24';
                loginMessage.style.padding= '5px';
                loginMessage.style.background= '#f8d7da';
                loginMessage.style.color = 'red';
                loginMessage.style.border = '1px solid #f5c6cb';
                loginMessage.style.fontSize = '8px';
            }
        } catch (error) {
            loginMessage.textContent = 'Erro de conexão com o servidor.';
            loginMessage.style.color = 'red';
        }
    });

   // REGISTRO
    registerForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        registerMessage.textContent = '';

        const formData = new FormData(registerForm);
        const data = Object.fromEntries(formData.entries());

        try {
            const response = await fetch('http://localhost/7sete/api/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                credentials: 'include',
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
               if(result.status === 'success') {
                    Swal.fire({
                    icon: 'success',
                    title: 'Conta criada!',
                    text: 'Enviamos um e-mail para ativar sua conta. Verifique sua caixa de entrada ou spam.',
                    confirmButtonText: 'OK'
                });
                registerMessage.textContent = result.message || 'Conta criada com sucesso!';
                registerMessage.style.color = 'green';
                registerMessage.style.padding = '5px';
                registerMessage.style.background = '#d4edda';
                registerMessage.style.border = '1px solid #c3e6cb';
                registerMessage.style.fontSize = '8px';
                registerForm.reset();
                } else {
                    registerMessage.textContent = result.message || 'Erro ao registrar usuário.';
                    registerMessage.style.color = 'red';
                    registerMessage.style.padding = '5px';
                    registerMessage.style.background = '#f8d7da';
                    registerMessage.style.border = '1px solid #f5c6cb';
                    registerMessage.style.fontSize = '8px';
                }
            } else {
                registerMessage.textContent = result.message || 'Erro ao registrar usuário.';
                registerMessage.style.color = 'red';
                registerMessage.style.padding = '5px';
                registerMessage.style.background = '#f8d7da';
                registerMessage.style.border = '1px solid #f5c6cb';
                registerMessage.style.fontSize = '8px';
            }
        } catch (error) {
            registerMessage.textContent = 'Erro de conexão com o servidor.';
            registerMessage.style.color = 'red';
        }
    });
});
</script>
</body>
</html>