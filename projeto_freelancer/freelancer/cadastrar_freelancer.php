<?php
$dsn = 'mysql:host=127.0.0.1;dbname=freelancer_db;charset=utf8;';
$usuario = 'root';
$senha = '';

try {
    $conexao = new PDO($dsn, $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $senha = $_POST['senha'];
        $habilidades = $_POST['habilidades'];
        $experiencia = $_POST['experiencia'];
        $portfolio = $_POST['portfolio'];
        $informacoes_pagamento = $_POST['informacoes_pagamento'];

        $query = "INSERT INTO freelancers (nome, email, username, senha, habilidades, experiencia, portfolio, informacoes_pagamento) 
                  VALUES (:nome, :email, :username, :senha, :habilidades, :experiencia, :portfolio, :informacoes_pagamento)";
        
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':habilidades', $habilidades);
        $stmt->bindParam(':experiencia', $experiencia);
        $stmt->bindParam(':portfolio', $portfolio);
        $stmt->bindParam(':informacoes_pagamento', $informacoes_pagamento);
        
        $stmt->execute();

        header("Location: cadastro_sucesso.php");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
} catch (PDOException $erro) {
    echo "Erro na conexão: " . $erro->getMessage();
}
?>
