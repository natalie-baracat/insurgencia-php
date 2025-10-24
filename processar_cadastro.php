<?php
include './conexao.php'; // Usa o include que já corrigimos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se um arquivo foi enviado sem erros
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
        
        $nome = $_POST['nome'];
        $preco = str_replace(",", ".", $_POST['preco']); // Converte para formato numérico
        $descricao = $_POST['descricao'];
        
        // Pega o conteúdo binário da imagem
        $imagem_conteudo = file_get_contents($_FILES['imagem']['tmp_name']);

        // USA PREPARED STATEMENTS PARA SEGURANÇA E COMPATIBILIDADE COM BLOB
        // O '?' evita injeção de SQL e trata os dados corretamente
        $sql = "INSERT INTO produtos (nome, imagem, preco, descricao) VALUES (?, ?, ?, ?)";
        
        $stmt = $conexao->prepare($sql);
        
        // 's' = string, 'b' = blob, 'd' = double (para o preço)
        // O segundo parâmetro NULL é para o PHP enviar os dados como um pacote longo (necessário para BLOB)
        $stmt->bind_param("sbds", $nome, $null, $preco, $descricao);
        $stmt->send_long_data(1, $imagem_conteudo); // Envia o conteúdo da imagem para o segundo '?' (índice 1)
        
        if ($stmt->execute()) {
            echo "<script>alert('Produto cadastrado com sucesso!'); window.location.href = 'cadastrar_produto.php';</script>";
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro no upload da imagem.";
    }

    $conexao->close();
} else {
    header("Location: cadastrar_produto.php");
    exit();
}
?>
