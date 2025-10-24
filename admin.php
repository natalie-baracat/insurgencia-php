<?php
session_start();

// 🔒 Protege o acesso — apenas admins podem entrar
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include "conexao.php";

// Consulta os produtos cadastrados
$sql = "SELECT id_produto, nome, preco, imagem FROM produtos";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Painel Admin - INSURGÊNCIA</title>
  <link rel="stylesheet" href="./css/style2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    .admin-container {
      max-width: 1000px;
      margin: 40px auto;
      padding: 20px;
      background: rgba(0,0,0,0.6);
      border-radius: 10px;
      color: #fff;
    }
    .admin-container h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }
    table th, table td {
      border: 1px solid #444;
      padding: 10px;
      text-align: center;
    }
    table th {
      background-color: #222;
    }
    a.btn {
      background-color: #c00;
      color: white;
      padding: 8px 12px;
      text-decoration: none;
      border-radius: 6px;
    }
    a.btn:hover {
      background-color: #900;
    }
  </style>
</head>
<body>
  <header>
    <div class="header-bg"></div>
    <h1>.INSURGÊNCiA</h1>
    <nav>
      <a href="index.php">.home</a>
      <a href="cadastrar_produto.php">.cadastrar produto</a>
      <a href="logout.php">.sair</a>
    </nav>
  </header>

  <main>
    <div class="admin-container">
      <h2>Painel Administrativo</h2>

      <a href="cadastrar_produto.php" class="btn"><i class="fas fa-plus"></i> Novo Produto</a>

      <?php if ($result && $result->num_rows > 0): ?>
        <table>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Imagem</th>
          </tr>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['id_produto']); ?></td>
              <td><?php echo htmlspecialchars($row['nome']); ?></td>
              <td>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
              <td><img src="<?php echo htmlspecialchars($row['imagem']); ?>" alt="" width="80"></td>
            </tr>
          <?php endwhile; ?>
        </table>
      <?php else: ?>
        <p style="text-align:center;">Nenhum produto cadastrado ainda.</p>
      <?php endif; ?>
    </div>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> INSURGÊNCIA - Todos os direitos reservados.</p>
  </footer>
</body>
</html>
