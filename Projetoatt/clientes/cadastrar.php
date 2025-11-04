<?php
$arquivo = __DIR__ . '/clientes.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';

    $clientes = file_exists($arquivo) ? json_decode(file_get_contents($arquivo), true) : [];

    $novo_id = (!empty($clientes)) ? end($clientes)['id'] + 1 : 1;

    $clientes[] = [
        'id' => $novo_id,
        'nome' => $nome,
        'email' => $email,
        'telefone' => $telefone
    ];

    file_put_contents($arquivo, json_encode($clientes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    header('Location: listar.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Cliente</title>
</head>
<body>
    <h1>Cadastrar Cliente</h1>
    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone"><br><br>

        <button type="submit">Salvar</button>
    </form>
    <br>
    <a href="listar.php">Voltar</a>
</body>
</html>
