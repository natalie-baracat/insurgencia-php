<?php
session_start(); // inicia sessão
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>INSURGÊNCIA - Vista seu verdadeiro eu</title>
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
      <a href="#">.produtos</a>
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

  <!-- Banner com parallax e fade -->
  <section class="banner">
    <div class="banner-bg banner1"></div>
    <div class="banner-bg banner2"></div>
    <h2>Descubra sua verdadeira face!</h2>
  </section>

  <!-- Lista de produtos -->
  <main>
    <h2>Camisetas em destaque</h2>
    <div class="produtos">
      <?php
      include 'conexao.php';
      $sql = "SELECT nome, imagem, preco, descricao FROM produtos";
      $resultado = $conexao->query($sql);

      if ($resultado->num_rows > 0) {
          while($row = $resultado->fetch_assoc()) {
              echo "<div class='produto'>";
              
              // Exibe imagem armazenada no banco (tipo LONG BLOB)
              $imagemBase64 = base64_encode($row["imagem"]);
              echo "<img src='data:image/jpeg;base64,{$imagemBase64}' alt='" . htmlspecialchars($row["nome"]) . "'>";

              echo "<h3>" . htmlspecialchars($row["nome"]) . "</h3>";
              echo "<p>R$ " . number_format($row["preco"], 2, ',', '.') . "</p>";
              echo "<a href='#'>Ver mais</a>";
              echo "</div>";
          }
      } else {
          echo "Nenhum produto encontrado.";
      }

      $conexao->close();
      ?>
    </div>
  </main>

  <!-- Rodapé -->
  <footer>
    <p>© 2025 Insurgência - Todos os direitos reservados</p>
  </footer>

  <!-- Script inline para fade do banner -->
  <script>
    const banner = document.querySelector('.banner');
    const banner2 = document.querySelector('.banner2');

    window.addEventListener('scroll', () => {
      const scrollTop = window.scrollY;
      const bannerHeight = banner.offsetHeight;

      // Opacidade baseada na rolagem
      let opacity = scrollTop / bannerHeight;
      if(opacity > 1) opacity = 1;

      banner2.style.opacity = opacity;
    });
  </script>
</body>
</html>
