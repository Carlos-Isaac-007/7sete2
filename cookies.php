<?php

// Tempo de expiração do cache (em segundos) esse cookie vai armazenar as pagina carregadas 
$cache_lifetime = 3600; // 1 hora

// Caminho do arquivo de cache
$cache_file = $_SERVER['DOCUMENT_ROOT'] . '/cache/' . md5($_SERVER['REQUEST_URI']) . '.html';


// Verifica se o cache existe e está dentro do tempo de expiração
if (file_exists($cache_file) && (filemtime($cache_file) > (time() - $cache_lifetime))) {
    // Se o cache for válido, lê o conteúdo do arquivo cacheado
    echo file_get_contents($cache_file);
    exit; // Saí da execução do script e exibe o cache
} else {
    // Começa a capturar a saída para cache
    ob_start();
}


// Tempo de expiração dos cookies (7 dias)
$cookie_expiration = time() + (7 * 24 * 60 * 60);

// Início do tempo de carregamento
$start_time = microtime(true);

// Página atual (ex: /index.php, /contato.php)
$current_page = strtolower(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Lê cookies existentes corretamente como array associativo
$visited_pages = isset($_COOKIE['visited_pages']) 
    ? json_decode($_COOKIE['visited_pages'], true) 
    : [];

if (!is_array($visited_pages)) {
    $visited_pages = []; // garante array
}

// Atualiza contagem
if (isset($visited_pages[$current_page])) {
    $visited_pages[$current_page]++;
} else {
    $visited_pages[$current_page] = 1;
}

// Salva cookie atualizado
setcookie('visited_pages', json_encode($visited_pages), $cookie_expiration, "/");

// Carrega tempos anteriores
$previous_times = isset($_COOKIE['page_load_time']) ? json_decode($_COOKIE['page_load_time'], true) : [];
if (!is_array($previous_times)) {
    $previous_times = [];
}

// Limita quantidade de registros
$max_records = 10;
if (count($previous_times) >= $max_records) {
    array_shift($previous_times);
}

// Após carregamento, salva tempo
register_shutdown_function(function () use ($start_time, $cookie_expiration, $previous_times) {
    $end_time = microtime(true);
    $load_time = round($end_time - $start_time, 2);
    $previous_times[] = $load_time;
    setcookie('page_load_time', json_encode($previous_times), $cookie_expiration, "/");
});




/*
if (isset($_COOKIE['visited_pages'])) {
    $visited = json_decode($_COOKIE['visited_pages'], true);
    if (is_array($visited)) {
        echo "<div class='stat-item'>";
        echo "<h3>🧭 Páginas visitadas</h3><ul>";
        foreach ($visited as $page => $count) {
            $safePage = htmlspecialchars($page);
            echo "<li><a href='$safePage'>$safePage</a> — <span>$count visitas</span></li>";
        }
        echo "</ul></div>";
    }
}

?>*/






