<?php
$arquivo = __DIR__ . '/clientes.json';

if (!isset($_GET['id'])) {
    die('ID não informado.');
}

$id = intval($_GET['id']);
$clientes = file_exists($arquivo) ? json_decode(file_get_contents($arquivo), true) : [];

$clientes = array_filter($clientes, function($c) use ($id) {
    return $c['id'] !== $id;
});

file_put_contents($arquivo, json_encode(array_values($clientes), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

header('Location: listar.php');
exit;
