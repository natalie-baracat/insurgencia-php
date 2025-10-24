<?php
session_start();
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha   = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE usuario=?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $row = $resultado->fetch_assoc();

        if (password_verify($senha, $row['senha'])) {
            $_SESSION['id_usuario']   = $row['id_usuario'];
            $_SESSION['nome_usuario'] = $row['nome_usuario'];
            $_SESSION['role']         = $row['role']; // 👈 novo campo para diferenciar admin/usuário

            header("Location: index.php");
            exit;
        } else {
            $erro = "Senha incorreta.";
        }
    } else {
        $erro = "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login - INSURGÊNCIA</title>
  <link rel="stylesheet" href="./css/style2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
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

  <main>
    <section class="login-container">
      <h2>Entrar</h2>
      <?php if (!empty($erro)): ?>
        <p style="color:red; text-align:center;"><?php echo $erro; ?></p>
      <?php endif; ?>

      <form method="POST" action="">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" id="usuario" required style="width:100%;padding:10px;margin:10px 0;background:#000;color:#fff;border:1px solid #c00;border-radius:6px;">

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required style="width:100%;padding:10px;margin:10px 0;background:#000;color:#fff;border:1px solid #c00;border-radius:6px;">

        <button type="submit">Entrar</button>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> INSURGÊNCIA - Todos os direitos reservados.</p>
  </footer>
</body>
</html>
