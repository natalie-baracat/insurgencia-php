<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastrar Produto - INSURGÊNCIA</title>
  <link rel="stylesheet" href="./css/style2.css">
  <style>
    /* Seus estilos do formulário aqui... */
    .cadastro-form { max-width: 600px; margin: 50px auto; padding: 20px; background: #333; border-radius: 5px; color: #fff; }
    .cadastro-form h2 { text-align: center; margin-bottom: 20px; color: #fff; }
    .cadastro-form label { display: block; margin-bottom: 5px; font-weight: bold; }
    .cadastro-form input[type="text"], .cadastro-form input[type="file"], .cadastro-form textarea { width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #555; background: #222; color: #fff; border-radius: 3px; }
    .cadastro-form input[type="submit"] { background-color: #555; color: white; padding: 10px 15px; border: none; border-radius: 3px; cursor: pointer; font-size: 16px; }
    .cadastro-form input[type="submit"]:hover { background-color: #777; }
  </style>
</head>
<body>
  <!-- Cabeçalho -->
  <header>
    <div class="header-bg"></div>
    <h1>.INSURGÊNCiA</h1>
    <nav>
      <a href="./index.php">.home</a>
      <a href="cadastrar_produto.php">.cadastrar</a>
      <a href="#">.contato</a>
    </nav>
  </header>
  <div style="height:90px; background:#000;"></div>

  <div class="cadastro-form">
    <h2>Cadastrar Novo Produto</h2>
    <!-- ATENÇÃO: Adicionado o enctype para envio de arquivo -->
    <form action="processar_cadastro.php" method="post" enctype="multipart/form-data">
      <label for="nome">Nome do Produto:</label>
      <input type="text" id="nome" name="nome" required>
      
      <!-- ATENÇÃO: Alterado para input do tipo "file" -->
      <label for="imagem">Arquivo da Imagem:</label>
      <input type="file" id="imagem" name="imagem" required>

      <label for="preco">Preço (ex: 59,90):</label>
      <input type="text" id="preco" name="preco" required>

      <label for="descricao">Descrição:</label>
      <textarea id="descricao" name="descricao" rows="4" required></textarea>

      <input type="submit" value="Cadastrar Produto">
    </form>
  </div>
  
  <footer>
    <p>© 2025 Insurgência - Todos os direitos reservados</p>
  </footer>
</body>
</html>
