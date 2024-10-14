<?php
require 'conexao.php';   // Inclui o arquivo de conexão com o banco de dados
require 'validacao.php'; // Inclui o arquivo de validação

$nameError = $emailError = $phoneError = $messageError = "";
$name = $email = $phone = $message = "";

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Limpar e validar os campos
    $name = sanitize_input($_POST["campo_nome"]);
    $email = sanitize_input($_POST["campo_email"]);
    $phone = sanitize_input($_POST["campo_phone"]);
    $message = sanitize_input($_POST["mensagem"]);

    // Validações
    $nameError = validate_name($name);
    $emailError = validate_email($email);
    $phoneError = validate_phone($phone);
    $messageError = validate_message($message);

    // Se não houver erros de validação
    if (empty($nameError) && empty($emailError) && empty($phoneError) && empty($messageError)) {
        try {
            // Prepara a consulta SQL para inserir os dados no banco de dados
            $stmt = $conn->prepare("INSERT INTO contatos (nome, email, telefone, mensagem) VALUES (:nome, :email, :telefone, :mensagem)");

            // Associa os parâmetros
            $stmt->bindParam(':nome', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $phone);
            $stmt->bindParam(':mensagem', $message);
            
            // Executa a inserção
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Formulário enviado com sucesso!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Erro ao inserir os dados no banco de dados."]);
            }
        } catch(PDOException $e) {
            echo json_encode(["status" => "error", "message" => "Erro ao inserir os dados: " . $e->getMessage()]);
        }

        
    } else {
        // Erros de validação
        $errors = [];
        if (!empty($nameError)) $errors['name'] = $nameError;
        if (!empty($emailError)) $errors['email'] = $emailError;
        if (!empty($phoneError)) $errors['phone'] = $phoneError;
        if (!empty($messageError)) $errors['message'] = $messageError;

        echo json_encode(["status" => "error", "errors" => $errors]);

    }

    header("Location: ../index.html#contact");
        exit();
}
?>
