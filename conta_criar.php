<!-- Sala: ITI32 -->

<!-- Professor: Regilan Meira -->

<!-- Componentes do grupo: 
 Gustavo Carvalho 
 Guilherme Ribeiro 
 Alexandre Córes 
 Bernardo Metzger 
 Sarah Kruschewsky 
 Nauan Nascimento 
 João Rafael (Adotado pois não tinha nenhum grupo) -->


<?php
// Função para conectar ao banco de dados
function conectarBanco() {
    $conn = new mysqli("localhost", "root", "", "advocacia");
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    return $conn;
}


// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oab = $_POST['numero_oab'];
    $nome = $_POST['nome_completo'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];

     // Conecta ao banco e prepara a consulta
     $conn = conectarBanco();
     $sql = $conn->prepare("INSERT INTO conta (numero_oab, nome_completo, email_conta, cpf) VALUES (?, ?, ?, ?)");
     $sql->bind_param("ssss", $oab, $nome, $email, $cpf);
 
     if ($sql->execute()) {
         echo "Nova conta criada com sucesso!";
     } else {
         echo "Erro ao criar conta: " . $conn->error;
     }
 
     $sql->close();
     $conn->close();
 }

?>
<!-- Formulário HTML -->
<form method="post">
  Número OAB: <input type="text" name="numero_oab"><br>
  Nome Completo: <input type="text" name="nome_completo"><br>
  Email: <input type="email" name="email"><br>
  CPF: <input type="text" name="cpf"><br>
  <input type="submit" value="Criar Conta">
</form>