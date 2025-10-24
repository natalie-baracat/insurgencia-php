<?php
// Inclui a conexão
include '../conexao.php'; // Certifique-se que o caminho está correto

// Pega o ID do produto da URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Prepara a consulta para buscar a imagem
    $sql = "SELECT imagem FROM produtos WHERE id_produto = ?"; // Assumindo que sua chave primária é 'id'
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows == 1) {
        // Vincula o resultado a uma variável
        $stmt->bind_result($imagem_conteudo);
        $stmt->fetch();
        
        // Informa ao navegador que o conteúdo é uma imagem JPEG/PNG/etc.
        // A melhor prática seria salvar o tipo da imagem (MIME type) no banco também.
        // Por simplicidade, vamos assumir que são imagens web comuns.
        header("Content-Type: image/jpg"); 
        
        // Exibe o conteúdo do BLOB
        echo $imagem_conteudo;
    }
    
    $stmt->close();
}
$conexao->close();
?>
