<?php
// Define o tipo de retorno como JSON
header('Content-Type: application/json');

// Simulação de uma lista de banners
$banners = [
    [
        'id' => 1,
        'imagem' => 'https://7setetech.com/assets/uploads/depa.jpg1.jpg',
        'texto' => 'Aprenda com os melhores',
    ],
    [
        'id' => 2,
        'imagem' => 'https://7setetech.com/assets/uploads/capa-principal-do-pc-official.jpg2.jpg
',
        'texto' => 'Cursos com certificado',
    ],
    [
        'id' => 3,
        'imagem' => 'https://7setetech.com/assets/uploads/cap.jpg3.jpg',
        'texto' => 'Comece hoje mesmo',
    ]
];

// Retorna os dados como JSON
echo json_encode($banners);
