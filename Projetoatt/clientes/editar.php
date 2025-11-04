<?php
$arquivo = __DIR__ . '/clientes.json';

if (!file_exists($arquivo)) {
    die('Arquivo de dados não encontrado.');
}

$clientes = json_decode(file_get_contents($arquivo), true);

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!$id) {
    die('ID não informado.');
}

$cliente = null;
foreach ($clientes as $c) {
    if ($c['id'] == $id) {
        $cliente = $c;
        break;
    }
}

if (!$cliente) {
    die('Cliente não encontrado.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($clientes as &$c) {
        if ($c['id'] == $id) {
            $c['nome'] = $_POST['nome'] ?? $c['nome'];
            $c['email'] = $_POST['email'] ?? $c['email'];
            $c['telefone'] = $_POST['telefone'] ?? $c['telefone'];
            break;
        }
    }
    file_put_contents($arquivo, json_encode($clientes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    header('Location: listar.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>
    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>"><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>"><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>
    <br>
    <a href="listar.php">Voltar</a>
</body>
</html>
