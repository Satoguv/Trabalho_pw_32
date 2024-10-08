<?php
// Função para conectar ao banco de dados
function conectarBanco() {
    $conn = new mysqli("localhost", "root", "", "advocacia");
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    return $conn;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome_completo'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $turno = $_POST['turno_contato'];
    $vara = $_POST['vara_processual'];
    $descricao = $_POST['descricao_processo'];

     // Conecta ao banco e prepara a consulta
     $conn = conectarBanco();
     $sql = $conn->prepare("INSERT INTO orcamento (cpf, nome_completo, email_orcamento, telefone, turno_contato, vara_processual, descricao_processo) VALUES (?, ?, ?, ?, ?, ?, ?)");
     $sql->bind_param("sssssss", $cpf, $nome, $email, $telefone, $turno, $vara, $descricao);
 
     if ($sql->execute()) {
         echo "Orçamento registrado com sucesso!";
     } else {
         echo "Erro ao registrar orçamento: " . $conn->error;
     }
 
     $sql->close();
     $conn->close();
}
?>

<form method="post">
  CPF: <input type="text" name="cpf"><br>
  Nome Completo: <input type="text" name="nome_completo"><br>
  Email: <input type="email" name="email"><br>
  Telefone: <input type="text" name="telefone"><br>
  Turno para Contato: <input type="text" name="turno_contato"><br>
  Vara Processual: <input type="text" name="vara_processual"><br>
  Descrição do Processo: <textarea name="descricao_processo"></textarea><br>
  <input type="submit" value="Registrar Orçamento">
</form>
