<?php
$arquivo = __DIR__ . '/clientes.json';

$clientes = file_exists($arquivo) ? json_decode(file_get_contents($arquivo), true) : [];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
</head>
<body>
    <h1>Lista de Clientes</h1>
    <a href="cadastrar.php">Cadastrar Novo Cliente</a> |
    <a href="../index.php">Voltar ao Menu</a>
    <br><br>

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
        <?php if(!empty($clientes)): ?>
            <?php foreach ($clientes as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['id']) ?></td>
                    <td><?= htmlspecialchars($c['nome']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td><?= htmlspecialchars($c['telefone']) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $c['id'] ?>">Editar</a> |
                        <a href="excluir.php?id=<?= $c['id'] ?>" onclick="return confirm('Confirmar exclusão?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">Nenhum cliente cadastrado.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
