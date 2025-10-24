<?php
session_start();
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $nome    = $_POST['nome_usuario'];
    $numero  = $_POST['numero'];
    $senha   = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (usuario, nome_usuario, numero, senha) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssss", $usuario, $nome, $numero, $senha);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        $erro = "Erro ao cadastrar: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro - INSURGÊNCIA</title>
  <link rel="stylesheet" href="./css/style2.css">
</head>
<body>
  <!-- Cabeçalho -->
  <header>
    <div class="header-bg"></div>
    <h1>.INSURGÊNCiA</h1>
    <nav>
      <a href="index.php">.home</a>
      <a href="#">.produtos</a>
      <a href="#">.contato</a>
            <?php if (isset($_SESSION['id_usuario'])): ?>
        <span style="color:#c00;font-weight:bold;">
          .olá, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>
        </span>
        <a href="logout.php" title="Sair">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      <?php else: ?>
        <a href="login.php">.login</a>
      <?php endif; ?>
    </nav>
  </header>

  <div style="height:90px; background:#000;"></div>

  <main>
    <h2 style="text-align:center; color:#c00;">Cadastro de Usuário</h2>
    <form method="post" style="max-width:400px;margin:auto;background:#1a1a1a;padding:20px;border-radius:12px;">
      <label>Usuário:</label><br>
      <input type="text" name="usuario" required style="width:100%;padding:10px;margin:10px 0;background:#000;color:#fff;border:1px solid #c00;border-radius:6px;"><br>

      <label>Nome:</label><br>
      <input type="text" name="nome_usuario" required style="width:100%;padding:10px;margin:10px 0;background:#000;color:#fff;border:1px solid #c00;border-radius:6px;"><br>

      <label>Telefone:</label><br>
      <input type="text" name="numero" style="width:100%;padding:10px;margin:10px 0;background:#000;color:#fff;border:1px solid #c00;border-radius:6px;"><br>

      <label>Senha:</label><br>
      <input type="password" name="senha" required style="width:100%;padding:10px;margin:10px 0;background:#000;color:#fff;border:1px solid #c00;border-radius:6px;"><br>

      <button type="submit" style="width:100%;padding:10px;background:#900;color:#fff;border:none;border-radius:6px;font-weight:bold;cursor:pointer;">Cadastrar</button>
      <?php if(isset($erro)) echo "<p style='color:#c00;text-align:center;margin-top:10px;'>$erro</p>"; ?>
    </form>
  </main>
</body>
</html>
