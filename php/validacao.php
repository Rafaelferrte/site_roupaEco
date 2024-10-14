<?php
// Função para limpar os dados do formulário
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Validação do nome
function validate_name($name) {
    if (empty($name)) {
        return "O nome é obrigatório.";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        return "Apenas letras e espaços em branco são permitidos.";
    }
    return "";
}

// Validação do e-mail
function validate_email($email) {
    if (empty($email)) {
        return "O e-mail é obrigatório.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Formato de e-mail inválido.";
    }
    return "";
}

// Validação do telefone
function validate_phone($phone) {
    if (empty($phone)) {
        return "O telefone é obrigatório.";
    } elseif (!preg_match("/^\d{10,15}$/", $phone)) {
        return "Número de telefone inválido. Deve conter entre 10 e 15 dígitos.";
    }
    return "";
}

// Validação da mensagem
function validate_message($message) {
    if (empty($message)) {
        return "A mensagem é obrigatória.";
    }
    return "";
}
?>
