<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>INSURGÊNCIA - Descubra sua verdadeira face!</title>
  <link rel="stylesheet" href="./css/style2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <!-- Cabeçalho -->
  <header>
    <div class="header-bg"></div>
    <h1>.INSURGÊNCiA</h1>
    <nav style="align-items: center;">
      <a href="index.php">.home</a>
      <a href="produtos.php">.produtos</a>
      <a href="#">.contato</a>

      <?php if (isset($_SESSION['id_usuario'])): ?>
        <span style="color:#c00;font-weight:bold;">
          .olá, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>
        </span>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <a href="admin.php" style="color:#0f0;font-weight:bold;">.painel</a>
        <?php endif; ?>
        <a href="logout.php">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      <?php else: ?>
        <a href="login.php">.login</a>
      <?php endif; ?>
    </nav>
  </header>

  <!-- Espaço para header fixo -->
  <div style="height:90px; background:#000;"></div>

  <!-- Detalhe do produto -->
  <main class="detalhe-produto">
    <?php
    include 'conexao.php';

    if (isset($_GET['id_produto'])) {
        $id = intval($_GET['id_produto']);

        $sql = "SELECT id_produto, nome, imagem, preco, descricao FROM produtos WHERE id_produto = $id";
        $resultado = $conexao->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();

            echo "<div class='produto-detalhe-container'>";

            // Exibe imagem
            if (!empty($row["imagem"])) {
                $imagemBase64 = base64_encode($row["imagem"]);
                echo "<img class='produto-detalhe-img' src='data:image/jpeg;base64,{$imagemBase64}' alt='" . htmlspecialchars($row["nome"]) . "'>";
            } else {
                echo "<img class='produto-detalhe-img' src='imagens/sem-imagem.jpg' alt='Sem imagem'>";
            }

            echo "<div class='produto-detalhe-info'>";
            echo "<h2>" . htmlspecialchars($row["nome"]) . "</h2>";
            echo "<p class='preco'>R$ " . number_format($row["preco"], 2, ',', '.') . "</p>";
            echo "<p class='descricao'>" . htmlspecialchars($row["descricao"]) . "</p>";
            echo "<a class='botao-voltar' href='index.php'>Voltar</a>";
            echo "</div>";

            echo "</div>";
        } else {
            echo "<p>Produto não encontrado.</p>";
        }
    } else {
        echo "<p>ID do produto não informado.</p>";
    }

    $conexao->close();
    ?>
  </main>

  <footer>
    <p>© 2025 Insurgência - Todos os direitos reservados</p>
  </footer>
</body>
</html>
